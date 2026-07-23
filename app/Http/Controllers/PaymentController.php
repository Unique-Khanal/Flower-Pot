<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Show the "redirecting to gateway" page and send the user on to
     * eSewa or Khalti depending on the order's chosen payment_method.
     */
    public function initiate(Order $order)
    {
        $this->authorizeOrder($order);

        // Already paid — never let a retry click charge twice.
        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.index')
                ->with('success', 'This order is already paid.');
        }

        // Cancelled orders can't be paid for.
        if ($order->status === 'cancelled') {
            return redirect()->route('orders.index')
                ->with('error', 'This order was cancelled and cannot be paid for.');
        }

        return match ($order->payment_method) {
            'esewa' => $this->initiateEsewa($order),
            'khalti' => $this->initiateKhalti($order),
            default => redirect()->route('orders.index'),
        };
    }

    /**
     * eSewa: build a signed HTML form and auto-submit it to eSewa's payment page.
     * eSewa's ePay v2 API requires a HMAC-SHA256 signature over specific fields.
     */
    protected function initiateEsewa(Order $order)
    {
        $transactionUuid = 'FP-' . $order->id . '-' . now()->timestamp;

        $fields = [
            'amount' => number_format($order->subtotal, 2, '.', ''),
            'tax_amount' => '0',
            'total_amount' => number_format($order->total, 2, '.', ''),
            'transaction_uuid' => $transactionUuid,
            'product_code' => config('services.esewa.product_code'),
            'product_service_charge' => '0',
            'product_delivery_charge' => number_format($order->delivery_charge, 2, '.', ''),
            'success_url' => route('payment.esewa.success'),
            'failure_url' => route('payment.esewa.failure', $order),
            'signed_field_names' => 'total_amount,transaction_uuid,product_code',
        ];

        $signatureString = "total_amount={$fields['total_amount']},transaction_uuid={$fields['transaction_uuid']},product_code={$fields['product_code']}";
        $fields['signature'] = base64_encode(
            hash_hmac('sha256', $signatureString, config('services.esewa.secret_key'), true)
        );

        $order->update(['gateway_ref' => $transactionUuid]);

        return view('payment.redirecting', [
            'gatewayUrl' => config('services.esewa.form_url'),
            'fields' => $fields,
        ]);
    }

    /**
     * Khalti: call their Initiate API server-side, then redirect the browser
     * to the payment_url Khalti gives back.
     */
    protected function initiateKhalti(Order $order)
    {
        $response = Http::withHeaders([
            'Authorization' => 'key ' . config('services.khalti.secret_key'),
        ])
            // TEMP: local Windows dev only — PHP has no CA bundle configured, causing
            // "SSL certificate problem: self-signed certificate in certificate chain".
            // Fix php.ini's curl.cainfo instead, then delete this line before deploying.
            ->when(app()->environment('local'), fn($http) => $http->withoutVerifying())
            ->post(config('services.khalti.initiate_url'), [
                'return_url' => route('payment.khalti.callback'),
                'website_url' => url('/'),
                'amount' => (int) round($order->total * 100), // paisa
                'purchase_order_id' => (string) $order->id,
                'purchase_order_name' => 'FlowerPot Order #' . $order->id,
                'customer_info' => [
                    'name' => $order->customer_name,
                    'email' => $order->email,
                    'phone' => $order->phone_no,
                ],
            ]);

        if ($response->failed() || !$response->json('payment_url')) {
            return redirect()->route('orders.index')
                ->with('error', 'Could not start Khalti payment. Please try again or choose Cash on Delivery.');
        }

        $order->update(['gateway_ref' => $response->json('pidx')]);

        return redirect()->away($response->json('payment_url'));
    }

    /**
     * eSewa redirects here after payment. eSewa's success redirect is NOT
     * trusted on its own — we verify the transaction status server-side
     * before marking the order paid.
     */
    public function esewaSuccess(Request $request)
    {
        // eSewa v2 sends a base64-encoded JSON blob in ?data=
        $decoded = json_decode(base64_decode($request->query('data', '')), true);

        $transactionUuid = $decoded['transaction_uuid'] ?? null;
        $order = Order::where('gateway_ref', $transactionUuid)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Payment reference not found.');
        }

        $this->authorizeOrder($order);

        $verify = Http::get(config('services.esewa.status_url'), [
            'product_code' => config('services.esewa.product_code'),
            'total_amount' => number_format($order->total, 2, '.', ''),
            'transaction_uuid' => $transactionUuid,
        ]);

        if ($verify->ok() && $verify->json('status') === 'COMPLETE') {
            $order->update(['payment_status' => 'paid']);
            return redirect()->route('orders.index')->with('success', '🎉 Payment successful! Order confirmed.');
        }

        $order->update(['payment_status' => 'failed']);
        return redirect()->route('orders.index')->with('error', 'Payment verification failed. Please contact support.');
    }

    public function esewaFailure(Order $order)
    {
        $this->authorizeOrder($order);
        $order->update(['payment_status' => 'failed']);

        return redirect()->route('orders.index')
            ->with('error', 'Payment was cancelled or failed. You can retry payment or choose Cash on Delivery.');
    }

    /**
     * Khalti redirects here after payment. Same rule: verify via lookup API,
     * never trust the redirect query params alone.
     */
    public function khaltiCallback(Request $request)
    {
        $pidx = $request->query('pidx');
        $order = Order::where('gateway_ref', $pidx)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Payment reference not found.');
        }

        $this->authorizeOrder($order);

        $verify = Http::withHeaders([
            'Authorization' => 'key ' . config('services.khalti.secret_key'),
        ])
            ->when(app()->environment('local'), fn($http) => $http->withoutVerifying())
            ->post(config('services.khalti.lookup_url'), ['pidx' => $pidx]);

        if ($verify->ok() && $verify->json('status') === 'Completed') {
            $order->update(['payment_status' => 'paid']);
            return redirect()->route('orders.index')->with('success', '🎉 Payment successful! Order confirmed.');
        }

        $order->update(['payment_status' => 'failed']);
        return redirect()->route('orders.index')->with('error', 'Payment was not completed. Please retry or choose Cash on Delivery.');
    }

    protected function authorizeOrder(Order $order): void
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
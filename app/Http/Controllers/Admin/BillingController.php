<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BillingController extends Controller
{
    /**
     * Only live (approved, not hidden) vendor products can be billed —
     * an admin shouldn't be able to record a sale for something that
     * hasn't passed moderation yet.
     */
    public function create(): View
    {
        $products = Product::with('vendor')
            ->whereNotNull('vendor_id')
            ->where('is_hidden', false)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('admin.billing.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id'    => ['required', 'exists:products,id'],
            'quantity'      => ['required', 'integer', 'min:1'],
            'customer_name' => ['required', 'string', 'max:255'],
            'email'         => ['nullable', 'email', 'max:255'],
            'phone_no'      => ['nullable', 'string', 'max:20'],
            'address'       => ['nullable', 'string', 'max:500'],
        ]);

        $product = Product::whereNotNull('vendor_id')
            ->where('is_hidden', false)
            ->findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return back()->withInput()->with('error',
                "Only {$product->stock} of {$product->name} in stock — can't bill {$request->quantity}."
            );
        }

        $order = DB::transaction(function () use ($request, $product) {
            $unitPrice = (float) $product->price;
            $subtotal  = round($unitPrice * $request->quantity, 2);

            $commissionRate   = (float) ($product->vendor->commission_rate ?? 0);
            $commissionAmount = round($subtotal * $commissionRate / 100, 2);

            // Manual, in-person/admin-recorded sale — attributed to the
            // admin as the recording user (Order.user_id is required and
            // not nullable), with the real buyer's details captured in the
            // free-text customer fields alongside it.
            $order = Order::create([
                'user_id'        => Auth::id(),
                'customer_name'  => $request->customer_name,
                'email'          => $request->email,
                'phone_no'       => $request->phone_no,
                'address'        => $request->address ?: 'Recorded in-person by admin',
                'subtotal'       => $subtotal,
                'discount_amount'=> 0,
                'delivery_charge'=> 0,
                'total'          => $subtotal,
                'status'         => 'delivered',
                'payment_method' => 'cod',
                'payment_status' => 'paid',
            ]);

            OrderItem::create([
                'order_id'          => $order->id,
                'product_id'        => $product->id,
                'vendor_id'         => $product->vendor_id,
                'vendor_status'     => 'delivered',
                'commission_amount' => $commissionAmount,
                'product_name'      => $product->name,
                'product_image'     => $product->image,
                'price'             => $unitPrice,
                'quantity'          => $request->quantity,
                'subtotal'          => $subtotal,
            ]);

            $product->decrement('stock', $request->quantity);

            return $order;
        });

        return redirect()->route('admin.billing.create')->with('success',
            "Sale recorded — Order #{$order->id}, Rs. " . number_format($order->total, 2) .
            " — saved to both admin records and {$product->vendor->business_name}'s account."
        );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Mail\OrderCancelledMail;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = Order::with(['user', 'items'])->latest();

        match ($status) {
            'pending'      => $query->where('status', 'pending'),
            'confirmed'    => $query->where('status', 'confirmed'),
            'delivered'    => $query->where('status', 'delivered'),
            'cancelled'    => $query->where('status', 'cancelled'),
            'cod_pending'  => $query->where('payment_method', 'cod')->where('payment_status', '!=', 'paid'),
            'refunded'     => $query->where('payment_status', 'refunded'),
            default        => null,
        };

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_no', 'like', "%{$search}%")
                    ->orWhere('invoice_no', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();

        $counts = [
            'all'         => Order::count(),
            'pending'     => Order::where('status', 'pending')->count(),
            'confirmed'   => Order::where('status', 'confirmed')->count(),
            'delivered'   => Order::where('status', 'delivered')->count(),
            'cancelled'   => Order::where('status', 'cancelled')->count(),
            'cod_pending' => Order::where('payment_method', 'cod')->where('payment_status', '!=', 'paid')->count(),
            'refunded'    => Order::where('payment_status', 'refunded')->count(),
        ];

        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');

        return view('admin.orders.index', compact('orders', 'status', 'search', 'counts', 'totalRevenue'));
    }

    /**
     * pending -> confirmed. Just moves the order along — no payment or
     * invoice implications, since payment for online methods already
     * happened at checkout, and COD payment only happens on delivery.
     */
    public function confirm(Order $order): RedirectResponse
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be confirmed.');
        }

        $order->update(['status' => 'confirmed']);

        return back()->with('success', "Order #{$order->id} confirmed.");
    }

    /**
     * confirmed -> delivered.
     *
     * For COD orders, delivery IS the payment event — cash changes hands
     * at the door, so marking an order delivered is what confirms
     * payment and issues the invoice, all in one step. For orders
     * already paid online (esewa/khalti), this just updates status;
     * payment/invoice already happened at checkout.
     *
     * Either way, once an invoice exists, it's emailed to the customer.
     */
    public function deliver(Order $order): RedirectResponse
    {
        if ($order->status !== 'confirmed') {
            return back()->with('error', 'Only confirmed orders can be marked delivered.');
        }

        $order->update(['status' => 'delivered']);

        $wasAlreadyInvoiced = (bool) $order->invoice_no;

        if ($order->payment_method === 'cod' && $order->payment_status !== 'paid') {
            $order->markAsPaid();
        }

        if (! $wasAlreadyInvoiced && $order->fresh()->invoice_no) {
            Mail::to($order->email)->send(new InvoiceMail($order->fresh()));
        }

        return back()->with('success', "Order #{$order->id} marked delivered" .
            ($order->payment_method === 'cod' ? " — invoice {$order->fresh()->invoice_no} emailed to the customer." : '.'));
    }

    /**
     * pending -> cancelled. Deliberately the ONLY status a cancellation
     * is allowed from — once an order has been confirmed (let alone
     * delivered), cancelling it here would leave stock/commission/
     * payment state inconsistent. A confirmed-or-later order that
     * genuinely needs to be undone should go through the refund flow
     * instead, not a plain cancel.
     */
    public function cancel(Request $request, Order $order): RedirectResponse
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled. Confirmed or delivered orders must be refunded instead.');
        }

        $request->validate([
            'cancel_reason' => ['required', 'string', 'max:500'],
        ]);

        $order->update([
            'status'        => 'cancelled',
            'cancel_reason' => $request->cancel_reason,
            'cancelled_at'  => now(),
        ]);

        Mail::to($order->email)->send(new OrderCancelledMail($order->fresh('items')));

        return back()->with('success', "Order #{$order->id} cancelled — the customer has been notified by email.");
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function markCodPaid(Order $order): RedirectResponse
    {
        if ($order->payment_method !== 'cod') {
            return back()->with('error', 'Only Cash on Delivery orders can be marked paid this way.');
        }

        if ($order->payment_status === 'paid') {
            return back()->with('error', 'This order is already marked as paid.');
        }

        $order->markAsPaid();

        return back()->with('success', "Order #{$order->id} marked paid — invoice {$order->invoice_no} generated.");
    }
}
<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    private function vendor()
    {
        return Auth::user()->vendor;
    }

    /** Only the order lines that contain THIS vendor's products. */
    public function index(Request $request): View
    {
        $vendor = $this->vendor();
        $status = $request->query('status', 'all');

        $base = OrderItem::where('vendor_id', $vendor->id);

        $query = (clone $base)->with('order')->latest();

        if (in_array($status, ['pending', 'processing', 'shipped', 'delivered', 'cancelled'], true)) {
            $query->where('vendor_status', $status);
        }

        $items = $query->paginate(20)->withQueryString();

        $counts = [
            'all'        => (clone $base)->count(),
            'pending'    => (clone $base)->where('vendor_status', 'pending')->count(),
            'processing' => (clone $base)->where('vendor_status', 'processing')->count(),
            'shipped'    => (clone $base)->where('vendor_status', 'shipped')->count(),
            'delivered'  => (clone $base)->where('vendor_status', 'delivered')->count(),
            'cancelled'  => (clone $base)->where('vendor_status', 'cancelled')->count(),
        ];

        return view('vendor.orders.index', compact('items', 'status', 'counts'));
    }

    /**
     * Vendor moves their own line forward: pending -> processing -> shipped.
     * "Delivered" is set when the admin marks the whole order delivered
     * (that is also the moment payment/invoice/payout become due).
     */
    public function updateStatus(Request $request, OrderItem $item): RedirectResponse
    {
        abort_unless($item->vendor_id === $this->vendor()->id, 403);

        $request->validate(['status' => ['required', 'in:processing,shipped']]);

        $item->load('order');

        if ($item->vendor_status === 'cancelled' || $item->order->status === 'cancelled') {
            return back()->with('error', 'This order was cancelled.');
        }

        if ($item->order->status === 'pending') {
            return back()->with('error', "Order #{$item->order_id} is still waiting for admin confirmation.");
        }

        if ($item->order->status === 'delivered' || $item->vendor_status === 'delivered') {
            return back()->with('error', 'This item is already delivered.');
        }

        $expectedNext = ['pending' => 'processing', 'processing' => 'shipped'][$item->vendor_status] ?? null;

        if ($expectedNext === null || $request->status !== $expectedNext) {
            return back()->with('error', 'This item was already updated — refresh to see its current status.');
        }

        $item->update(['vendor_status' => $expectedNext]);

        return back()->with('success', "Order #{$item->order_id} · {$item->product_name} marked as {$expectedNext}.");
    }
}
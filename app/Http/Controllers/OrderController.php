<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    const FACTORY_LAT = 27.7172;
    const FACTORY_LNG = 85.3240;

    public function create()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('orders.create', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_no' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'distance_km' => ['required', 'numeric'],
            'delivery_charge' => ['required', 'numeric'],
            'payment_method' => ['required', 'in:cod,esewa,khalti'],
        ]);

        $cartItems = CartItem::with('product.vendor')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal + $request->delivery_charge;

        $order = DB::transaction(function () use ($request, $cartItems, $subtotal, $total) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'distance_km' => $request->distance_km,
                'delivery_charge' => $request->delivery_charge,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
            ]);

            // Save order items — stamped with vendor + commission
            foreach ($cartItems as $item) {
                $vendorId       = $item->product->vendor_id;
                $commissionRate = $item->product->vendor->commission_rate ?? 0;
                $lineSubtotal   = $item->product->price * $item->quantity;
                $commission     = round($lineSubtotal * ($commissionRate / 100), 2);

                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $item->product_id,
                    'vendor_id'         => $vendorId,
                    'vendor_status'     => 'pending',
                    'commission_amount' => $commission,
                    'product_name'      => $item->product->name,
                    'product_image'     => $item->product->image,
                    'price'             => $item->product->price,
                    'quantity'          => $item->quantity,
                    'subtotal'          => $lineSubtotal,
                ]);
            }

            CartItem::where('user_id', Auth::id())->delete();

            return $order;
        });

        if ($order->payment_method === 'cod') {
            return redirect()->route('orders.index')
                ->with('success', '🎉 Order placed successfully!');
        }

        return redirect()->route('payment.initiate', $order);
    }

    public function index()
    {
        $orders = Order::with('items.vendor')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function cancel(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        $request->validate([
            'cancel_reason' => ['required', 'string', 'min:10'],
        ]);

        $order->update([
            'status' => 'cancelled',
            'cancel_reason' => $request->cancel_reason,
            'cancelled_at' => now(),
        ]);

        // Cascade cancellation down to each vendor's line item
        $order->items()->update(['vendor_status' => 'cancelled']);

        return back()->with('success', 'Order cancelled successfully.');
    }

    public function switchToCod(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return back()->with('error', 'This order is already paid — nothing to switch.');
        }

        if ($order->status === 'cancelled') {
            return back()->with('error', 'This order was cancelled.');
        }

        $order->update([
            'payment_method' => 'cod',
            'payment_status' => 'pending',
        ]);

        return back()->with('success', 'Switched to Cash on Delivery — no online payment needed.');
    }

    public static function calculateDeliveryCharge(float $distanceKm): int
    {
        return match (true) {
            $distanceKm <= 5 => 50,
            $distanceKm <= 10 => 100,
            $distanceKm <= 20 => 150,
            $distanceKm <= 30 => 200,
            default => 300,
        };
    }
}
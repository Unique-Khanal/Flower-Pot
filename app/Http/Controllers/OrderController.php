<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Factory coordinates (Kathmandu)
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
            'email'         => ['required', 'email', 'max:255'],
            'phone_no'      => ['required', 'string', 'max:20'],
            'address'       => ['required', 'string'],
            'latitude'      => ['required', 'numeric'],
            'longitude'     => ['required', 'numeric'],
            'distance_km'   => ['required', 'numeric'],
            'delivery_charge' => ['required', 'numeric'],
        ]);

        $cartItems = CartItem::with('product')
                    ->where('user_id', Auth::id())
                    ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total    = $subtotal + $request->delivery_charge;

        // Create order
        $order = Order::create([
            'user_id'         => Auth::id(),
            'customer_name'   => $request->customer_name,
            'email'           => $request->email,
            'phone_no'        => $request->phone_no,
            'address'         => $request->address,
            'latitude'        => $request->latitude,
            'longitude'       => $request->longitude,
            'distance_km'     => $request->distance_km,
            'delivery_charge' => $request->delivery_charge,
            'subtotal'        => $subtotal,
            'total'           => $total,
            'status'          => 'pending',
        ]);

        // Save order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item->product_id,
                'product_name'  => $item->product->name,
                'product_image' => $item->product->image,
                'price'         => $item->product->price,
                'quantity'      => $item->quantity,
                'subtotal'      => $item->product->price * $item->quantity,
            ]);
        }

        // Clear cart after order
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')
                         ->with('success', '🎉 Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::with('items')
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
            'status'        => 'cancelled',
            'cancel_reason' => $request->cancel_reason,
            'cancelled_at'  => now(),
        ]);

        return back()->with('success', 'Order cancelled successfully.');
    }

    // Delivery charge calculation
    public static function calculateDeliveryCharge(float $distanceKm): int
    {
        return match(true) {
            $distanceKm <= 5  => 50,
            $distanceKm <= 10 => 100,
            $distanceKm <= 20 => 150,
            $distanceKm <= 30 => 200,
            default           => 300,
        };
    }
}
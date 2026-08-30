<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
                    ->where('user_id', Auth::id())
                    ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

   public function add(Request $request, Product $product)
{
    $request->validate([
        'quantity' => 'nullable|integer|min:1|max:' . max($product->stock, 1),
    ]);

    $qty = $request->quantity ?? 1;

    $cartItem = CartItem::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

    $existingQty = $cartItem?->quantity ?? 0;

    if ($existingQty + $qty > $product->stock) {
        return back()->with('error', "Only {$product->stock} of {$product->name} in stock — you already have {$existingQty} in your cart.");
    }

    if ($cartItem) {
        $cartItem->update(['quantity' => $existingQty + $qty]);
    } else {
        CartItem::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'quantity'   => $qty,
        ]);
    }

    // If Place Order button was clicked → redirect to cart
    if ($request->has('redirect_to_cart')) {
        return redirect()->route('cart.index')->with('success', 'Order placed in cart! Review and checkout.');
    }

    return back()->with('success', 'Product added to cart!');
}

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }
        $cartItem->delete();
        return back()->with('success', 'Item removed from cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $stock = $cartItem->product->stock;

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . max($stock, 1),
        ], [
            'quantity.max' => "Only {$stock} of this item in stock.",
        ]);

        $cartItem->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated.');
    }
}
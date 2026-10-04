<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * A customer can review a product only after it was actually delivered
     * to them — checked via vendor_status rather than order status, since
     * that's the per-item field that reflects fulfilment (and is set for
     * both vendor and platform products the same way).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'rating'     => ['required', 'integer', 'min:1', 'max:5'],
            'comment'    => ['nullable', 'string', 'max:1000'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        $delivered = OrderItem::where('product_id', $product->id)
            ->where('vendor_status', 'delivered')
            ->whereHas('order', fn ($q) => $q->where('user_id', Auth::id()))
            ->exists();

        if (! $delivered) {
            return back()->with('error', "You can only review {$product->name} after it has been delivered to you.");
        }

        // One review per product per customer — editing an existing review
        // updates it in place rather than creating a duplicate.
        Review::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => Auth::id()],
            ['vendor_id' => $product->vendor_id, 'rating' => $data['rating'], 'comment' => $data['comment'] ?? null]
        );

        return back()->with('success', "Thanks! Your review for {$product->name} has been saved.");
    }

    public function destroy(Review $review): RedirectResponse
    {
        abort_unless($review->user_id === Auth::id(), 403);

        $review->delete();

        return back()->with('success', 'Review removed.');
    }
}
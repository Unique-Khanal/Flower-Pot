<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $owner  = $request->query('owner', 'all');      // all | platform | vendor
        $rating = $request->query('rating');            // 1-5 or null
        $search = trim((string) $request->query('search', ''));

        $query = Review::with(['user', 'product.vendor'])->latest();

        // "platform" = products the admin owns (vendor_id NULL)
        if ($owner === 'platform') {
            $query->whereHas('product', fn ($q) => $q->whereNull('vendor_id'));
        } elseif ($owner === 'vendor') {
            $query->whereHas('product', fn ($q) => $q->whereNotNull('vendor_id'));
        }

        if (in_array($rating, ['1', '2', '3', '4', '5'], true)) {
            $query->where('rating', (int) $rating);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('product', fn ($p) => $p->where('name', 'like', "%{$search}%"));
            });
        }

        $reviews = $query->paginate(15)->withQueryString();

        $counts = [
            'all'      => Review::count(),
            'platform' => Review::whereHas('product', fn ($q) => $q->whereNull('vendor_id'))->count(),
            'vendor'   => Review::whereHas('product', fn ($q) => $q->whereNotNull('vendor_id'))->count(),
        ];

        return view('admin.reviews.index', compact('reviews', 'owner', 'rating', 'search', 'counts'));
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}
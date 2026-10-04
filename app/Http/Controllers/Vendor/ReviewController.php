<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $vendor = Auth::user()->vendor;
        $rating = $request->query('rating'); // 1-5 or null for all

        $query = $vendor->reviews()->with(['user', 'product'])->latest();

        if (in_array($rating, ['1', '2', '3', '4', '5'], true)) {
            $query->where('rating', (int) $rating);
        }

        $reviews = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => $vendor->reviews()->count(),
            'avg'   => round($vendor->reviews()->avg('rating') ?? 0, 1),
        ];

        $breakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $breakdown[$i] = $vendor->reviews()->where('rating', $i)->count();
        }

        return view('vendor.reviews.index', compact('reviews', 'stats', 'breakdown', 'rating'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
    public function index(): View
    {
        $vendor = Auth::user()->vendor;

        $pendingFromAdmin = $vendor->commissionNegotiations()
            ->where('status', 'pending')
            ->where('proposed_by', 'admin')
            ->first();

        $stats = [
            'total_products'   => $vendor->products()->count(),
            'hidden_products'  => $vendor->products()->where('is_hidden', true)->count(),
            'low_stock'        => $vendor->products()->whereNotNull('stock')->where('stock', '<=', 5)->count(),
            'pending_orders'   => $vendor->orderItems()->where('vendor_status', 'pending')->count(),
            'processing_orders'=> $vendor->orderItems()->where('vendor_status', 'processing')->count(),
            'total_reviews'    => $vendor->reviews()->count(),
            'avg_rating'       => round($vendor->reviews()->avg('rating') ?? 0, 1),
            'total_earned'     => $vendor->payouts()->where('status', 'paid')->sum('payout_amount'),
            'pending_payout'   => $vendor->payouts()->where('status', 'pending')->sum('payout_amount'),
        ];

        $recentOrderItems = $vendor->orderItems()->with('order', 'product')->latest()->limit(5)->get();
        $recentReviews    = $vendor->reviews()->with('user', 'product')->latest()->limit(4)->get();

        return view('vendor.dashboard', [
            'vendor'           => $vendor,
            'pendingFromAdmin' => $pendingFromAdmin,
            'stats'            => $stats,
            'recentOrderItems' => $recentOrderItems,
            'recentReviews'    => $recentReviews,
        ]);
    }
}
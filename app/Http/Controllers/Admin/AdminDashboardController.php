<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionNegotiation;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_vendors'      => Vendor::where('status', 'pending')->count(),
            'approved_vendors'     => Vendor::where('status', 'approved')->count(),
            'suspended_vendors'    => Vendor::where('status', 'suspended')->count(),
            'pending_negotiations' => CommissionNegotiation::where('status', 'pending')
                                        ->where('proposed_by', 'vendor')->count(),
            'total_products'       => Product::count(),
            'platform_products'    => Product::whereNull('vendor_id')->count(),
            'vendor_products'      => Product::whereNotNull('vendor_id')->count(),
            'low_stock_products'   => Product::whereNotNull('stock')->where('stock', '<=', 5)->count(),
            'total_users'          => User::where('role', 'customer')->count(),
            'total_vendors_users'  => User::where('role', 'vendor')->count(),
            'unread_contacts'      => Contact::where('is_read', false)->count(),
        ];

        $recentVendors = Vendor::with('user')->latest()->limit(5)->get();

        $recentNegotiations = CommissionNegotiation::with('vendor')
            ->where('status', 'pending')
            ->where('proposed_by', 'vendor')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentVendors', 'recentNegotiations'));
    }
}
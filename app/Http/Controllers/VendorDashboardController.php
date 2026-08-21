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

        return view('vendor.dashboard', [
            'vendor'           => $vendor,
            'pendingFromAdmin' => $pendingFromAdmin,
        ]);
    }
}
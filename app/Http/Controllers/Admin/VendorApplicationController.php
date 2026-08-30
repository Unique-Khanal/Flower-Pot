<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VendorApplicationApproved;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class VendorApplicationController extends Controller
{
    public function index(): View
    {
        $pendingVendors = Vendor::with('user')->where('status', 'pending')->latest()->get();
        $approvedVendors = Vendor::with('user')->where('status', 'approved')->latest('approved_at')->get();
        $rejectedVendors = Vendor::with('user')->where('status', 'rejected')->latest()->get();

        return view('admin.vendors.index', compact('pendingVendors', 'approvedVendors', 'rejectedVendors'));
    }

    public function approve(Vendor $vendor): RedirectResponse
    {
        $vendor->update([
            'status'           => 'approved',
            'approved_at'      => now(),
            'rejection_reason' => null,
            'reviewed_by'      => auth()->id(),
        ]);

        Mail::to($vendor->user->email)->send(new VendorApplicationApproved($vendor));

        return back()->with('success', "{$vendor->business_name} has been approved and notified by email.");
    }

    public function reject(Request $request, Vendor $vendor): RedirectResponse
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $vendor->update([
            'status'           => 'rejected',
            'approved_at'      => null,
            'rejection_reason' => $request->rejection_reason,
            'reviewed_by'      => auth()->id(),
        ]);

        return back()->with('success', "{$vendor->business_name}'s application has been rejected.");
    }
}

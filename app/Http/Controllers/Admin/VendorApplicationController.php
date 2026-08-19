<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorApplicationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');

        $vendors = Vendor::with('user')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->get();

        $pendingCount = Vendor::where('status', 'pending')->count();

        return view('admin.vendors.index', compact('vendors', 'status', 'pendingCount'));
    }

    public function approve(Vendor $vendor)
    {
        $vendor->update([
            'status'      => 'approved',
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        // TODO: send vendor-facing "you're approved, log in now" email here
        // once that notification is built.

        return back()->with('success', "{$vendor->business_name} has been approved.");
    }

    public function reject(Request $request, Vendor $vendor)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'min:10'],
        ]);

        $vendor->update([
            'status'            => 'rejected',
            'rejection_reason'  => $request->rejection_reason,
            'approved_at'       => null,
        ]);

        // TODO: send vendor-facing rejection email with reason here
        // once that notification is built.

        return back()->with('success', "{$vendor->business_name}'s application has been rejected.");
    }
}
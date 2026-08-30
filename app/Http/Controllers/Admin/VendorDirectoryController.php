<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VendorDirectoryController extends Controller
{
    /**
     * Browse approved / suspended vendors with at-a-glance stats.
     * Pending / rejected applications stay on the Applications screen —
     * this directory is for vendors who are (or were) actually live.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = Vendor::with('user')
            ->whereIn('status', ['approved', 'suspended'])
            ->withCount('products')
            ->withSum('orderItems as sales_total', 'subtotal');

        if (in_array($status, ['approved', 'suspended'], true)) {
            $query->where('status', $status);
        }

        $vendors = $query->orderBy('business_name')->paginate(15)->withQueryString();

        $counts = [
            'approved'  => Vendor::where('status', 'approved')->count(),
            'suspended' => Vendor::where('status', 'suspended')->count(),
        ];

        return view('admin.vendors.directory', compact('vendors', 'status', 'counts'));
    }

    /**
     * Suspend an active vendor — their storefront/listings should stop
     * being sold-through, but nothing is deleted so they can be
     * reactivated later without re-approval.
     */
    public function suspend(Vendor $vendor): RedirectResponse
    {
        if ($vendor->status !== 'approved') {
            return back()->withErrors(['vendor' => 'Only approved vendors can be suspended.']);
        }

        $vendor->update(['status' => 'suspended']);

        return back()->with('success', "{$vendor->business_name} has been suspended.");
    }

    /**
     * Reactivate a previously-suspended vendor back to approved.
     */
    public function reactivate(Vendor $vendor): RedirectResponse
    {
        if ($vendor->status !== 'suspended') {
            return back()->withErrors(['vendor' => 'Only suspended vendors can be reactivated.']);
        }

        $vendor->update(['status' => 'approved']);

        return back()->with('success', "{$vendor->business_name} has been reactivated.");
    }

    /**
     * Direct commission-rate override for edge cases — bypasses the
     * propose/accept negotiation flow entirely. Admin sets the number,
     * it takes effect immediately.
     */
    public function updateCommission(Request $request, Vendor $vendor): RedirectResponse
    {
        $validated = $request->validate([
            'commission_rate' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $vendor->update(['commission_rate' => $validated['commission_rate']]);

        return back()->with('success', "Commission rate for {$vendor->business_name} set to {$validated['commission_rate']}%.");
    }
}
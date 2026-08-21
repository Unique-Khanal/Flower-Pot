<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\CommissionNegotiation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionNegotiationController extends Controller
{
    /**
     * Vendor proposes a new rate (either opening a negotiation,
     * or responding to admin's counter-offer).
     */
    public function propose(Request $request): RedirectResponse
    {
        $request->validate([
            'proposed_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'message'       => ['nullable', 'string', 'max:500'],
        ]);

        $vendor = Auth::user()->vendor;

        if (! $vendor) {
            abort(403);
        }

        // Close out any prior pending proposal from either side before opening a new one
        $vendor->commissionNegotiations()
            ->where('status', 'pending')
            ->update(['status' => 'countered']);

        CommissionNegotiation::create([
            'vendor_id'     => $vendor->id,
            'proposed_by'   => 'vendor',
            'proposed_rate' => $request->proposed_rate,
            'message'       => $request->message,
            'status'        => 'pending',
        ]);

        return back()->with('success', 'Your commission rate proposal has been sent to the admin.');
    }

    /**
     * Vendor accepts admin's counter-offer.
     */
    public function accept(CommissionNegotiation $negotiation): RedirectResponse
    {
        $vendor = Auth::user()->vendor;

        if (! $vendor || $negotiation->vendor_id !== $vendor->id || $negotiation->proposed_by !== 'admin') {
            abort(403);
        }

        if (! $negotiation->isPending()) {
            return back()->with('error', 'This proposal is no longer active.');
        }

        $negotiation->update([
            'status'       => 'accepted',
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        $vendor->update(['commission_rate' => $negotiation->proposed_rate]);

        return back()->with('success', "Commission rate updated to {$negotiation->proposed_rate}%.");
    }

    /**
     * Vendor rejects admin's counter-offer (ends negotiation for now).
     */
    public function reject(CommissionNegotiation $negotiation): RedirectResponse
    {
        $vendor = Auth::user()->vendor;

        if (! $vendor || $negotiation->vendor_id !== $vendor->id || $negotiation->proposed_by !== 'admin') {
            abort(403);
        }

        if (! $negotiation->isPending()) {
            return back()->with('error', 'This proposal is no longer active.');
        }

        $negotiation->update([
            'status'       => 'rejected',
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        return back()->with('success', 'Proposal declined. The current commission rate remains unchanged.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionNegotiation;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionNegotiationController extends Controller
{
    /**
     * List all vendors with a pending negotiation waiting on admin.
     */
    public function index()
    {
        $pending = CommissionNegotiation::with('vendor')
            ->where('status', 'pending')
            ->where('proposed_by', 'vendor')
            ->latest()
            ->get();

        return view('admin.commission-negotiations.index', compact('pending'));
    }

    /**
     * Admin accepts the vendor's proposed rate.
     */
    public function accept(CommissionNegotiation $negotiation): RedirectResponse
    {
        if (! $negotiation->isPending() || $negotiation->proposed_by !== 'vendor') {
            return back()->with('error', 'This proposal is no longer active.');
        }

        $negotiation->update([
            'status'       => 'accepted',
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        $negotiation->vendor->update(['commission_rate' => $negotiation->proposed_rate]);

        return back()->with('success', "Accepted — {$negotiation->vendor->business_name}'s rate is now {$negotiation->proposed_rate}%.");
    }

    /**
     * Admin rejects the vendor's proposed rate outright.
     */
    public function reject(CommissionNegotiation $negotiation): RedirectResponse
    {
        if (! $negotiation->isPending() || $negotiation->proposed_by !== 'vendor') {
            return back()->with('error', 'This proposal is no longer active.');
        }

        $negotiation->update([
            'status'       => 'rejected',
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        return back()->with('success', 'Proposal rejected.');
    }

    /**
     * Admin sends a counter-offer instead of a flat accept/reject.
     */
    public function counter(Request $request, CommissionNegotiation $negotiation): RedirectResponse
    {
        $request->validate([
            'proposed_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'message'       => ['nullable', 'string', 'max:500'],
        ]);

        if (! $negotiation->isPending() || $negotiation->proposed_by !== 'vendor') {
            return back()->with('error', 'This proposal is no longer active.');
        }

        $negotiation->update([
            'status'       => 'countered',
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        CommissionNegotiation::create([
            'vendor_id'     => $negotiation->vendor_id,
            'proposed_by'   => 'admin',
            'proposed_rate' => $request->proposed_rate,
            'message'       => $request->message,
            'status'        => 'pending',
        ]);

        return back()->with('success', "Counter-offer of {$request->proposed_rate}% sent to {$negotiation->vendor->business_name}.");
    }
}
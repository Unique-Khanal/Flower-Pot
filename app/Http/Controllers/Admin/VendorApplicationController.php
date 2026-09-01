<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VendorApplicationApproved;
use App\Models\Vendor;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Streams a vendor's PAN document from the private disk. This route
     * sits behind the admin.2fa-protected route group, so viewing a PAN
     * card requires an authenticated, verified admin session — not just
     * a guessable public URL.
     */
    public function panDocument(Vendor $vendor)
    {
        abort_unless($vendor->pan_document && Storage::disk('local')->exists($vendor->pan_document), 404);

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('local');

        return $disk->response($vendor->pan_document);
    }

    public function samplePhoto(Vendor $vendor, int $index)
    {
        $path = $vendor->sample_product_photos[$index] ?? null;

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('local');

        return $disk->response($path);
    }

    public function approve(Vendor $vendor): RedirectResponse
    {
        $vendor->update([
            'status'           => 'approved',
            'approved_at'      => now(),
            'rejection_reason' => null,
            'reviewed_by'      => Auth::id(),
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
            'reviewed_by'      => Auth::id(),
        ]);

        return back()->with('success', "{$vendor->business_name}'s application has been rejected.");
    }
}
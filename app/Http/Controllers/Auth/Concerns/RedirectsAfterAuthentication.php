<?php

namespace App\Http\Controllers\Auth\Concerns;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RedirectsAfterAuthentication
{
    /**
     * Checks vendor status ONLY — called immediately after credential
     * authentication, before any OTP is generated. Returns a blocking
     * redirect if the vendor isn't approved yet, or null if they're
     * clear to continue to the normal verified-email flow.
     */
    protected function blockedVendorResponse(Request $request, User $user): ?RedirectResponse
    {
        $vendor = $user->vendor;

        if (! $vendor || $vendor->status === 'pending') {
            return $this->blockAndReturnToLogin($request,
                'Your vendor application is still under review. We\'ll email you once it\'s approved.'
            );
        }

        if ($vendor->status === 'rejected') {
            return $this->blockAndReturnToLogin($request,
                'Your vendor application was not approved.'
                    . ($vendor->rejection_reason ? ' Reason: ' . $vendor->rejection_reason : '')
            );
        }

        if ($vendor->status === 'suspended') {
            return $this->blockAndReturnToLogin($request,
                'Your vendor account has been suspended. Contact support for details.'
            );
        }

        // status === 'approved' — allowed to continue
        return null;
    }

    /**
     * Decide where a freshly-authenticated (and, if a vendor, already
     * approved) user should land — used both right after password login
     * AND right after OTP verification.
     */
    protected function redirectAfterLogin(Request $request, User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.vendors.index'));
        }

        if ($user->isVendor()) {
            // Vendor status was already validated in blockedVendorResponse()
            // before we ever reach here — safe to send straight to dashboard.
            return redirect()->intended(route('vendor.dashboard'));
        }

        // Regular customer
        return redirect()->intended(route('home'));
    }

    protected function blockAndReturnToLogin(Request $request, string $message): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors(['email' => $message]);
    }
}
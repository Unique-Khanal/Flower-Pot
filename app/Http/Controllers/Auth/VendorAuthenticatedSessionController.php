<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VendorAuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('vendor.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        /** @var User $user */
        $user = $request->user();

        // Not a vendor account at all — reject, don't leak them into vendor area
        if (! $user->isVendor()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('vendor.login')
                ->withErrors(['email' => 'This account is not registered as a vendor.']);
        }

        $vendor = $user->vendor;

        // Whitelist approach: only an explicit 'approved' status passes.
        if (! $vendor || in_array($vendor->status, [null, '', 'pending'], true)) {
            return $this->blockAndReturnToVendorLogin($request,
                'Your vendor application is still under review. We\'ll email you once it\'s approved.'
            );
        }

        if ($vendor->status === 'rejected') {
            return $this->blockAndReturnToVendorLogin($request,
                'Your vendor application was not approved.'
                    . ($vendor->rejection_reason ? ' Reason: ' . $vendor->rejection_reason : '')
            );
        }

        if ($vendor->status === 'suspended') {
            return $this->blockAndReturnToVendorLogin($request,
                'Your vendor account has been suspended. Contact support for details.'
            );
        }

        if ($vendor->status !== 'approved') {
            return $this->blockAndReturnToVendorLogin($request,
                'Your vendor account status could not be verified. Please contact support.'
            );
        }

        return redirect()->intended(route('vendor.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }

    private function blockAndReturnToVendorLogin(Request $request, string $message): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login')->with('vendor_status_alert', $message);
    }
}
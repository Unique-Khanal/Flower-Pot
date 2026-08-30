<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        if (! $user->isVendor()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('vendor.login')
                ->withErrors(['email' => 'This account is not registered as a vendor.']);
        }

        $vendor = $user->vendor;

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

        // Approved — now confirm the email is verified via OTP before granting access
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('vendor.dashboard'));
        }

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));

        return redirect()->route('verification.notice');
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
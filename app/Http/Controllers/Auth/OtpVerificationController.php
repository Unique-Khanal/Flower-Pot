<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Concerns\RedirectsAfterAuthentication;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    use RedirectsAfterAuthentication;

    public function show(): View
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (! $user->otp_code || ! $user->otp_expires_at) {
            return back()->withErrors(['otp' => 'No verification code found. Please request a new one.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'This code has expired. Please request a new one.']);
        }

        if ($request->otp !== $user->otp_code) {
            return back()->withErrors(['otp' => 'Incorrect code. Please check and try again.']);
        }

        $user->update([
            'email_verified_at' => now(),
            'otp_code'          => null,
            'otp_expires_at'    => null,
        ]);

        // Refresh the auth session so hasVerifiedEmail() reflects the update immediately
        $user = $user->fresh();
        Auth::setUser($user);

        // Safety net: re-check vendor status here too, in case a vendor's
        // account somehow reaches the OTP screen before being approved.
        if ($user->isVendor()) {
            $blocked = $this->blockedVendorResponse($request, $user);

            if ($blocked) {
                return $blocked;
            }
        }

        return $this->redirectAfterLogin($request, $user);
    }

    public function resend(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
}
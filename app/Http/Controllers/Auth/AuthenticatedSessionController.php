<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Concerns\RedirectsAfterAuthentication;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use RedirectsAfterAuthentication;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        /** @var User $user */
        $user = $request->user();

        // Vendor status is checked FIRST — a pending/rejected/suspended vendor
        // gets blocked immediately, before any OTP is ever generated or sent.
        if ($user->isVendor()) {
            $blocked = $this->blockedVendorResponse($request, $user);

            if ($blocked) {
                return $blocked;
            }
        }

        // Past the vendor gate (or not a vendor at all) — now check verification
        if ($user->hasVerifiedEmail()) {
            return $this->redirectAfterLogin($request, $user);
        }

        // Not verified — generate a fresh OTP and email it now
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));

        return redirect()->route('verification.notice');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
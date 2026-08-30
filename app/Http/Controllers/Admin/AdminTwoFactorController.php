<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AdminTwoFactorController extends Controller
{
    public function show(): View|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user || ! $user->isAdmin()) {
            return redirect()->route('admin.login');
        }

        return view('admin.two-factor');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'string', 'size:6']]);

        /** @var User $user */
        $user = Auth::user();

        if (! $user || ! $user->isAdmin()) {
            return redirect()->route('admin.login');
        }

        if (! $user->otp_code || ! $user->otp_expires_at) {
            return back()->withErrors(['otp' => 'No verification code found. Please request a new one.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'This code has expired. Please request a new one.']);
        }

        if (! hash_equals((string) $user->otp_code, (string) $request->otp)) {
            return back()->withErrors(['otp' => 'Incorrect code. Please check and try again.']);
        }

        $user->forceFill(['otp_code' => null, 'otp_expires_at' => null])->save();

        // Second factor confirmed for this session — admin routes check this flag.
        $request->session()->put('admin_2fa_verified', true);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function resend(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user || ! $user->isAdmin()) {
            return redirect()->route('admin.login');
        }

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));

        return back()->with('status', 'A new code has been sent to your email.');
    }
}
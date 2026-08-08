<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PasswordResetOtpController extends Controller
{
    /**
     * Show the "enter email" form (reuses forgot-password.blade.php)
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle email submission — generate + send OTP
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
        ], [
            'email.exists' => 'This email is not registered. Please create an account first.',
        ]);

        /** @var User $user */
        $user = User::where('email', $request->email)->first();

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new PasswordResetOtpMail($otp, $user->name));

        // Store email in session so the next step knows who we're resetting
        session(['password_reset_email' => $user->email]);

        return redirect()->route('password.reset.otp.verify');
    }

    /**
     * Show the "enter OTP + new password" form
     */
    public function showVerifyForm(): View|RedirectResponse
    {
        if (! session('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password-otp');
    }

    /**
     * Verify OTP and update password
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $email = session('password_reset_email');

        if (! $email) {
            return redirect()->route('password.request')
                ->withErrors(['otp' => 'Session expired. Please start again.']);
        }

        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        /** @var User $user */
        $user = User::where('email', $email)->first();

        if (! $user || ! $user->otp_code || ! $user->otp_expires_at) {
            return back()->withErrors(['otp' => 'No reset code found. Please request a new one.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'This code has expired. Please request a new one.']);
        }

        if ($request->otp !== $user->otp_code) {
            return back()->withErrors(['otp' => 'Incorrect code. Please check and try again.']);
        }

        $user->update([
            'password'       => Hash::make($request->password),
            'otp_code'       => null,
            'otp_expires_at' => null,
        ]);

        session()->forget('password_reset_email');

        return redirect()->route('login')
            ->with('status', '🎉 Password reset successfully! Please log in with your new password.');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(): RedirectResponse
    {
        $email = session('password_reset_email');

        if (! $email) {
            return redirect()->route('password.request');
        }

        /** @var User $user */
        $user = User::where('email', $email)->first();

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new PasswordResetOtpMail($otp, $user->name));

        return back()->with('status', 'A new reset code has been sent to your email.');
    }
}
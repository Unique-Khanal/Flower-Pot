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

/**
 * Mirrors PasswordResetOtpController (customer flow) but scoped to admin
 * accounts only. Kept as a separate controller — rather than reusing the
 * customer one — for one important reason: this form must NEVER let
 * someone reset a non-admin user's password just by typing their email
 * into the admin login page. Every lookup below is constrained to
 * role = 'admin'.
 *
 * Uses its own session key (admin_password_reset_email) so an in-progress
 * admin reset never collides with a customer reset happening in another
 * tab on the same browser.
 */
class AdminPasswordResetOtpController extends Controller
{
    /**
     * Show the "enter email" form.
     */
    public function create(): View
    {
        return view('admin.forgot-password');
    }

    /**
     * Handle email submission — generate + send OTP, admin accounts only.
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        // Deliberately vague response either way: don't reveal whether an
        // email belongs to an admin account. If it does, send the OTP;
        // if not, silently do nothing and show the same confirmation.
        if ($user) {
            $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $user->update([
                'otp_code'       => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new PasswordResetOtpMail($otp, $user->name));
        }

        session(['admin_password_reset_email' => $request->email]);

        return redirect()->route('admin.password.reset.otp.verify');
    }

    /**
     * Show the "enter OTP + new password" form.
     */
    public function showVerifyForm(): View|RedirectResponse
    {
        if (! session('admin_password_reset_email')) {
            return redirect()->route('admin.password.request');
        }

        return view('admin.reset-password-otp');
    }

    /**
     * Verify OTP and update password (admin accounts only).
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $email = session('admin_password_reset_email');

        if (! $email) {
            return redirect()->route('admin.password.request')
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

        $user = User::where('email', $email)
            ->where('role', 'admin')
            ->first();

        if (! $user || ! $user->otp_code || ! $user->otp_expires_at) {
            return back()->withErrors(['otp' => 'No reset code found. Please request a new one.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'This code has expired. Please request a new one.']);
        }

        if (! hash_equals((string) $user->otp_code, (string) $request->otp)) {
            return back()->withErrors(['otp' => 'Incorrect code. Please check and try again.']);
        }

        $user->update([
            'password'       => Hash::make($request->password),
            'otp_code'       => null,
            'otp_expires_at' => null,
        ]);

        session()->forget('admin_password_reset_email');

        return redirect()->route('admin.login')
            ->with('status', '🎉 Password reset successfully! Please log in with your new password.');
    }

    /**
     * Resend OTP (admin accounts only).
     */
    public function resendOtp(): RedirectResponse
    {
        $email = session('admin_password_reset_email');

        if (! $email) {
            return redirect()->route('admin.password.request');
        }

        $user = User::where('email', $email)
            ->where('role', 'admin')
            ->first();

        if ($user) {
            $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $user->update([
                'otp_code'       => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new PasswordResetOtpMail($otp, $user->name));
        }

        return back()->with('status', 'If that email belongs to an admin account, a new code has been sent.');
    }
}
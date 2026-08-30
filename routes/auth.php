<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetOtpController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // ── OTP-based password reset (forgot password) ────────────
    Route::get('forgot-password', [PasswordResetOtpController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetOtpController::class, 'sendOtp'])
                ->name('password.email');

    Route::get('reset-password-otp', [PasswordResetOtpController::class, 'showVerifyForm'])
                ->name('password.reset.otp.verify');

    Route::post('reset-password-otp', [PasswordResetOtpController::class, 'resetPassword'])
                ->middleware('throttle:5,1')
                ->name('password.reset.otp.store');

    Route::post('reset-password-otp/resend', [PasswordResetOtpController::class, 'resendOtp'])
                ->middleware('throttle:5,1')
                ->name('password.reset.otp.resend');
});

Route::middleware('auth')->group(function () {
    // ── OTP-based email verification ──────────────────────────
    Route::get('verify-email', [OtpVerificationController::class, 'show'])
                ->name('verification.notice');

    Route::post('verify-email', [OtpVerificationController::class, 'verify'])
                ->middleware('throttle:5,1')
                ->name('verification.verify');

    Route::post('verify-email/resend', [OtpVerificationController::class, 'resend'])
                ->middleware('throttle:5,1')
                ->name('verification.send');

    // ── Update password while logged in (used on Profile page) ─
    Route::put('password', [PasswordController::class, 'update'])
                ->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
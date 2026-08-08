<x-guest-layout>
    <div class="text-center mb-7">
        <div style="font-size:3rem; margin-bottom:0.5rem;">🔒</div>
        <h1 class="text-2xl font-bold text-stone-800">Reset Your Password</h1>
        <p class="text-stone-500 text-sm mt-2">
            Enter the 6-digit code sent to your email, then choose a new password
        </p>
    </div>

    @if(session('status'))
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:0.75rem;
                    padding:0.75rem 1rem; margin-bottom:1.25rem;">
            <p style="font-size:0.85rem; color:#15803d; margin:0;">✅ {{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.reset.otp.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1.5">Verification Code</label>
            <div style="display:flex; justify-content:center;">
                <input type="text" name="otp" maxlength="6" inputmode="numeric" autocomplete="one-time-code"
                       placeholder="000000" autofocus
                       style="width:100%; max-width:220px; text-align:center; font-size:1.5rem;
                              letter-spacing:0.5rem; font-weight:700; padding:0.75rem;
                              border:2px solid #e7f3eb; border-radius:0.75rem; outline:none;
                              color:#166534;"
                       onfocus="this.style.borderColor='#15803d'"
                       onblur="this.style.borderColor='#e7f3eb'">
            </div>
            @error('otp')
                <p style="font-size:0.78rem; color:#b91c1c; text-align:center; margin-top:0.5rem;">
                    ✕ {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">New Password</label>
            <input id="password" type="password" name="password"
                   class="auth-input" placeholder="Min. 8 characters"
                   required autocomplete="new-password">
            @error('password')
                <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-stone-700 mb-1.5">
                Confirm New Password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="auth-input" placeholder="Repeat new password"
                   required autocomplete="new-password">
        </div>

        <button type="submit" class="auth-btn">
            Reset Password →
        </button>
    </form>

    <form method="POST" action="{{ route('password.reset.otp.resend') }}" style="margin-top:0.75rem;">
        @csrf
        <button type="submit"
                style="width:100%; background:#f0fdf4; color:#166534; font-weight:600;
                       padding:0.7rem; border-radius:0.75rem; border:1px solid #bbf7d0; cursor:pointer;">
            Resend Code
        </button>
    </form>

    <p class="text-center text-sm text-stone-500 pt-4">
        Remembered your password?
        <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:text-green-900 transition">
            Back to Login
        </a>
    </p>
</x-guest-layout>
<x-admin-guest-layout>
    <div class="mb-8">
        <span class="inline-block text-[10px] font-bold tracking-[0.2em] uppercase text-[#8A6B1F] bg-[#FBF3E1] px-3 py-1 rounded-full mb-3">
            Admin Portal
        </span>
        <h1 class="text-3xl font-extrabold text-[#1B3B2F] leading-tight">Reset your password</h1>
        <p class="text-stone-500 text-sm mt-2">Enter the 6-digit code sent to your email, then choose a new password.</p>
    </div>

    @if(session('status'))
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:0.75rem;
                    padding:0.75rem 1rem; margin-bottom:1.25rem;">
            <p style="font-size:0.85rem; color:#15803d; margin:0;">✅ {{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.reset.otp.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1.5">Verification Code</label>
            <div style="display:flex; justify-content:center;">
                <input type="text" name="otp" maxlength="6" inputmode="numeric" autocomplete="one-time-code"
                       placeholder="000000" autofocus
                       style="width:100%; max-width:220px; text-align:center; font-size:1.5rem;
                              letter-spacing:0.5rem; font-weight:700; padding:0.75rem;
                              border:2px solid #e7f3eb; border-radius:0.75rem; outline:none;
                              color:#1B3B2F;"
                       onfocus="this.style.borderColor='#1B3B2F'"
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
                   class="admin-auth-input" placeholder="Min. 8 characters"
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
                   class="admin-auth-input" placeholder="Repeat new password"
                   required autocomplete="new-password">
        </div>

        <button type="submit"
                class="w-full bg-[#1B3B2F] hover:bg-[#0F2A20] text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-[#1B3B2F]/20 flex items-center justify-center gap-2">
            Reset Password <span>→</span>
        </button>
    </form>

    <form method="POST" action="{{ route('admin.password.reset.otp.resend') }}" style="margin-top:0.75rem;">
        @csrf
        <button type="submit"
                style="width:100%; background:#FBF3E1; color:#8A6B1F; font-weight:600;
                       padding:0.7rem; border-radius:0.75rem; border:1px solid #f0e2bd; cursor:pointer;">
            Resend Code
        </button>
    </form>

    <p class="text-center text-sm text-stone-500 pt-6">
        Remembered your password?
        <a href="{{ route('admin.login') }}" class="text-[#1B3B2F] font-semibold hover:underline">
            Back to Login
        </a>
    </p>
</x-admin-guest-layout>
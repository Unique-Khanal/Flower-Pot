<x-guest-layout>
    <div class="text-center mb-7">
        <div style="font-size:3rem; margin-bottom:0.5rem;">📧</div>
        <h1 class="text-2xl font-bold text-stone-800">Verify Your Email</h1>
        <p class="text-stone-500 text-sm mt-2">
            We sent a 6-digit code to <strong>{{ auth()->user()->email }}</strong>
        </p>
    </div>

    @if(session('status'))
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:0.75rem;
                    padding:0.75rem 1rem; margin-bottom:1.25rem;">
            <p style="font-size:0.85rem; color:#15803d; margin:0;">✅ {{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf

        <div style="display:flex; justify-content:center; gap:0.5rem; margin-bottom:1rem;">
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
            <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:0.75rem;
                        padding:0.6rem 1rem; margin-bottom:1rem; text-align:center;">
                <p style="font-size:0.8rem; color:#b91c1c; margin:0;">✕ {{ $message }}</p>
            </div>
        @enderror

        <button type="submit"
                style="width:100%; background:#15803d; color:white; font-weight:700;
                       padding:0.75rem; border-radius:0.75rem; border:none; cursor:pointer;">
            Verify Email
        </button>
    </form>

    <form method="POST" action="{{ route('verification.send') }}" style="margin-top:0.75rem;">
        @csrf
        <button type="submit"
                style="width:100%; background:#f0fdf4; color:#166534; font-weight:600;
                       padding:0.7rem; border-radius:0.75rem; border:1px solid #bbf7d0; cursor:pointer;">
            Resend Code
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:0.75rem;">
        @csrf
        <button type="submit"
                style="width:100%; background:none; color:#78716c; font-size:0.85rem;
                       padding:0.5rem; border:none; cursor:pointer;">
            Log Out
        </button>
    </form>
</x-guest-layout>
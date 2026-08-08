<x-guest-layout>
    <div class="text-center mb-7">
        <div style="font-size:3rem; margin-bottom:0.5rem;">📧</div>
        <h1 class="text-2xl font-bold text-stone-800">Verify Your Email</h1>
        <p class="text-stone-500 text-sm mt-2 leading-relaxed">
            Thanks for signing up! Before getting started, please verify your
            email address by clicking the link we just sent you.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:0.75rem;
                    padding:0.75rem 1rem; margin-bottom:1.25rem;">
            <p style="font-size:0.85rem; color:#15803d; margin:0;">
                ✅ A new verification link has been sent to your email address.
            </p>
        </div>
    @endif

    <div style="display:flex; flex-direction:column; gap:0.75rem;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    style="width:100%; background:#15803d; color:white; font-weight:700;
                           padding:0.75rem; border-radius:0.75rem; border:none; cursor:pointer;">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%; background:#f5f5f4; color:#44403c; font-weight:600;
                           padding:0.75rem; border-radius:0.75rem; border:none; cursor:pointer;">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
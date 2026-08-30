<x-admin-guest-layout>
    <div class="mb-8">
        <span class="inline-block text-[10px] font-bold tracking-[0.2em] uppercase text-[#8A6B1F] bg-[#FBF3E1] px-3 py-1 rounded-full mb-3">
            Step 2 of 2 · Verification
        </span>
        <h1 class="text-3xl font-extrabold text-[#1B3B2F] leading-tight">Check your email</h1>
        <p class="text-stone-500 text-sm mt-2">We sent a 6-digit code to your email. It expires in 10 minutes.</p>
    </div>

    @if (session('status'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-5 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.2fa.verify') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="otp" value="6-Digit Code" />
            <x-text-input id="otp" name="otp" type="text" inputmode="numeric" maxlength="6" autocomplete="one-time-code"
                          class="mt-1.5 block w-full text-center text-3xl tracking-[0.5em] font-bold border-stone-200 rounded-xl focus:border-[#2F6B4F] focus:ring-[#2F6B4F] py-3"
                          required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <button type="submit"
                class="w-full bg-[#1B3B2F] hover:bg-[#0F2A20] text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-[#1B3B2F]/20">
            Verify &amp; Continue
        </button>
    </form>

    <form method="POST" action="{{ route('admin.2fa.resend') }}" class="mt-5 text-center">
        @csrf
        <button type="submit" class="text-sm text-stone-500 hover:text-[#2F6B4F] font-medium underline underline-offset-2">
            Didn't get a code? Resend
        </button>
    </form>
</x-admin-guest-layout>
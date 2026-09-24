<x-admin-guest-layout>
    <div class="mb-8">
        <span class="inline-block text-[10px] font-bold tracking-[0.2em] uppercase text-[#8A6B1F] bg-[#FBF3E1] px-3 py-1 rounded-full mb-3">
            Admin Portal
        </span>
        <h1 class="text-3xl font-extrabold text-[#1B3B2F] leading-tight">Forgot password?</h1>
        <p class="text-stone-500 text-sm mt-2">Enter your admin email and we'll send a 6-digit code to reset it.</p>
    </div>

    <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="admin-auth-input" required autofocus autocomplete="username" placeholder="you@biruwa.com">
            @error('email')
                <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-[#1B3B2F] hover:bg-[#0F2A20] text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-[#1B3B2F]/20 flex items-center justify-center gap-2">
            Send Reset Code <span>→</span>
        </button>
    </form>

    <p class="text-center text-sm text-stone-500 pt-6">
        Remembered your password?
        <a href="{{ route('admin.login') }}" class="text-[#1B3B2F] font-semibold hover:underline">
            Back to Login
        </a>
    </p>
</x-admin-guest-layout>
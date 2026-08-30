<x-admin-guest-layout>
    <div class="mb-8">
        <span class="inline-block text-[10px] font-bold tracking-[0.2em] uppercase text-[#8A6B1F] bg-[#FBF3E1] px-3 py-1 rounded-full mb-3">
            Admin Portal
        </span>
        <h1 class="text-3xl font-extrabold text-[#1B3B2F] leading-tight">Welcome back</h1>
        <p class="text-stone-500 text-sm mt-2">Sign in to manage vendors, orders and the catalog.</p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="admin-auth-input" required autofocus autocomplete="username" placeholder="you@biruwa.com">
            @error('email')
                <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password"
                   class="admin-auth-input" required autocomplete="current-password" placeholder="••••••••">
        </div>

        <button type="submit"
                class="w-full bg-[#1B3B2F] hover:bg-[#0F2A20] text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-[#1B3B2F]/20 flex items-center justify-center gap-2">
            Log In <span>→</span>
        </button>
    </form>

    <p class="text-center text-xs text-stone-400 mt-8">
        Protected by two-factor authentication · Biruwa internal use only
    </p>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Notice',
                text: @json(session('status')),
                icon: 'warning',
                confirmButtonText: 'Okay',
                confirmButtonColor: '#166534',
                customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-6' }
            });
        });
    </script>
    @endif
</x-admin-guest-layout>
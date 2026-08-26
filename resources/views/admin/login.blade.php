<x-guest-layout>
    <div class="text-center mb-7">
        <img src="{{ asset('images/logo.png') }}" alt="Biruwa" class="h-14 w-auto mx-auto mb-3 object-contain">
        <span class="inline-block text-[10px] font-bold tracking-[0.2em] uppercase text-[#8A6B1F] bg-[#FBF3E1] px-3 py-1 rounded-full mb-2">
            Admin Portal
        </span>
        <h1 class="text-2xl font-bold text-stone-800">Admin Login</h1>
        <p class="text-stone-500 text-sm mt-1">Biruwa administration panel</p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="auth-input" required autofocus autocomplete="username">
            @error('email')
                <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password"
                   class="auth-input" required autocomplete="current-password">
        </div>

        <button type="submit" class="auth-btn">Log In →</button>
    </form>

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
</x-guest-layout>
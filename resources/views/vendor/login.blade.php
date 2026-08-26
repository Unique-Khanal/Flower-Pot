<x-guest-layout>
    <div class="text-center mb-7">
        <img src="{{ asset('images/vendor-logo.svg') }}" alt="Biruwa Vendor Portal" class="h-14 w-auto mx-auto mb-3 object-contain">
        <span class="inline-block text-[10px] font-bold tracking-[0.2em] uppercase text-[#2F6B4F] bg-[#E9F2EA] px-3 py-1 rounded-full mb-2">
            Vendor Portal
        </span>
        <h1 class="text-2xl font-bold text-stone-800">Vendor Login</h1>
        <p class="text-stone-500 text-sm mt-1">Log in to your Biruwa vendor account</p>
    </div>

    <form method="POST" action="{{ route('vendor.login') }}" class="space-y-5">
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

        <p class="text-center text-sm text-stone-500 pt-2">
            Don't have a vendor account?
            <a href="{{ route('vendor.register') }}" class="text-green-700 font-semibold hover:text-green-900">
                Apply here
            </a>
        </p>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('vendor_application_submitted'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '🎉 Application Submitted!',
                html: `
                    <p style="color:#57534e; font-size:0.9rem; line-height:1.6;">
                        {{ session('vendor_application_submitted') }}
                    </p>
                `,
                icon: 'success',
                confirmButtonText: 'Got it',
                confirmButtonColor: '#166534',
                customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-6' }
            });
        });
    </script>
    @endif

    @if(session('vendor_status_alert'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Account Status',
                text: @json(session('vendor_status_alert')),
                icon: 'info',
                confirmButtonText: 'Okay',
                confirmButtonColor: '#166534',
                customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-6' }
            });
        });
    </script>
    @endif

    @if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Wrong Login Page',
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
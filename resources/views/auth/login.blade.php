<x-guest-layout>

    <div class="text-center mb-7">
        <h1 class="text-2xl font-bold text-stone-800">Welcome Back 🌿</h1>
        <p class="text-stone-500 text-sm mt-1">Sign in to your FlowerPot account</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">
                Email Address
            </label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       class="auth-input" placeholder="you@example.com"
                       required autofocus autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-sm font-semibold text-stone-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs text-green-700 hover:text-green-900 font-medium transition">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input id="password" type="password" name="password"
                       class="auth-input" placeholder="••••••••"
                       required autocomplete="current-password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
            <label for="remember_me" class="text-sm text-stone-600">Remember me</label>
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn">
            Sign In →
        </button>

        <!-- Register link -->
        <p class="text-center text-sm text-stone-500 pt-1">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-green-700 font-semibold hover:text-green-900 transition">
                Create one
            </a>
        </p>

    </form>
</x-guest-layout>
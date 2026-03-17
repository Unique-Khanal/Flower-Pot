<x-guest-layout>

    <div class="text-center mb-7">
        <h1 class="text-2xl font-bold text-stone-800">Create Account 🌱</h1>
        <p class="text-stone-500 text-sm mt-1">Join FlowerPot and bring nature home</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">Full Name</label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <input id="name" type="text" name="name"
                       value="{{ old('name') }}"
                       class="auth-input" placeholder="Your full name"
                       required autofocus autocomplete="name">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Gender -->
        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-2">Gender</label>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="gender" value="male"
                           class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500"
                           {{ old('gender') == 'male' ? 'checked' : '' }} required>
                    <span class="text-sm text-stone-700 font-medium">Male</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="gender" value="female"
                           class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500"
                           {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <span class="text-sm text-stone-700 font-medium">Female</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-1.5" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email Address</label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       class="auth-input" placeholder="you@example.com"
                       required autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Password</label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input id="password" type="password" name="password"
                       class="auth-input" placeholder="Min. 8 characters"
                       required autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-stone-700 mb-1.5">
                Confirm Password
            </label>
            <div class="relative">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="auth-input" placeholder="Repeat your password"
                       required autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn">
            Create Account →
        </button>

        <p class="text-center text-sm text-stone-500 pt-1">
            Already have an account?
            <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:text-green-900 transition">
                Sign in
            </a>
        </p>

    </form>
</x-guest-layout>
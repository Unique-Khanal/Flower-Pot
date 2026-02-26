@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')

<section class="min-h-screen bg-green-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="text-6xl mb-3">🌸</div>
            <h2 class="text-3xl font-extrabold text-gray-800">Admin Login</h2>
            <p class="text-gray-500 mt-2 text-sm">Sign in to manage your FlowerPot store</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form method="POST" action="#" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        placeholder="admin@flowerpot.pk"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                    >
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <span class="text-sm text-gray-600">Remember Me</span>
                    </label>
                    <a href="#" class="text-sm text-green-700 hover:text-green-800 font-medium">Forgot Password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-lg transition shadow-md text-sm">
                    Sign In →
                </button>
            </form>
        </div>

        <p class="text-center text-gray-400 text-xs mt-6">
            &copy; {{ date('Y') }} FlowerPot. All rights reserved.
        </p>
    </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')

<section class="min-h-screen bg-green-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <svg width="56" height="56" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="21" cy="7" r="3.5" fill="#fcd34d"/>
                    <circle cx="27" cy="9" r="3" fill="#86efac"/>
                    <circle cx="15" cy="9" r="3" fill="#86efac"/>
                    <circle cx="27" cy="5" r="2.5" fill="#4ade80"/>
                    <circle cx="15" cy="5" r="2.5" fill="#4ade80"/>
                    <circle cx="21" cy="7" r="2" fill="#f59e0b"/>
                    <rect x="19.5" y="10" width="3" height="8" rx="1.5" fill="#22c55e"/>
                    <ellipse cx="21" cy="18.5" rx="8.5" ry="2" fill="#92400e"/>
                    <rect x="10" y="18" width="22" height="4" rx="2" fill="#b45309"/>
                    <path d="M12 22 L14.5 38 H27.5 L30 22 Z" fill="#d97706"/>
                    <path d="M14 24 L15 34" stroke="#fbbf24" stroke-width="1.5" stroke-linecap="round" opacity="0.5"/>
                </svg>
            </div>
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

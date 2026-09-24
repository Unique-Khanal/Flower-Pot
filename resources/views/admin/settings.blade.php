@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Account Settings</h1>
        <p class="text-sm text-stone-500 mt-1">Manage your admin profile and password</p>
    </div>

    {{-- ── PROFILE SUMMARY CARD ── --}}
    <div class="bg-gradient-to-br from-[#1B3B2F] to-[#2F6B4F] rounded-2xl shadow-sm p-6 mb-6 flex items-center gap-5">
        <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center flex-shrink-0 border border-white/20 overflow-hidden">
            <x-avatar :avatar="$user->avatar" :size="64" />
        </div>
        <div class="min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
                <h2 class="text-lg font-bold text-white truncate">{{ $user->name }}</h2>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wide bg-white/15 text-white px-2 py-0.5 rounded-full">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25 4.5 5.25v6c0 5.114 3.288 9.36 7.5 10.5 4.212-1.14 7.5-5.386 7.5-10.5v-6L12 2.25Z"/></svg>
                    Administrator
                </span>
            </div>
            <p class="text-sm text-white/70 truncate">{{ $user->email }}</p>
            @if($user->created_at)
                <p class="text-xs text-white/50 mt-1">Admin since {{ $user->created_at->format('M Y') }}</p>
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- ── PROFILE INFORMATION ── --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4 text-[#2F6B4F]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-stone-800">Profile Information</h3>
                    <p class="text-xs text-stone-400">Your name as shown across the admin panel</p>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required>
                    @error('name')
                        <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
                    <div class="relative">
                        <input type="email" value="{{ $user->email }}" disabled
                               class="w-full rounded-xl border-stone-200 bg-stone-50 text-sm text-stone-500 pr-9">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4 text-stone-300 absolute right-3 top-1/2 -translate-y-1/2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                    </div>
                    <p class="text-xs text-stone-400 mt-1.5">Email cannot be changed here — contact a super admin.</p>
                </div>
            </div>
        </div>

        {{-- ── SECURITY ── --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4 text-amber-600"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-stone-800">Change Password</h3>
                    <p class="text-xs text-stone-400">Leave blank to keep your current password</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1">Current Password</label>
                    <input type="password" name="current_password" placeholder="••••••••"
                           class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                    @error('current_password')
                        <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
                    @enderror
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">New Password</label>
                        <input type="password" name="password" placeholder="••••••••"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                        @error('password')
                            <p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <button type="submit" class="bg-[#2F6B4F] hover:bg-[#1B3B2F] text-white font-bold px-6 py-2.5 rounded-xl transition text-sm shadow-sm">
                Save Changes
            </button>
        </div>
    </form>

</div>
@endsection
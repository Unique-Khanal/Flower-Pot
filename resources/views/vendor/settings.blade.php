@extends('layouts.vendor')

@section('title', 'Store Settings')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Store Settings</h1>
        <p class="text-sm text-stone-500 mt-1">Manage your account and business details</p>
    </div>

    <div class="bg-white rounded-2xl p-6" style="border:1px solid #EDE7D6;">
        <form method="POST" action="{{ route('vendor.settings.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Your Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required>
                @error('name')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
                <input type="email" value="{{ $user->email }}" disabled
                       class="w-full rounded-xl border-stone-200 bg-stone-50 text-sm text-stone-500">
            </div>

            <div class="border-t border-stone-100 pt-5">
                <p class="text-sm font-semibold text-stone-700 mb-3">Business Details</p>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Business Name</label>
                        <input type="text" name="business_name" value="{{ old('business_name', $vendor->business_name) }}"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required>
                        @error('business_name')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Business Phone</label>
                        <input type="text" name="business_phone" value="{{ old('business_phone', $vendor->business_phone) }}"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required>
                        @error('business_phone')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Business Address</label>
                        <textarea name="business_address" rows="2"
                                  class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]" required>{{ old('business_address', $vendor->business_address) }}</textarea>
                        @error('business_address')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-stone-100 pt-5">
                <p class="text-sm font-semibold text-stone-700 mb-3">Bank Details (for payouts)</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $vendor->bank_name) }}"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                        @error('bank_name')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Account Number</label>
                        <input type="text" name="bank_account_no" value="{{ old('bank_account_no', $vendor->bank_account_no) }}"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                    </div>
                </div>
            </div>

            <div class="border-t border-stone-100 pt-5">
                <p class="text-sm font-semibold text-stone-700 mb-3">Change Password (optional)</p>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Current Password</label>
                        <input type="password" name="current_password"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                        @error('current_password')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">New Password</label>
                        <input type="password" name="password"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                        @error('password')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full rounded-xl border-stone-300 text-sm focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                        @error('password_confirmation')<p style="font-size:0.78rem; color:#b91c1c; margin-top:0.4rem;">✕ {{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-[#2F6B4F] hover:bg-[#1B3B2F] text-white font-bold px-6 py-2.5 rounded-xl transition text-sm">
                Save Changes
            </button>
        </form>
    </div>

</div>
@endsection
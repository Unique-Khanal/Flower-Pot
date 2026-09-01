@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="mb-7 rounded-2xl px-6 py-6 flex items-center justify-between overflow-hidden relative"
         style="background: linear-gradient(120deg,#3F6B54 0%,#2E5442 60%,#1F3D2F 140%);">
        <div class="absolute -right-8 -top-10 w-40 h-40 rounded-full opacity-25" style="background:#EF8E31; filter:blur(45px);"></div>
        <div class="absolute right-24 -bottom-14 w-32 h-32 rounded-full opacity-15" style="background:#C89116; filter:blur(40px);"></div>
        <div class="relative z-10">
            <p class="text-[10px] font-bold tracking-[0.2em] uppercase text-[#E8B54A] mb-1">
                {{ now()->format('l, F j') }}
            </p>
            <h1 class="text-2xl font-extrabold text-white">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}</h1>
            <p class="text-sm text-[#B9CBBB] mt-1">Here's what's happening across Biruwa today.</p>
        </div>
        <div class="relative z-10 h-14 w-14 rounded-2xl shadow-lg hidden sm:flex items-center justify-center" style="background:linear-gradient(135deg,#EF8E31,#C9711F);">
            <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.5-3-7.5-6.5-7.5-10.5A7.5 7.5 0 0 1 12 3a7.5 7.5 0 0 1 7.5 7.5c0 4-3 7.5-7.5 10.5Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <a href="{{ route('admin.vendors.index', ['status' => 'pending']) }}" class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg></div>
            <div>
                <div class="text-xs text-stone-500">Pending Applications</div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['pending_vendors'] }}</div>
            </div>
        </a>

        <a href="{{ route('admin.commission-negotiations.index') }}" class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m3-9L21 12m0 0-4.5 4.5M21 12H7.5"/></svg></div>
            <div>
                <div class="text-xs text-stone-500">Commission Requests</div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['pending_negotiations'] }}</div>
            </div>
        </a>

        <a href="{{ route('admin.vendors.directory', ['status' => 'approved']) }}" class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#15803D" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg></div>
            <div>
                <div class="text-xs text-stone-500">Approved Vendors</div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['approved_vendors'] }}</div>
            </div>
        </a>

        <a href="{{ route('admin.vendors.directory', ['status' => 'suspended']) }}" class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/></svg></div>
            <div>
                <div class="text-xs text-stone-500">Suspended Vendors</div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['suspended_vendors'] }}</div>
            </div>
        </a>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#15803D" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5 12 3 3 7.5m18 0-9 4.5m9-4.5v9L12 21m0-9L3 7.5m9 4.5v9m-9-9v9l9 4.5"/></svg></div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['total_products'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">{{ $stats['platform_products'] }} platform · {{ $stats['vendor_products'] }} vendor</div>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-9M3.75 7.5 5.106 4.79A1.5 1.5 0 0 1 6.447 4h11.106a1.5 1.5 0 0 1 1.341.79L20.25 7.5m-16.5 0h16.5M9.75 11.25h4.5"/></svg></div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['low_stock_products'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">Low stock (≤ 5 units)</div>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg></div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['total_users'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">{{ $stats['total_vendors_users'] }} vendor accounts</div>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="1.6" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg></div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['unread_contacts'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">Contact messages</div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#1B3B2F]">Recent vendor applications</h2>
                <a href="{{ route('admin.vendors.index') }}" class="text-xs font-bold text-green-700 hover:underline">View all →</a>
            </div>
            @forelse ($recentVendors as $vendor)
                <div class="flex items-center justify-between py-2.5 border-b border-stone-50 last:border-0">
                    <div>
                        <div class="text-sm font-semibold text-stone-800">{{ $vendor->business_name }}</div>
                        <div class="text-xs text-stone-400">{{ $vendor->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                        {{ match($vendor->status) {
                            'pending'   => 'bg-amber-100 text-amber-700',
                            'approved'  => 'bg-green-100 text-green-700',
                            'rejected'  => 'bg-red-100 text-red-700',
                            'suspended' => 'bg-stone-200 text-stone-600',
                            default     => 'bg-stone-100 text-stone-600',
                        } }}">
                        {{ $vendor->status }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-stone-400 py-6 text-center">No vendor applications yet.</p>
            @endforelse
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#1B3B2F]">Pending commission requests</h2>
                <a href="{{ route('admin.commission-negotiations.index') }}" class="text-xs font-bold text-green-700 hover:underline">View all →</a>
            </div>
            @forelse ($recentNegotiations as $negotiation)
                <div class="flex items-center justify-between py-2.5 border-b border-stone-50 last:border-0">
                    <div>
                        <div class="text-sm font-semibold text-stone-800">{{ $negotiation->vendor->business_name ?? '—' }}</div>
                        <div class="text-xs text-stone-400">Proposed {{ $negotiation->proposed_rate }}% · {{ $negotiation->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">pending</span>
                </div>
            @empty
                <p class="text-sm text-stone-400 py-6 text-center">No pending negotiations.</p>
            @endforelse
        </div>

    </div>
</div>
@endsection
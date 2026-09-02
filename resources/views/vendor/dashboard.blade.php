@extends('layouts.vendor')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Dashboard</h1>
        <p class="text-sm text-stone-500 mt-1">Welcome back, {{ $vendor->business_name }}</p>
    </div>

    {{-- ── STAT ROW 1 ── --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">

        <div class="stat-card bg-white rounded-2xl p-5 flex items-center gap-4" style="border:1px solid #EDE7D6;">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#EFF5EE;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2F6B4F" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4M8 5l1.5 2M16 5l-1.5 2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 10a5 5 0 0 1 10 0c0 3-2 5-2 8H9c0-3-2-5-2-8Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6"/></svg>
            </div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['total_products'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">Products listed</div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5 flex items-center gap-4" style="border:1px solid #EDE7D6;">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#FBF3E1;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8A6B1F" stroke-width="1.6"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/></svg>
            </div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['pending_orders'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">Pending orders</div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5 flex items-center gap-4" style="border:1px solid #EDE7D6;">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#FBEAE4;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#B23B2E" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01"/></svg>
            </div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['low_stock'] }}</div>
                <div class="text-xs text-stone-500 mt-0.5">Low stock (≤ 5)</div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5 flex items-center gap-4" style="border:1px solid #EDE7D6;">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#FFF7E0;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C89B3C" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="m11.48 3.499 2.325 4.995 5.51.804a.563.563 0 0 1 .312.96l-3.987 3.89.941 5.483a.562.562 0 0 1-.816.592l-4.924-2.59-4.924 2.59a.562.562 0 0 1-.816-.592l.94-5.483-3.986-3.89a.563.563 0 0 1 .312-.96l5.51-.804 2.324-4.995a.563.563 0 0 1 1.018 0Z"/></svg>
            </div>
            <div>
                <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $stats['avg_rating'] }}<span class="text-sm text-stone-400 font-medium">/5</span></div>
                <div class="text-xs text-stone-500 mt-0.5">{{ $stats['total_reviews'] }} reviews</div>
            </div>
        </div>

    </div>

    {{-- ── STAT ROW 2 — earnings ── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        <div class="stat-card bg-white rounded-2xl p-5" style="border:1px solid #EDE7D6;">
            <div class="text-xs text-stone-500 mb-1">Commission rate</div>
            <div class="text-2xl font-extrabold text-[#1B3B2F]">{{ $vendor->commission_rate }}%</div>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5" style="border:1px solid #EDE7D6;">
            <div class="text-xs text-stone-500 mb-1">Total earned (paid)</div>
            <div class="text-2xl font-extrabold text-[#2F6B4F]">Rs. {{ number_format($stats['total_earned'], 2) }}</div>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5" style="border:1px solid #EDE7D6;">
            <div class="text-xs text-stone-500 mb-1">Pending payout</div>
            <div class="text-2xl font-extrabold text-[#C89B3C]">Rs. {{ number_format($stats['pending_payout'], 2) }}</div>
        </div>

    </div>

    <div class="grid lg:grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-2xl p-6" style="border:1px solid #EDE7D6;">
            <h2 class="font-bold text-[#1B3B2F] mb-4">Recent order items</h2>
            @forelse ($recentOrderItems as $item)
                <div class="flex items-center justify-between py-2.5" style="border-bottom:1px solid #F5F1E4;">
                    <div>
                        <div class="text-sm font-semibold text-stone-800">{{ $item->product_name }}</div>
                        <div class="text-xs text-stone-400">Order #{{ $item->order_id }} · {{ $item->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                        {{ match($item->vendor_status) {
                            'pending'    => 'bg-amber-100 text-amber-700',
                            'processing' => 'bg-blue-100 text-blue-700',
                            'shipped'    => 'bg-indigo-100 text-indigo-700',
                            'delivered'  => 'bg-green-100 text-green-700',
                            'cancelled'  => 'bg-red-100 text-red-700',
                            default      => 'bg-stone-100 text-stone-600',
                        } }}">
                        {{ $item->vendor_status }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-stone-400 py-6 text-center">No orders yet.</p>
            @endforelse
        </div>

        <div class="bg-white rounded-2xl p-6" style="border:1px solid #EDE7D6;">
            <h2 class="font-bold text-[#1B3B2F] mb-4">Recent reviews</h2>
            @forelse ($recentReviews as $review)
                <div class="py-2.5" style="border-bottom:1px solid #F5F1E4;">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-semibold text-stone-800">{{ $review->product->name ?? '—' }}</div>
                        <div class="text-xs text-amber-500">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
                    </div>
                    <p class="text-xs text-stone-500 mt-1">{{ Str::limit($review->comment, 90) }}</p>
                </div>
            @empty
                <p class="text-sm text-stone-400 py-6 text-center">No reviews yet.</p>
            @endforelse
        </div>

    </div>

    {{-- ── COMMISSION SECTION (kept from before) ── --}}
    <div id="commission" class="bg-white rounded-2xl p-6" style="border:1px solid #EDE7D6;">
        <h2 class="text-lg font-bold text-[#1B3B2F] mb-2">Commission Rate</h2>
        <p class="text-sm text-stone-600 mb-4">
            Current rate: <strong style="color:#166534;">{{ $vendor->commission_rate }}%</strong>
        </p>

        @if($pendingFromAdmin)
            <div style="background:#fef3c7; border:1px solid #fde68a; border-radius:0.75rem; padding:1rem; margin-bottom:1rem;">
                <p class="text-sm font-semibold text-amber-800">
                    Admin proposed {{ $pendingFromAdmin->proposed_rate }}%
                </p>
                @if($pendingFromAdmin->message)
                    <p class="text-xs text-amber-700 mt-1">"{{ $pendingFromAdmin->message }}"</p>
                @endif
                <div class="flex gap-2 mt-3">
                    <form method="POST" action="{{ route('vendor.commission.accept', $pendingFromAdmin) }}">
                        @csrf
                        <button type="submit" class="text-xs bg-green-700 text-white font-semibold px-4 py-2 rounded-lg">
                            Accept {{ $pendingFromAdmin->proposed_rate }}%
                        </button>
                    </form>
                    <form method="POST" action="{{ route('vendor.commission.reject', $pendingFromAdmin) }}">
                        @csrf
                        <button type="submit" class="text-xs bg-stone-100 text-stone-700 font-semibold px-4 py-2 rounded-lg">
                            Decline
                        </button>
                    </form>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('vendor.commission.propose') }}" class="space-y-3">
                @csrf
                <div>
                    <label class="text-xs font-semibold text-stone-600">Propose a new rate (%)</label>
                    <input type="number" name="proposed_rate" step="0.01" min="0" max="100" required
                           class="mt-1 block w-full rounded-lg border-stone-300 text-sm" placeholder="e.g. 8.00">
                </div>
                <div>
                    <label class="text-xs font-semibold text-stone-600">Message (optional)</label>
                    <textarea name="message" rows="2" class="mt-1 block w-full rounded-lg border-stone-300 text-sm"
                              placeholder="Why you're requesting this rate..."></textarea>
                </div>
                <button type="submit" class="bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                    Send Proposal
                </button>
            </form>
        @endif
    </div>

</div>
@endsection
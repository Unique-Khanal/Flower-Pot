@extends('layouts.vendor')
@section('title', 'Payouts')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Payouts</h1>
        <p class="text-sm text-stone-500 mt-1">Your earnings after Biruwa's {{ number_format($vendor->commission_rate, 1) }}% commission.</p>
    </div>

    {{-- ── CURRENT UNPAID SUMMARY ── --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
        <h2 class="text-sm font-bold text-stone-800 mb-4">Since your last payout</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
            <div>
                <p class="text-xs text-stone-400 mb-1">Your Sales</p>
                <p class="text-xl font-extrabold text-stone-800">Rs. {{ number_format($unpaidSales, 2) }}</p>
            </div>
            <div>
                <p class="text-xs text-stone-400 mb-1">Commission Deducted</p>
                <p class="text-xl font-extrabold text-stone-500">− Rs. {{ number_format($unpaidCommission, 2) }}</p>
            </div>
            <div>
                <p class="text-xs text-stone-400 mb-1">You'll Receive</p>
                <p class="text-xl font-extrabold text-[#2F6B4F]">Rs. {{ number_format($unpaidPayout, 2) }}</p>
            </div>
        </div>
        <p class="text-xs text-stone-400 text-center mt-4">
            @if ($unpaidCount > 0)
                Based on {{ $unpaidCount }} delivered order item{{ $unpaidCount === 1 ? '' : 's' }} not yet included in a payout.
                This is a running estimate — Biruwa's admin generates and transfers the actual payout.
            @else
                No delivered sales awaiting payout right now.
            @endif
        </p>
    </div>

    {{-- ── PAYOUT HISTORY ── --}}
    <h2 class="text-sm font-bold text-stone-700 mb-3">Payout History</h2>

    @if ($payouts->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-10 text-center text-stone-400">
            You haven't received a payout yet.
        </div>
    @else
        <div class="space-y-3">
            @foreach ($payouts as $payout)
                <div class="bg-white rounded-2xl shadow-sm p-5 flex items-center justify-between flex-wrap gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-extrabold text-[#1B3B2F]">Rs. {{ number_format($payout->payout_amount, 2) }}</span>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                                {{ $payout->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $payout->status }}
                            </span>
                        </div>
                        <p class="text-xs text-stone-400 mt-1">
                            {{ $payout->period_start->format('M j, Y') }} – {{ $payout->period_end->format('M j, Y') }}
                            &middot; Sales Rs. {{ number_format($payout->total_sales, 2) }}
                        </p>
                        @if ($payout->status === 'paid' && $payout->paid_at)
                            <p class="text-xs text-green-600 mt-1">Paid on {{ $payout->paid_at->format('M j, Y') }}</p>
                        @else
                            <p class="text-xs text-amber-600 mt-1">Awaiting transfer from Biruwa</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
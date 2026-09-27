@extends('layouts.admin')
@section('title', 'Payout History')

@section('content')
<div class="max-w-4xl mx-auto">

    <a href="{{ route('admin.payouts.index') }}" class="text-xs text-stone-500 hover:text-stone-700 font-semibold">
        ← All Vendors
    </a>

    <div class="mt-2 mb-6 flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-2xl font-extrabold text-[#1B3B2F]">{{ $vendor->business_name }}</h1>
            <p class="text-sm text-stone-500 mt-1">Payout history · Bank: {{ $vendor->bank_name ?? '—' }} · A/C: {{ $vendor->bank_account_no ?? '—' }}</p>
        </div>
    </div>

    @if ($payouts->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            No payouts generated for this vendor yet.
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
                            &middot; Commission kept Rs. {{ number_format($payout->commission_deducted, 2) }}
                        </p>
                        @if ($payout->status === 'paid' && $payout->paid_at)
                            <p class="text-xs text-green-600 mt-1">Paid on {{ $payout->paid_at->format('M j, Y \a\t g:i A') }}</p>
                        @endif
                    </div>

                    @if ($payout->status !== 'paid')
                        <form method="POST" action="{{ route('admin.payouts.markPaid', $payout) }}"
                              onsubmit="event.preventDefault(); adminConfirm(this, {
                                  title: 'Mark this payout as paid?',
                                  text: 'Confirm you have actually transferred Rs. {{ number_format($payout->payout_amount, 2) }} to {{ addslashes($vendor->business_name) }}\'s bank account ({{ addslashes($vendor->bank_name ?? 'their bank') }}). {{ addslashes($vendor->user->name ?? 'The vendor') }} will get an email confirming this payment.',
                                  icon: 'question', confirmText: 'Yes, mark as paid', confirmColor: '#15803d'
                              }); return false;">
                            @csrf
                            <button type="submit" class="text-xs bg-green-700 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-lg">
                                Mark as Paid
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
@extends('layouts.admin')
@section('title', 'Vendor Payouts')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Vendor Payouts</h1>
        <p class="text-sm text-stone-500 mt-1">
            What you owe each vendor for their delivered sales, after your commission cut.
        </p>
    </div>

    @if ($vendors->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            No approved vendors yet.
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
            <table class="w-full text-sm min-w-[900px]">
                <thead>
                    <tr class="border-b border-stone-100 text-left text-xs uppercase tracking-wide text-stone-400">
                        <th class="px-5 py-3 font-bold">Vendor</th>
                        <th class="px-5 py-3 font-bold">Commission Rate</th>
                        <th class="px-5 py-3 font-bold">Unpaid Sales</th>
                        <th class="px-5 py-3 font-bold">Commission Kept</th>
                        <th class="px-5 py-3 font-bold">You Owe Them</th>
                        <th class="px-5 py-3 font-bold">Last Payout</th>
                        <th class="px-5 py-3 font-bold text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                        <tr class="border-b border-stone-50 last:border-0 hover:bg-stone-50/60">
                            <td class="px-5 py-4">
                                <a href="{{ route('admin.payouts.history', $vendor) }}" class="font-semibold text-stone-800 hover:text-[#2F6B4F] hover:underline">
                                    {{ $vendor->business_name }}
                                </a>
                                @if ($vendor->unpaid_count > 0)
                                    <div class="text-xs text-stone-400">{{ $vendor->unpaid_count }} unsettled item{{ $vendor->unpaid_count === 1 ? '' : 's' }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-stone-600">{{ number_format($vendor->commission_rate, 1) }}%</td>
                            <td class="px-5 py-4 text-stone-700">Rs. {{ number_format($vendor->unpaid_sales, 2) }}</td>
                            <td class="px-5 py-4 text-stone-500">Rs. {{ number_format($vendor->unpaid_commission, 2) }}</td>
                            <td class="px-5 py-4 font-bold text-[#1B3B2F]">Rs. {{ number_format($vendor->unpaid_payout, 2) }}</td>
                            <td class="px-5 py-4 text-xs text-stone-400">
                                @if ($vendor->last_payout)
                                    {{ $vendor->last_payout->created_at->format('M j, Y') }}
                                    <span class="block {{ $vendor->last_payout->status === 'paid' ? 'text-green-600' : 'text-amber-600' }} font-semibold uppercase">
                                        {{ $vendor->last_payout->status }}
                                    </span>
                                @else
                                    Never
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                @if ($vendor->unpaid_count > 0)
                                    <form method="POST" action="{{ route('admin.payouts.generate', $vendor) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs bg-[#1B3B2F] hover:bg-[#12281F] text-white font-bold px-3 py-1.5 rounded-lg">
                                            Generate Payout
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-stone-300">Nothing due</span>
                                @endif
                                <a href="{{ route('admin.payouts.history', $vendor) }}" class="text-xs text-stone-500 hover:text-stone-700 font-medium ml-2">
                                    History
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
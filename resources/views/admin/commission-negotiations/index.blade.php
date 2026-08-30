@extends('layouts.admin')

@section('title', 'Commission Negotiations')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Commission Negotiations</h1>
        <p class="text-sm text-stone-500 mt-1">Vendor-proposed commission rate changes awaiting your decision.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    @forelse ($pending as $negotiation)
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div>
                    <div class="font-bold text-stone-800">{{ $negotiation->vendor->business_name ?? '—' }}</div>
                    <div class="text-xs text-stone-400 mt-0.5">
                        Current rate: {{ $negotiation->vendor->commission_rate ?? '—' }}% ·
                        Proposed {{ $negotiation->created_at->diffForHumans() }}
                    </div>
                    @if ($negotiation->message)
                        <p class="text-sm text-stone-600 mt-3 bg-stone-50 rounded-xl px-4 py-3">
                            "{{ $negotiation->message }}"
                        </p>
                    @endif
                </div>
                <div class="text-right shrink-0">
                    <div class="text-[10px] font-bold uppercase text-stone-400">Proposed rate</div>
                    <div class="text-3xl font-extrabold text-[#1B3B2F]">{{ $negotiation->proposed_rate }}%</div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2 mt-5 pt-5 border-t border-stone-100">
                <form action="{{ route('admin.commission-negotiations.accept', $negotiation) }}" method="POST"
                      onsubmit="return confirm('Accept {{ $negotiation->proposed_rate }}% for {{ $negotiation->vendor->business_name }}?');">
                    @csrf
                    <button type="submit" class="bg-[#1B3B2F] hover:bg-[#0F2A20] text-white text-xs font-bold px-4 py-2 rounded-lg transition">
                        Accept {{ $negotiation->proposed_rate }}%
                    </button>
                </form>

                <form action="{{ route('admin.commission-negotiations.reject', $negotiation) }}" method="POST"
                      onsubmit="return confirm('Reject this proposal?');">
                    @csrf
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold px-4 py-2 rounded-lg transition">
                        Reject
                    </button>
                </form>

                <button type="button" onclick="document.getElementById('counter-{{ $negotiation->id }}').classList.toggle('hidden')"
                        class="text-xs font-bold text-stone-500 hover:text-[#2F6B4F] underline underline-offset-2 ml-1">
                    Send counter-offer
                </button>
            </div>

            <form id="counter-{{ $negotiation->id }}" action="{{ route('admin.commission-negotiations.counter', $negotiation) }}"
                  method="POST" class="hidden mt-4 pt-4 border-t border-dashed border-stone-200 flex flex-wrap items-end gap-3">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1">Counter rate (%)</label>
                    <input type="number" name="proposed_rate" step="0.01" min="0" max="100" required
                           class="w-28 text-sm rounded-lg border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F] py-2 px-3">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-semibold text-stone-600 mb-1">Note (optional)</label>
                    <input type="text" name="message" maxlength="500"
                           class="w-full text-sm rounded-lg border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F] py-2 px-3"
                           placeholder="Why this rate works better...">
                </div>
                <button type="submit" class="bg-[#2F6B4F] hover:bg-[#1B3B2F] text-white text-xs font-bold px-4 py-2.5 rounded-lg transition">
                    Send Counter-offer
                </button>
            </form>
        </div>
    @empty
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            No pending commission negotiations right now.
        </div>
    @endforelse

</div>
@endsection
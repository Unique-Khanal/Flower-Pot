@extends('layouts.vendor')
@section('title', 'Commission')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Commission</h1>
        <p class="text-sm text-stone-500 mt-1">Your commission rate, and any ongoing negotiation with Biruwa.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl p-6 mb-6" style="border:1px solid #EDE7D6;">
        <h2 class="text-lg font-bold text-[#1B3B2F] mb-2">Commission Rate</h2>
        <p class="text-sm text-stone-600 mb-4">
            Current rate: <strong style="color:#166534;">{{ $vendor->commission_rate }}%</strong>
        </p>

        @if ($pendingFromAdmin)
            <div style="background:#fef3c7; border:1px solid #fde68a; border-radius:0.75rem; padding:1rem; margin-bottom:1rem;">
                <p class="text-sm font-semibold text-amber-800">
                    Admin proposed {{ $pendingFromAdmin->proposed_rate }}%
                </p>
                @if ($pendingFromAdmin->message)
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
        @elseif ($pendingFromVendor)
            <div style="background:#eff5ee; border:1px solid #cfe3d2; border-radius:0.75rem; padding:1rem; margin-bottom:1rem;">
                <p class="text-sm font-semibold text-[#1B3B2F]">
                    You proposed {{ $pendingFromVendor->proposed_rate }}% — waiting for admin's response.
                </p>
                @if ($pendingFromVendor->message)
                    <p class="text-xs text-stone-500 mt-1">"{{ $pendingFromVendor->message }}"</p>
                @endif
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

    @if ($history->isNotEmpty())
        <h2 class="text-sm font-bold text-stone-700 mb-3">Past Proposals</h2>
        <div class="space-y-2">
            @foreach ($history as $item)
                <div class="bg-white rounded-xl p-4 flex items-center justify-between gap-3 flex-wrap" style="border:1px solid #EDE7D6;">
                    <div>
                        <p class="text-sm text-stone-700">
                            <span class="font-semibold">{{ $item->proposed_by === 'admin' ? 'Admin' : 'You' }}</span>
                            proposed {{ $item->proposed_rate }}%
                        </p>
                        <p class="text-xs text-stone-400">{{ $item->created_at->format('M j, Y') }}</p>
                    </div>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                        {{ $item->status === 'accepted' ? 'bg-green-100 text-green-700' : ($item->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-stone-100 text-stone-500') }}">
                        {{ $item->status }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
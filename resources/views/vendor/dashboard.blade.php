@extends('layouts.app')
@section('title', 'Vendor Dashboard')
@section('content')

<section class="py-12 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-800">Welcome, {{ $vendor->business_name }} 🏪</h1>
            <p class="text-stone-500 text-sm mt-1">Your vendor dashboard</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Status card --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6" style="border:1px solid #bbf7d0;">
            <p class="text-sm text-stone-600">
                Your account is <strong style="color:#166534;">{{ ucfirst($vendor->status) }}</strong> and active on Biruwa.
            </p>
            <p class="text-sm text-stone-500 mt-2">
                Product management, orders, and payouts are coming soon here.
            </p>
        </div>

        {{-- Commission rate card --}}
        <div class="bg-white rounded-2xl shadow-sm p-6" style="border:1px solid #bbf7d0;">
            <h2 class="text-lg font-bold text-stone-800 mb-2">Commission Rate</h2>
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
</section>

@endsection
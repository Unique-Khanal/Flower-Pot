@extends('layouts.admin')

@section('title', 'Vendor Applications')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-stone-800">Vendor Applications</h1>
        <div class="flex gap-2 text-sm">
            @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'all' => 'All'] as $key => $label)
                <a href="{{ route('admin.vendors.index', ['status' => $key]) }}"
                   class="px-3 py-1.5 rounded-lg font-semibold
                          {{ $status === $key ? 'bg-green-700 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                    {{ $label }}
                    @if ($key === 'pending' && $pendingCount > 0)
                        <span class="ml-1 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($vendors as $vendor)
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                {{-- Business & applicant details --}}
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h2 class="text-lg font-bold text-stone-800">{{ $vendor->business_name }}</h2>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                            {{ match($vendor->status) {
                                'pending'   => 'bg-amber-100 text-amber-700',
                                'approved'  => 'bg-green-100 text-green-700',
                                'rejected'  => 'bg-red-100 text-red-700',
                                'suspended' => 'bg-stone-200 text-stone-600',
                            } }}">
                            {{ $vendor->status }}
                        </span>
                    </div>
                    <p class="text-sm text-stone-500">
                        Applicant: <span class="text-stone-700 font-medium">{{ $vendor->user->name }}</span> — {{ $vendor->user->email }}
                    </p>
                    <p class="text-sm text-stone-500"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-3.5 h-3.5 inline -mt-0.5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a11.25 11.25 0 0 1-6.63-6.63l1.293-.97a1.125 1.125 0 0 0 .416-1.173L8.663 3.102a1.125 1.125 0 0 0-1.091-.852H6.75A4.5 4.5 0 0 0 2.25 6.75Z"/></svg>{{ $vendor->business_phone }}</p>
                    <p class="text-sm text-stone-500"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-3.5 h-3.5 inline -mt-0.5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>{{ $vendor->business_address }}</p>
                    @if ($vendor->bank_name)
                        <p class="text-sm text-stone-500"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-3.5 h-3.5 inline -mt-0.5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5M4.5 21V9.75M19.5 21V9.75M2.25 9.75 12 3l9.75 6.75M8.25 21v-6a1.5 1.5 0 0 1 1.5-1.5h4.5a1.5 1.5 0 0 1 1.5 1.5v6"/></svg>{{ $vendor->bank_name }} — {{ $vendor->bank_account_no }}</p>
                    @endif
                    <p class="text-xs text-stone-400 mt-1">Applied {{ $vendor->created_at->diffForHumans() }}</p>

                    @if ($vendor->status === 'rejected' && $vendor->rejection_reason)
                        <div class="mt-2 bg-red-50 border border-red-100 text-red-600 text-xs rounded-lg p-2">
                            Rejection reason: {{ $vendor->rejection_reason }}
                        </div>
                    @endif
                </div>

                {{-- Sample product photos --}}
                <div class="flex gap-2 flex-wrap md:w-64">
                    @foreach (($vendor->sample_product_photos ?? []) as $i => $photo)
                        <a href="{{ route('admin.vendors.sample-photo', [$vendor, $i]) }}" target="_blank">
                            <img src="{{ route('admin.vendors.sample-photo', [$vendor, $i]) }}"
                                 class="w-16 h-16 object-cover rounded-lg border border-stone-200">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            @if ($vendor->status === 'pending')
                <div class="flex gap-3 mt-4 pt-4 border-t border-stone-100">
                    <form action="{{ route('admin.vendors.approve', $vendor) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="bg-green-700 hover:bg-green-800 text-white text-sm font-bold px-4 py-2 rounded-lg">
                            ✓ Approve
                        </button>
                    </form>

                    <button type="button"
                            onclick="document.getElementById('reject-form-{{ $vendor->id }}').classList.toggle('hidden')"
                            class="bg-red-50 hover:bg-red-100 text-red-600 text-sm font-bold px-4 py-2 rounded-lg">
                        ✕ Reject
                    </button>
                </div>

                <form id="reject-form-{{ $vendor->id }}" action="{{ route('admin.vendors.reject', $vendor) }}" method="POST" class="hidden mt-3">
                    @csrf
                    <textarea name="rejection_reason" rows="2" required placeholder="Reason for rejection (visible to vendor)..."
                              class="w-full text-sm rounded-lg border-stone-300 focus:border-red-500 focus:ring-red-500"></textarea>
                    <button type="submit" class="mt-2 bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-4 py-1.5 rounded-lg">
                        Confirm Rejection
                    </button>
                </form>
            @endif
        </div>
    @empty
        <p class="text-center text-stone-400 py-16">No {{ $status !== 'all' ? $status : '' }} vendor applications.</p>
    @endforelse

</div>
@endsection
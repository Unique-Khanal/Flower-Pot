@extends('layouts.admin')

@section('title', 'Vendor Directory')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Vendor Directory</h1>
        <p class="text-sm text-stone-500 mt-1">All approved vendors — products, sales, and account status at a glance.</p>
    </div>

    <div class="flex gap-2 text-sm mb-6">
        @foreach (['all' => 'All', 'approved' => 'Approved', 'suspended' => 'Suspended'] as $key => $label)
            <a href="{{ route('admin.vendors.directory', ['status' => $key]) }}"
               class="px-3 py-1.5 rounded-lg font-semibold
                      {{ $status === $key ? 'bg-green-700 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $label }}
                @if ($key === 'suspended' && $counts['suspended'] > 0)
                    <span class="ml-1 bg-stone-400 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ $counts['suspended'] }}</span>
                @endif
            </a>
        @endforeach
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4 mb-6">
            {{ $errors->first() }}
        </div>
    @endif

        <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[720px]">
            <thead>
                <tr class="border-b border-stone-100 text-left text-xs uppercase tracking-wide text-stone-400">
                    <th class="px-5 py-3 font-bold">Vendor</th>
                    <th class="px-5 py-3 font-bold">Products</th>
                    <th class="px-5 py-3 font-bold">Total sales</th>
                    <th class="px-5 py-3 font-bold">Commission</th>
                    <th class="px-5 py-3 font-bold">Status</th>
                    <th class="px-5 py-3 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vendors as $vendor)
                    <tr class="border-b border-stone-50 last:border-0 hover:bg-stone-50/60">
                        <td class="px-5 py-4">
                            <div class="font-semibold text-stone-800">{{ $vendor->business_name }}</div>
                            <div class="text-xs text-stone-400">{{ $vendor->user->name }} — {{ $vendor->user->email }}</div>
                        </td>
                        <td class="px-5 py-4 text-stone-700 font-medium">{{ $vendor->products_count }}</td>
                        <td class="px-5 py-4 text-stone-700 font-medium">Rs. {{ number_format($vendor->sales_total ?? 0, 2) }}</td>
                        <td class="px-5 py-4">
                            <form action="{{ route('admin.vendors.commission.update', $vendor) }}" method="POST" class="flex items-center gap-1.5">
                                @csrf
                                <input type="number" name="commission_rate" step="0.01" min="0" max="100"
                                       value="{{ $vendor->commission_rate }}"
                                       class="w-16 text-sm rounded-lg border-stone-300 focus:border-green-600 focus:ring-green-600 py-1 px-2">
                                <span class="text-xs text-stone-400">%</span>
                                <button type="submit" class="text-xs font-bold text-green-700 hover:underline">Save</button>
                            </form>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                                {{ $vendor->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-stone-200 text-stone-600' }}">
                                {{ $vendor->status }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            @if ($vendor->status === 'approved')
                                <form action="{{ route('admin.vendors.suspend', $vendor) }}" method="POST"
                                      onsubmit="return confirm('Suspend {{ $vendor->business_name }}? Their listings will stop being sellable until reactivated.');">
                                    @csrf
                                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold px-3 py-1.5 rounded-lg">
                                        Suspend
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.vendors.reactivate', $vendor) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-50 hover:bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-lg">
                                        Reactivate
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-stone-400 py-16">No {{ $status !== 'all' ? $status : '' }} vendors yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $vendors->links() }}
    </div>

</div>
@endsection
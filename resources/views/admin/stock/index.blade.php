@extends('layouts.admin')
@section('title', 'Stock Oversight')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Stock Oversight</h1>
        <p class="text-sm text-stone-500 mt-1">
            The real stock numbers for every product, platform and vendor. Customers only ever see "In Stock" / "Out of Stock".
        </p>
    </div>

    {{-- success flash is already shown by layouts/admin.blade.php --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm">
            @foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    {{-- Summary cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-4">
            <p class="text-xs text-stone-400 font-semibold uppercase">Products</p>
            <p class="text-2xl font-extrabold text-[#1B3B2F] mt-1">{{ number_format($stats['products']) }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-4">
            <p class="text-xs text-stone-400 font-semibold uppercase">Total units in stock</p>
            <p class="text-2xl font-extrabold text-[#1B3B2F] mt-1">{{ number_format($stats['units']) }}</p>
        </div>
        <a href="{{ route('admin.stock.index', ['filter' => 'low']) }}" class="bg-white rounded-2xl shadow-sm p-4 hover:ring-2 hover:ring-amber-300">
            <p class="text-xs text-amber-600 font-semibold uppercase">Low stock (≤ {{ $lowStock }})</p>
            <p class="text-2xl font-extrabold text-amber-600 mt-1">{{ $stats['low'] }}</p>
        </a>
        <a href="{{ route('admin.stock.index', ['filter' => 'out']) }}" class="bg-white rounded-2xl shadow-sm p-4 hover:ring-2 hover:ring-red-300">
            <p class="text-xs text-red-600 font-semibold uppercase">Out of stock</p>
            <p class="text-2xl font-extrabold text-red-600 mt-1">{{ $stats['out'] }}</p>
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.stock.index') }}" class="bg-white rounded-2xl shadow-sm p-4 mb-5 flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-xs font-semibold text-stone-500 mb-1">Stock level</label>
            <select name="filter" class="text-sm rounded-lg border-stone-300">
                @foreach (['all' => 'All', 'in' => 'Healthy', 'low' => 'Low', 'out' => 'Out of stock'] as $k => $l)
                    <option value="{{ $k }}" @selected($filter === $k)>{{ $l }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-stone-500 mb-1">Owner</label>
            <select name="owner" class="text-sm rounded-lg border-stone-300">
                @foreach (['all' => 'All', 'platform' => 'Platform (admin)', 'vendor' => 'Vendors'] as $k => $l)
                    <option value="{{ $k }}" @selected($owner === $k)>{{ $l }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-semibold text-stone-500 mb-1">Search product or vendor</label>
            <input type="text" name="search" value="{{ $search }}" placeholder="e.g. ceramic, Green Thumb…"
                   class="w-full text-sm rounded-lg border-stone-300">
        </div>
        <button class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-4 py-2 rounded-lg">Apply</button>
        <a href="{{ route('admin.stock.index') }}" class="text-sm text-stone-500 hover:text-stone-700 py-2">Reset</a>
    </form>

    {{-- Product stock table --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-x-auto mb-8">
        <table class="w-full text-sm">
            <thead class="bg-stone-50 text-stone-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-4 py-3">Product</th>
                    <th class="text-left px-4 py-3">Owner</th>
                    <th class="text-left px-4 py-3">Listing</th>
                    <th class="text-center px-4 py-3">Stock</th>
                    <th class="text-left px-4 py-3">Set stock &amp; reason</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset($product->image) }}" class="w-11 h-11 rounded-lg object-cover bg-stone-100">
                                <div>
                                    <p class="font-semibold text-stone-800 leading-tight">{{ $product->name }}</p>
                                    <p class="text-xs text-stone-400 capitalize">{{ $product->category }}@if($product->size) — {{ $product->size }}@endif</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-stone-600">
                            {{ $product->vendor_id ? ($product->vendor->business_name ?? 'Vendor') : 'Biruwa (admin)' }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($product->is_hidden)
                                <span class="text-xs bg-stone-100 text-stone-500 px-2 py-0.5 rounded-full">Hidden</span>
                            @else
                                <span class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded-full">Live</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if ($product->stock <= 0)
                                <span class="font-bold text-red-600">0</span>
                                <div class="text-[10px] text-red-500 font-semibold">OUT</div>
                            @elseif ($product->stock <= $lowStock)
                                <span class="font-bold text-amber-600">{{ $product->stock }}</span>
                                <div class="text-[10px] text-amber-600 font-semibold">LOW</div>
                            @else
                                <span class="font-bold text-stone-800">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.stock.update', $product) }}" class="flex flex-wrap gap-2 items-center">
                                @csrf
                                <input type="number" name="new_stock" min="0" value="{{ $product->stock }}" required
                                       class="w-24 text-sm rounded-lg border-stone-300">
                                <input type="text" name="reason" required maxlength="255" placeholder="Reason (restock, damaged…)"
                                       class="flex-1 min-w-[160px] text-sm rounded-lg border-stone-300">
                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white text-xs font-bold px-3 py-2 rounded-lg">Save</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-12 text-center text-stone-400">No products match these filters.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mb-8">{{ $products->links() }}</div>

    {{-- Recent stock movements (audit log) --}}
    <h2 class="text-lg font-bold text-[#1B3B2F] mb-3">Recent stock movements</h2>
    <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-stone-50 text-stone-500 text-xs uppercase">
                <tr>
                    <th class="text-left px-4 py-3">When</th>
                    <th class="text-left px-4 py-3">Product</th>
                    <th class="text-center px-4 py-3">Change</th>
                    <th class="text-center px-4 py-3">Old → New</th>
                    <th class="text-left px-4 py-3">Reason</th>
                    <th class="text-left px-4 py-3">By</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @forelse ($recent as $log)
                    <tr>
                        <td class="px-4 py-2.5 text-stone-500 whitespace-nowrap">{{ $log->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-4 py-2.5 text-stone-800">{{ $log->product->name ?? '—' }}</td>
                        <td class="px-4 py-2.5 text-center font-bold {{ $log->change < 0 ? 'text-red-600' : 'text-green-700' }}">
                            {{ $log->change > 0 ? '+' : '' }}{{ $log->change }}
                        </td>
                        <td class="px-4 py-2.5 text-center text-stone-600">{{ $log->old_stock }} → {{ $log->new_stock }}</td>
                        <td class="px-4 py-2.5 text-stone-600">{{ $log->reason }}</td>
                        <td class="px-4 py-2.5 text-stone-500 text-xs">
                            {{ $log->source === 'admin' ? ($log->user->name ?? 'Admin') : ($log->source === 'order' ? 'Customer order' : 'Order cancelled') }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-stone-400">No stock movements recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
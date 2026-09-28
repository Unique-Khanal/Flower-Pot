@extends('layouts.admin')
@section('title', 'Products')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="mb-6 flex items-start justify-between gap-4 flex-wrap">
        <div>
            <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Products</h1>
            <p class="text-sm text-stone-500 mt-1">
                @if ($status === 'platform')
                    Products sold directly by the platform — add, edit or remove freely.
                @else
                    Review new vendor listings before they appear on the storefront.
                @endif
            </p>
        </div>
        @if ($status === 'platform')
            <a href="{{ route('admin.products.create') }}"
               class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-4 py-2.5 rounded-xl flex items-center gap-1.5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Product
            </a>
        @endif
    </div>

    <div class="flex gap-2 text-sm mb-4 flex-wrap">
        @foreach (['pending' => 'Pending Review', 'live' => 'Live', 'hidden' => 'Hidden', 'platform' => 'Platform (Admin-owned)'] as $key => $label)
            <a href="{{ route('admin.products.index', ['status' => $key]) }}"
               class="px-3 py-1.5 rounded-lg font-semibold
                      {{ $status === $key ? 'bg-green-700 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $label }}
                @if ($counts[$key] > 0)
                    <span class="ml-1 {{ $status === $key ? 'bg-white/25' : 'bg-stone-400 text-white' }} text-[10px] px-1.5 py-0.5 rounded-full">{{ $counts[$key] }}</span>
                @endif
            </a>
        @endforeach
    </div>

    @if ($status === 'platform')
        <div class="flex gap-3 text-sm mb-6">
            @foreach (['all' => 'All', 'live' => 'Live', 'hidden' => 'Hidden'] as $key => $label)
                <a href="{{ route('admin.products.index', ['status' => 'platform', 'pstatus' => $key]) }}"
                   class="px-4 py-1.5 rounded-full font-semibold border
                          {{ $pstatus === $key ? 'bg-[#1B3B2F] text-white border-[#1B3B2F]' : 'bg-white text-stone-500 border-stone-200 hover:border-stone-300' }}">
                    {{ $label }}
                    @if ($platformCounts[$key] > 0)
                        <span class="ml-1 {{ $pstatus === $key ? 'text-white/70' : 'text-stone-400' }}">({{ $platformCounts[$key] }})</span>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            @if ($status === 'platform')
                No admin-owned products yet. <a href="{{ route('admin.products.create') }}" class="text-[#2F6B4F] font-semibold hover:underline">Add your first one.</a>
            @else
                No {{ $status }} products right now.
            @endif
        </div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="aspect-square bg-stone-100">
                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-stone-800 text-sm leading-tight">{{ $product->name }}</h3>
                        <p class="text-xs text-stone-400 mt-0.5">
                            {{ $status === 'platform' ? 'Sold by Biruwa (admin)' : 'by ' . ($product->vendor->business_name ?? '—') }}
                        </p>
                        <p class="text-xs text-stone-400 capitalize">{{ $product->category }}@if($product->size) — {{ $product->size }}@endif</p>
                        <p class="text-lg font-extrabold text-[#1B3B2F] mt-2">Rs. {{ number_format($product->price, 2) }}</p>
                        <p class="text-xs {{ $product->stock <= 0 ? 'text-red-600 font-bold' : ($product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-stone-500') }}">
                            {{ $product->stock <= 0 ? 'Out of stock' : $product->stock . ' in stock' }}
                        </p>

                        @if ($product->description)
                            <p class="text-xs text-stone-500 mt-2 line-clamp-2">{{ $product->description }}</p>
                        @endif

                        @if ($status === 'platform')
                            <div class="flex items-center gap-2 mt-4 pt-3 border-t border-stone-100">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="flex-1 text-center bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-bold py-2 rounded-lg">
                                    Edit
                                </a>
                                @if ($product->is_hidden)
                                    <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white text-xs font-bold py-2 rounded-lg">
                                            Show
                                        </button>
                                    </form>
                                @else
                                    <button type="button" onclick="document.getElementById('hide-form-{{ $product->id }}').classList.toggle('hidden')"
                                            class="flex-1 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-bold py-2 rounded-lg">
                                        Hide
                                    </button>
                                @endif
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ addslashes($product->name) }} permanently? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold py-2 px-3 rounded-lg">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <form id="hide-form-{{ $product->id }}" action="{{ route('admin.products.hide', $product) }}" method="POST" class="hidden mt-3">
                                @csrf
                                <textarea name="hidden_reason" rows="2" required placeholder="Reason for hiding (internal note)..."
                                          class="w-full text-xs rounded-lg border-stone-300 focus:border-red-500 focus:ring-red-500"></textarea>
                                <button type="submit" class="mt-2 w-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-1.5 rounded-lg">
                                    Confirm Hide
                                </button>
                            </form>
                        @elseif ($status === 'pending')
                            <div class="flex items-center gap-2 mt-4 pt-3 border-t border-stone-100">
                                <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white text-xs font-bold py-2 rounded-lg">
                                        Approve
                                    </button>
                                </form>
                                <button type="button" onclick="document.getElementById('hide-form-{{ $product->id }}').classList.toggle('hidden')"
                                        class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold py-2 rounded-lg">
                                    Reject
                                </button>
                            </div>
                            <form id="hide-form-{{ $product->id }}" action="{{ route('admin.products.hide', $product) }}" method="POST" class="hidden mt-3">
                                @csrf
                                <textarea name="hidden_reason" rows="2" required placeholder="Reason (visible to vendor)..."
                                          class="w-full text-xs rounded-lg border-stone-300 focus:border-red-500 focus:ring-red-500"></textarea>
                                <button type="submit" class="mt-2 w-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-1.5 rounded-lg">
                                    Confirm Reject
                                </button>
                            </form>
                        @elseif ($status === 'live')
                            <button type="button"
                                    onclick="document.getElementById('hide-form-{{ $product->id }}').classList.toggle('hidden')"
                                    class="w-full mt-4 pt-3 border-t border-stone-100 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold py-2 rounded-lg">
                                Hide from storefront
                            </button>
                            <form id="hide-form-{{ $product->id }}" action="{{ route('admin.products.hide', $product) }}" method="POST" class="hidden mt-3">
                                @csrf
                                <textarea name="hidden_reason" rows="2" required placeholder="Reason (visible to vendor)..."
                                          class="w-full text-xs rounded-lg border-stone-300 focus:border-red-500 focus:ring-red-500"></textarea>
                                <button type="submit" class="mt-2 w-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-1.5 rounded-lg">
                                    Confirm Hide
                                </button>
                            </form>
                        @else
                            <div class="mt-3 pt-3 border-t border-stone-100">
                                <div class="bg-red-50 border border-red-100 text-red-600 text-xs rounded-lg p-2 mb-2">
                                    {{ $product->hidden_reason }}
                                </div>
                                <form action="{{ route('admin.products.approve', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white text-xs font-bold py-2 rounded-lg">
                                        Re-approve
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsectionma
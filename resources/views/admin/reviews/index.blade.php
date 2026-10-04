@extends('layouts.admin')
@section('title', 'Customer Reviews')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Customer Reviews</h1>
        <p class="text-sm text-stone-500 mt-1">Reviews on your own products and on vendor products.</p>
    </div>

    {{-- Owner tabs --}}
    <div class="flex flex-wrap gap-2 mb-4">
        @foreach (['all' => 'All', 'platform' => 'My Products', 'vendor' => 'Vendor Products'] as $key => $label)
            <a href="{{ route('admin.reviews.index', ['owner' => $key, 'rating' => $rating, 'search' => $search]) }}"
               class="px-4 py-2 rounded-xl text-sm font-semibold {{ $owner === $key ? 'bg-[#1B3B2F] text-white' : 'bg-white text-stone-600 hover:bg-stone-50' }}">
                {{ $label }} <span class="opacity-70">({{ $counts[$key] }})</span>
            </a>
        @endforeach
    </div>

    {{-- Search + rating filter --}}
    <form method="GET" class="flex flex-wrap gap-2 mb-6">
        <input type="hidden" name="owner" value="{{ $owner }}">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search customer, product or comment..."
               class="flex-1 min-w-[200px] bg-white border border-stone-200 rounded-xl px-4 py-2 text-sm">
        <select name="rating" class="bg-white border border-stone-200 rounded-xl px-3 py-2 text-sm">
            <option value="">All ratings</option>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ (string) $rating === (string) $i ? 'selected' : '' }}>{{ $i }} ★</option>
            @endfor
        </select>
        <button class="bg-[#1B3B2F] text-white px-5 py-2 rounded-xl text-sm font-semibold">Filter</button>
    </form>

    @if ($reviews->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">No reviews found.</div>
    @else
        <div class="space-y-3">
            @foreach ($reviews as $review)
                <div class="bg-white rounded-2xl shadow-sm p-5">
                    <div class="flex items-start justify-between gap-3 flex-wrap mb-2">
                        <div>
                            <p class="font-bold text-stone-800">{{ $review->user->name ?? 'Customer' }}</p>
                            <p class="text-xs text-stone-400">
                                on {{ $review->product->name ?? 'a deleted product' }}
                                &middot;
                                @if ($review->product && $review->product->vendor)
                                    Vendor: {{ $review->product->vendor->business_name }}
                                @else
                                    <span class="font-semibold text-[#2F6B4F]">Your product</span>
                                @endif
                                &middot; {{ $review->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="text-amber-400 text-sm whitespace-nowrap">
                            @for ($i = 1; $i <= 5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                        </div>
                    </div>

                    @if ($review->comment)
                        <p class="text-sm text-stone-600">{{ $review->comment }}</p>
                    @endif

                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="mt-3 text-right"
                          onsubmit="event.preventDefault(); adminConfirm(this, {title:'Delete this review?', text:'This cannot be undone.', confirmText:'Delete', confirmColor:'#dc2626'}); return false;">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs font-semibold text-red-500 hover:underline">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-8">{{ $reviews->links() }}</div>
    @endif
</div>
@endsection
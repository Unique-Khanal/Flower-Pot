@extends('layouts.vendor')
@section('title', 'Reviews')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Reviews</h1>
        <p class="text-sm text-stone-500 mt-1">What customers are saying about your products.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-5 flex items-center gap-4">
            <div class="text-3xl font-extrabold text-[#1B3B2F]">{{ $stats['avg'] }}<span class="text-base text-stone-400">/5</span></div>
            <div>
                <div class="text-amber-400 text-sm">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($stats['avg']) ? '★' : '☆' }}
                    @endfor
                </div>
                <p class="text-xs text-stone-400 mt-0.5">{{ $stats['total'] }} review{{ $stats['total'] === 1 ? '' : 's' }} total</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-5">
            @foreach ($breakdown as $star => $count)
                <a href="{{ route('vendor.reviews.index', ['rating' => $star]) }}"
                   class="flex items-center gap-2 text-xs mb-1 last:mb-0 {{ (string)$rating === (string)$star ? 'font-bold text-[#1B3B2F]' : 'text-stone-500' }}">
                    <span class="w-8">{{ $star }}★</span>
                    <span class="flex-1 h-2 bg-stone-100 rounded-full overflow-hidden">
                        <span class="block h-full bg-amber-400" style="width: {{ $stats['total'] > 0 ? ($count / $stats['total'] * 100) : 0 }}%"></span>
                    </span>
                    <span class="w-6 text-right">{{ $count }}</span>
                </a>
            @endforeach
            @if ($rating)
                <a href="{{ route('vendor.reviews.index') }}" class="text-xs text-[#2F6B4F] font-semibold hover:underline mt-2 inline-block">Clear filter</a>
            @endif
        </div>
    </div>

    @if ($reviews->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            No reviews {{ $rating ? 'at this rating ' : '' }}yet.
        </div>
    @else
        <div class="space-y-3">
            @foreach ($reviews as $review)
                <div class="bg-white rounded-2xl shadow-sm p-5">
                    <div class="flex items-start justify-between gap-3 flex-wrap mb-2">
                        <div>
                            <p class="font-bold text-stone-800">{{ $review->user->name ?? 'Customer' }}</p>
                            <p class="text-xs text-stone-400">on {{ $review->product->name ?? 'a product' }} &middot; {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-amber-400 text-sm whitespace-nowrap">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $review->rating ? '★' : '☆' }}
                            @endfor
                        </div>
                    </div>
                    @if ($review->comment)
                        <p class="text-sm text-stone-600">{{ $review->comment }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-8">{{ $reviews->links() }}</div>
    @endif
</div>
@endsection
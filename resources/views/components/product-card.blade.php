@props(['image', 'name', 'price', 'badge' => null])

<div class="bg-white rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300 overflow-hidden flex flex-col">
    <!-- Image -->
    <div class="relative">
        <img src="{{ asset($image) }}" alt="{{ $name }}" class="w-full h-48 object-cover">
        @if($badge)
            <span class="absolute top-2 left-2 bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                {{ $badge }}
            </span>
        @endif
    </div>

    <!-- Info -->
    <div class="p-4 flex flex-col flex-1">
        <h3 class="text-gray-800 font-semibold text-sm mb-1 flex-1">{{ $name }}</h3>
        <p class="text-green-700 font-bold text-lg mb-3">Rs. {{ number_format($price) }}</p>
        <div class="flex gap-2">
            <button class="flex-1 border border-green-600 text-green-700 hover:bg-green-50 text-xs font-medium py-1.5 rounded-lg transition">
                Add to Cart
            </button>
            <button class="flex-1 bg-green-700 hover:bg-green-800 text-white text-xs font-medium py-1.5 rounded-lg transition">
                Buy Now
            </button>
        </div>
    </div>
</div>

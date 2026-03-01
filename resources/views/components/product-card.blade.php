@props(['image', 'name', 'price', 'badge' => null])

<div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">

    {{-- Image --}}
    <div class="relative overflow-hidden aspect-square">
        <img src="{{ asset($image) }}"
             alt="{{ $name }}"
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
             style="transform-origin:center">

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        {{-- Badge --}}
        @if($badge)
            <span class="absolute top-2.5 left-2.5 bg-green-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow tracking-wide uppercase">
                {{ $badge }}
            </span>
        @endif

        {{-- Hover view button --}}
        <div class="absolute inset-0 flex items-end justify-center pb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span class="bg-white/90 backdrop-blur-sm text-green-800 text-xs font-semibold px-4 py-1.5 rounded-full shadow">
                View Details
            </span>
        </div>
    </div>

    {{-- Name --}}
    <div class="px-3 py-2.5">
        <h3 class="text-stone-700 font-semibold text-xs leading-snug line-clamp-2 text-center">{{ $name }}</h3>
    </div>
</div>


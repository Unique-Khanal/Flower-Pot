@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- Hero --}}
<section class="relative text-white py-28 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/ceramics/ceramics-large-pot2.webp') }}"
             class="w-full h-full object-cover" alt="About FlowerPot">
        <div class="absolute inset-0 bg-gradient-to-b from-green-950/85 via-green-900/75 to-green-950/90"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <span class="inline-block bg-amber-400/20 border border-amber-400/40 text-amber-300
                     uppercase tracking-widest text-xs px-4 py-1.5 rounded-full mb-5 font-semibold">
            Our Story
        </span>
        <h1 class="brand-font text-4xl md:text-5xl font-bold mb-5 leading-tight">About FlowerPot</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto leading-relaxed">
            We believe every home deserves a touch of green. FlowerPot was born out of a passion
            for plants and a desire to make beautiful, quality pots accessible to everyone.
        </p>
    </div>
</section>

{{-- What is FlowerPot? --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-14 items-center">
        <div>
            <span class="text-green-600 font-semibold text-xs uppercase tracking-widest">Who We Are</span>
            <h2 class="brand-font text-3xl font-bold text-stone-900 mt-2 mb-5">Our Story</h2>
            <p class="text-stone-600 leading-relaxed mb-4">
                FlowerPot started with a simple idea — that bringing nature indoors should be easy, joyful,
                and affordable. We are a team of plant lovers and designers who curate the finest pots and
                plants so you can create a greener, calmer space wherever you live.
            </p>
            <p class="text-stone-600 leading-relaxed mb-4">
                From hand-crafted <strong>ceramic and mud pots</strong> to sturdy <strong>cement and plastic planters</strong>,
                every item in our collection is chosen for its quality, durability, and beauty.
                We source directly from skilled local artisans and nurseries to ensure you receive
                only the best.
            </p>
            <p class="text-stone-600 leading-relaxed">
                Whether you are a seasoned plant parent or just starting your green journey,
                FlowerPot has something for every home, every budget, and every style.
            </p>
        </div>
        <div class="rounded-3xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/ceramics/ceramics-large-pot5.webp') }}"
                 alt="FlowerPot Product"
                 class="w-full h-80 object-cover">
        </div>
    </div>
</section>

{{-- Our Values --}}
<section class="py-20 px-4 bg-stone-50">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-xs uppercase tracking-widest">Our Values</span>
            <h2 class="brand-font text-3xl font-bold text-stone-900 mt-2">What We Stand For</h2>
            <p class="text-stone-500 mt-3 max-w-xl mx-auto">
                Everything we do is guided by our love for nature, our respect for craftsmanship,
                and our commitment to making your shopping experience effortless.
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                ['image' => 'images/ceramics/ceramics-medium-pot1.webp', 'name' => 'Quality First',      'sub' => 'Handpicked products you can trust'],
                ['image' => 'images/Plants/snake_plant.webp',            'name' => 'Nature Inspired',    'sub' => 'Designs that bring the outdoors in'],
                ['image' => 'images/mud/mud-large-pot1.webp',            'name' => 'Local Artisans',     'sub' => 'Supporting skilled craftspeople'],
                ['image' => 'images/Plants/money_plant.webp',            'name' => 'Always Fresh',       'sub' => 'Healthy plants, delivered with care'],
            ] as $value)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset($value['image']) }}"
                         alt="{{ $value['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 text-center">
                    <p class="font-bold text-stone-800">{{ $value['name'] }}</p>
                    <p class="text-stone-400 text-xs mt-1">{{ $value['sub'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Features --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-xs uppercase tracking-widest">Why Shop With Us</span>
            <h2 class="brand-font text-3xl font-bold text-stone-900 mt-2">The FlowerPot Experience</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['image' => 'images/ceramics/ceramics-large-pot7.webp', 'name' => 'Wide Collection',   'desc' => 'Explore ceramic, cement, mud, and plastic pots alongside a curated selection of indoor plants — all in one place.'],
                ['image' => 'images/Plants/Boston_Fern.webp',           'name' => 'Easy Shopping',     'desc' => 'Add your favourites to the cart, review your order, and check out in just a few clicks — no fuss, no hassle.'],
                ['image' => 'images/cement/cement-large-pot2.webp',     'name' => 'Always Up to Date',  'desc' => 'Our catalogue is kept fresh and current so you always see accurate availability, pricing, and the latest arrivals.'],
            ] as $feature)
            <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition group">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset($feature['image']) }}"
                         alt="{{ $feature['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 bg-white">
                    <h3 class="font-bold text-stone-800 text-lg mb-2">{{ $feature['name'] }}</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'Services')

@section('content')

{{-- Hero --}}
<section class="relative text-white py-28 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/Plants/spider_plant2.webp') }}"
             class="w-full h-full object-cover" alt="Our Services">
        <div class="absolute inset-0 bg-gradient-to-b from-green-950/85 via-green-900/70 to-green-950/90"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <span class="inline-block bg-amber-400/20 border border-amber-400/40 text-amber-300
                     uppercase tracking-widest text-xs px-4 py-1.5 rounded-full mb-5 font-semibold">
            What We Offer
        </span>
        <h1 class="brand-font text-4xl md:text-5xl font-bold mb-5">Our Services</h1>
        <p class="text-green-100 text-lg max-w-xl mx-auto">
            From doorstep delivery to custom pot design — we take care of everything for your green lifestyle.
        </p>
    </div>
</section>

{{-- Services Grid --}}
<section class="py-20 px-4 bg-stone-50">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- Home Delivery --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-large-pot3.webp') }}"
                         alt="Home Delivery"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-3 left-4 bg-green-500 text-white text-xs font-bold
                                 px-3 py-1 rounded-full uppercase tracking-wide shadow">Delivery</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Home Delivery</h3>
                    <p class="text-stone-500 text-sm leading-relaxed mb-4">
                        We deliver your plants and pots directly to your doorstep, anywhere in Kathmandu.
                         delivery on orders.
                    </p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Delivery within 24-48 hours.
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Same-day delivery in major locations.
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Careful packaging guaranteed
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Custom Pots --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-medium-pot3.webp') }}"
                         alt="Custom Pots"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-3 left-4 bg-amber-500 text-white text-xs font-bold
                                 px-3 py-1 rounded-full uppercase tracking-wide shadow">Custom</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Custom Pots</h3>
                    <p class="text-stone-500 text-sm leading-relaxed mb-4">
                        Want something unique? We craft custom pots in any size, shape, or color.
                        Perfect for corporate gifts or personalised décor.
                    </p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Any size &amp; shape
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Custom colors &amp; engravings
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            7–14 day turnaround
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Plant Consultation --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/Plants/snake_plant.webp') }}"
                         alt="Plant Consultation"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-3 left-4 bg-blue-500 text-white text-xs font-bold
                                 px-3 py-1 rounded-full uppercase tracking-wide shadow">Consultation</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Plant Consultation</h3>
                    <p class="text-stone-500 text-sm leading-relaxed mb-4">
                        Not sure which plant suits your space? Our expert horticulturists provide
                        free consultations based on your light, humidity, and space.
                    </p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Free 30-minute consultation
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Personalised recommendations
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Care guides included
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Gift Wrapping --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/Plants/Boston_Fern.webp') }}"
                         alt="Gift Wrapping"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-3 left-4 bg-pink-500 text-white text-xs font-bold
                                 px-3 py-1 rounded-full uppercase tracking-wide shadow">Gifting</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Gift Wrapping</h3>
                    <p class="text-stone-500 text-sm leading-relaxed mb-4">
                        Make your gift extra special with our eco-friendly gift wrapping service.
                        We add personal message cards on request.
                    </p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Eco-friendly materials
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Custom message cards
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Available for all orders
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Landscaping --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/Plants/spider_plant.webp') }}"
                         alt="Landscaping"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-3 left-4 bg-purple-500 text-white text-xs font-bold
                                 px-3 py-1 rounded-full uppercase tracking-wide shadow">Landscaping</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Landscaping</h3>
                    <p class="text-stone-500 text-sm leading-relaxed mb-4">
                        Transform your outdoor spaces with our professional landscaping service.
                        We design and install beautiful gardens and balcony setups.
                    </p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Professional design team
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Maintenance packages available
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Free site visit &amp; quote
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bulk Orders --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot2.webp') }}"
                         alt="Bulk Orders"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-3 left-4 bg-yellow-500 text-white text-xs font-bold
                                 px-3 py-1 rounded-full uppercase tracking-wide shadow">Bulk</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Bulk Orders</h3>
                    <p class="text-stone-500 text-sm leading-relaxed mb-4">
                        Need pots or plants in large quantities for events, offices, or hotels?
                        Special discounts with a dedicated account manager.
                    </p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Special bulk discounts
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Custom branding available
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
                            Dedicated account manager
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 px-4 bg-gradient-to-br from-green-800 to-emerald-900 text-white text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="brand-font text-3xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-green-200 mb-8 text-lg">Contact us today and let's create something beautiful together.</p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-amber-400 hover:bg-amber-300 text-stone-900 font-bold px-10 py-3.5
                  rounded-xl text-base transition shadow-lg hover:-translate-y-0.5">
            Contact Us →
        </a>
    </div>
</section>

@endsection

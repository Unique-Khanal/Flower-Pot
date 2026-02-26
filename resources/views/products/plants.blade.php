@extends('layouts.app')

@section('title', 'Plants')

@section('content')

<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">🌱 Plants</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">Bring life to your home with our beautiful collection of indoor plants.</p>
</section>

<section class="py-12 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($products as $item)
                <x-product-card :image="$item['image']" :name="$item['name']" :price="$item['price']" />
            @endforeach
        </div>
    </div>
</section>

@endsection

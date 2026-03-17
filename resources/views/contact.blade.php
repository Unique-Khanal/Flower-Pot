@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

{{-- Hero --}}
<section class="relative text-white py-24 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/Plants/money_plant.webp') }}"
             class="w-full h-full object-cover" alt="Contact Us">
        <div class="absolute inset-0 bg-green-950/80"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <span class="inline-block bg-amber-400/20 border border-amber-400/40 text-amber-300
                     uppercase tracking-widest text-xs px-4 py-1.5 rounded-full mb-5 font-semibold">
            Get In Touch
        </span>
        <h1 class="brand-font text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">
            We'd love to hear from you. Reach out and we'll get back to you within 24 hours.
        </p>
    </div>
</section>

{{-- Contact Content --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- Form --}}
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-stone-800 mb-6">Send Us a Message</h2>
            <form class="space-y-5" method="POST" action="{{ route('contact.store') }}">
                @csrf
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-5">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" placeholder="Your full name" required
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" placeholder="your@email.com" required
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone_no" placeholder="+977"
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">
                            Subject <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="subject" placeholder="How can we help?" required
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" rows="6" placeholder="Write your message here..." required
                              class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition resize-none">
                    </textarea>
                </div>
                <button type="submit"
                        class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-xl
                               transition shadow-md text-base hover:-translate-y-0.5">
                    Send Message 📤
                </button>
            </form>
        </div>

        {{-- Sidebar --}}
        <div>
            <h2 class="text-2xl font-bold text-stone-800 mb-6">Get in Touch</h2>
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                    <div class="bg-green-700 text-white p-3 rounded-xl flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-800">Address</h4>
                        <p class="text-stone-500 text-sm mt-1">Kathmandu, Nepal</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                    <div class="bg-green-700 text-white p-3 rounded-xl flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-800">Phone</h4>
                        <p class="text-stone-500 text-sm mt-1">9763686254</p>
                        <p class="text-stone-500 text-sm">9813067906</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                    <div class="bg-green-700 text-white p-3 rounded-xl flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-800">Email</h4>
                        <p class="text-stone-500 text-sm mt-1">uniquekhanal2020@gmail.com</p>
                        <p class="text-stone-500 text-sm"></p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                    <div class="bg-green-700 text-white p-3 rounded-xl flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-stone-800">Business Hours</h4>
                        <p class="text-stone-500 text-sm mt-1">Mon – Sat: 9:00 AM – 8:00 PM</p>
                        <p class="text-stone-500 text-sm">Sunday: 10:00 AM – 5:00 PM</p>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>

@endsection

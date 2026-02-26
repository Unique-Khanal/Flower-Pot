@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Contact Us</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">We'd love to hear from you. Reach out and we'll get back to you within 24 hours.</p>
</section>

{{-- Contact Content --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
            <form class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="Your full name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="your@email.com" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+92 300 0000000"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject <span class="text-red-500">*</span></label>
                        <input type="text" name="subject" placeholder="How can we help?" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message <span class="text-red-500">*</span></label>
                    <textarea name="message" rows="6" placeholder="Write your message here..." required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition resize-none"></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-lg transition shadow-md text-base">
                    Send Message 📤
                </button>
            </form>
        </div>

        {{-- Contact Info Sidebar --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Get in Touch</h2>
            <div class="space-y-6">
                <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl">
                    <div class="bg-green-700 text-white p-3 rounded-lg flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Address</h4>
                        <p class="text-gray-500 text-sm mt-1">123 Garden Street, Green City, Lahore, Pakistan</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl">
                    <div class="bg-green-700 text-white p-3 rounded-lg flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Phone</h4>
                        <p class="text-gray-500 text-sm mt-1">+92 300 1234567</p>
                        <p class="text-gray-500 text-sm">+92 42 1234567</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl">
                    <div class="bg-green-700 text-white p-3 rounded-lg flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Email</h4>
                        <p class="text-gray-500 text-sm mt-1">info@flowerpot.pk</p>
                        <p class="text-gray-500 text-sm">support@flowerpot.pk</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl">
                    <div class="bg-green-700 text-white p-3 rounded-lg flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Business Hours</h4>
                        <p class="text-gray-500 text-sm mt-1">Mon – Sat: 9:00 AM – 8:00 PM</p>
                        <p class="text-gray-500 text-sm">Sunday: 10:00 AM – 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

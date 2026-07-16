<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FlowerPot') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'DM Sans', sans-serif; }

            /* ── IMAGE ZOOM OVERLAY ── */
            .zoom-overlay {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 9999;
                background: rgba(0,0,0,0.92);
                align-items: center;
                justify-content: center;
                cursor: zoom-out;
            }
            .zoom-overlay.active {
                display: flex;
            }
            .zoom-overlay img {
                max-width: 90vw;
                max-height: 90vh;
                object-fit: contain;
                border-radius: 1rem;
                box-shadow: 0 25px 80px rgba(0,0,0,0.5);
                animation: zoomIn 0.25s ease;
            }
            @keyframes zoomIn {
                from { transform: scale(0.85); opacity: 0; }
                to   { transform: scale(1);    opacity: 1; }
            }
            .zoom-close {
                position: fixed;
                top: 1.25rem;
                right: 1.5rem;
                width: 40px;
                height: 40px;
                background: rgba(255,255,255,0.15);
                border: none;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                color: white;
                transition: background 0.2s;
                z-index: 10000;
            }
            .zoom-close:hover { background: rgba(255,255,255,0.3); }

            /* make all product images show zoom cursor */
            .zoomable {
                cursor: zoom-in;
                transition: transform 0.3s;
            }
            .zoomable:hover { transform: scale(1.03); }

            /* ── FOOTER ── */
            .site-footer {
    background: linear-gradient(135deg, #14532d, #166534);
    color: #bbf7d0;
    padding: 3.5rem 1.5rem 1.5rem;
    margin-top: auto;
}
            .footer-inner {
                max-width: 1280px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 2fr 1fr 1fr 1fr;
                gap: 2.5rem;
            }
            .footer-logo-font {
                font-family: 'Cinzel Decorative', serif;
                font-size: 1.3rem;
                font-weight: 700;
                background: linear-gradient(135deg, #4ade80, #fbbf24);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .footer-brand p {
                font-size: 0.875rem;
                line-height: 1.7;
                margin-top: 0.75rem;
                max-width: 260px;
                color: #bbf7d0;
            }
            .footer-col h4 {
                color: #ffffff;
                font-size: 0.875rem;
                font-weight: 700;
                margin-bottom: 1rem;
                letter-spacing: 0.05em;
                text-transform: uppercase;
            }
            .footer-col a {
                display: block;
                font-size: 0.85rem;
                color: #86efac;
                text-decoration: none;
                margin-bottom: 0.55rem;
                transition: color 0.2s;
                cursor: pointer;
            }
            .footer-col a:hover { color: #ffffff; }
            .footer-col p {
                font-size: 0.85rem;
                color: #86efac;
                margin-bottom: 0.55rem;
                line-height: 1.6;
            }
            .footer-divider {
                max-width: 1280px;
                margin: 2.5rem auto 0;
                border: none;
                border-top: 1px solid rgba(255,255,255,0.15);
            }
            .footer-bottom {
                max-width: 1280px;
                margin: 1.25rem auto 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 0.75rem;
                font-size: 0.8rem;
                color: #bbf7d0;
            }
            .footer-badge {
                display: inline-block;
                background: rgba(21,128,61,0.15);
                border: 1px solid rgba(21,128,61,0.3);
                color: #4ade80;
                font-size: 0.7rem;
                font-weight: 700;
                padding: 0.25rem 0.75rem;
                border-radius: 999px;
                letter-spacing: 0.08em;
            }
            @media (max-width: 768px) {
                .footer-inner {
                    grid-template-columns: 1fr 1fr;
                    gap: 2rem;
                }
            }
            @media (max-width: 480px) {
                .footer-inner {
                    grid-template-columns: 1fr;
                }
                .footer-bottom {
                    flex-direction: column;
                    text-align: center;
                }
            }
        </style>
    </head>

    <body class="font-sans antialiased" style="display:flex; flex-direction:column; min-height:100vh; background:#f5f5f4;">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main style="flex:1;">
            @yield('content')
        </main>

        {{-- ════════════════════════════════
             FOOTER
        ════════════════════════════════ --}}
        <footer class="site-footer">
            <div class="footer-inner">

                {{-- Brand --}}
                <div class="footer-brand">
                    <div class="footer-logo-font">🌿 FlowerPot</div>
                    <p>Bringing nature closer to you. Quality pots and plants for every home in Kathmandu Valley. Delivered to your doorstep.</p>
                    <div style="margin-top:1rem; display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <span class="footer-badge">🌿 100% Natural</span>
                        <span class="footer-badge">🚚 Fast Delivery</span>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('about') }}">About Us</a>
                    <a href="{{ route('products.index') }}">Products</a>
                    <a href="{{ route('services') }}">Services</a>
                    <a href="{{ route('contact') }}">Contact Us</a>
                </div>

                {{-- Products --}}
                <div class="footer-col">
                    <h4>Our Products</h4>
                    <a href="{{ route('products.ceramics') }}">Ceramics</a>
                    <a href="{{ route('products.cement') }}">Cement Pots</a>
                    <a href="{{ route('products.mud') }}">Mud Pots</a>
                    <a href="{{ route('products.plastic') }}">Plastic Pots</a>
                    <a href="{{ route('products.plants') }}">Indoor Plants</a>
                </div>

                {{-- Contact Info --}}
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p>📍 Kathmandu, Nepal</p>
                    <p>📞 9763686254</p>
                    <p>📞 9813067906</p>
                    <p>✉️ uniquekhanal2020@gmail.com</p>
                    <p>🕐 sun–fri: 9AM – 8PM</p>
                    <p>🕐 Sat: 10AM – 5PM</p>
                </div>

            </div>

            <hr class="footer-divider">

            <div class="footer-bottom">
                <span>© {{ date('Y') }} FlowerPot. All rights reserved. Made with 🌿 in Nepal.</span>
                <div style="display:flex; gap:1rem; align-items:center;">
                    <a href="{{ route('about') }}" style="color:#86efac; text-decoration:none; font-size:0.8rem; transition:color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#86efac'">Privacy Policy</a>
                    <a href="{{ route('about') }}" style="color:#86efac; text-decoration:none; font-size:0.8rem; transition:color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#86efac'">Terms of Service</a>
                    <a href="{{ route('contact') }}" style="color:#86efac; text-decoration:none; font-size:0.8rem; transition:color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#86efac'">Support</a>
                </div>
            </div>
        </footer>

        {{-- ════════════════════════════════
             IMAGE ZOOM OVERLAY
        ════════════════════════════════ --}}
        <div class="zoom-overlay" id="zoomOverlay" onclick="closeZoom()">
            <button class="zoom-close" onclick="closeZoom()">✕</button>
            <img id="zoomImg" src="" alt="Product zoom">
        </div>

        {{-- SweetAlert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // ── LOGIN ALERT ───────────────────────────────
            function showLoginAlert() {
                Swal.fire({
                    title: '🔒 Login Required',
                    html: `
                        <p style="color:#57534e;font-size:0.95rem;margin-bottom:0.5rem;">
                            You need an account to view product details.
                        </p>
                        <p style="color:#57534e;font-size:0.9rem;">
                            Please login or create a free account to continue.
                        </p>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '🌿 Login',
                    cancelButtonText: 'Create Account',
                    confirmButtonColor: '#15803d',
                    cancelButtonColor: '#d97706',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl px-6',
                        cancelButton: 'rounded-xl px-6',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("login") }}';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = '{{ route("register") }}';
                    }
                });
            }

            // ── IMAGE ZOOM ────────────────────────────────
            function openZoom(src, alt) {
                const overlay = document.getElementById('zoomOverlay');
                const img     = document.getElementById('zoomImg');
                img.src = src;
                img.alt = alt || 'Product Image';
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeZoom() {
                document.getElementById('zoomOverlay').classList.remove('active');
                document.body.style.overflow = '';
            }

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeZoom();
            });

            // Auto-attach zoom to all product images on page load
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('img[data-zoomable]').forEach(function(img) {
                    img.classList.add('zoomable');
                    img.addEventListener('click', function() {
                        openZoom(this.src, this.alt);
                    });
                });
            });
        </script>

    </body>
</html>
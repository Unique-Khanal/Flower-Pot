<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Biruwa</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .brand-font { font-family: 'Cinzel Decorative', serif; }
        .admin-auth-input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1.5px solid #E4E1D8;
            border-radius: 0.85rem;
            font-size: 0.92rem;
            font-family: 'DM Sans', sans-serif;
            color: #1c1917;
            background: #FBFAF6;
            transition: all 0.2s;
            outline: none;
        }
        .admin-auth-input:focus {
            border-color: #2F6B4F;
            background: white;
            box-shadow: 0 0 0 4px rgba(47,107,79,0.10);
        }
        .grain-blob {
            position: absolute;
            border-radius: 999px;
            filter: blur(60px);
            opacity: .45;
        }
    </style>
</head>
<body class="antialiased">

    <div class="min-h-screen grid lg:grid-cols-2">

        {{-- ═══ LEFT — brand panel (hidden on small screens) ═══ --}}
        <div class="hidden lg:flex relative flex-col justify-between overflow-hidden px-14 py-12"
             style="background: linear-gradient(160deg, #0B1912 0%, #14301F 45%, #1B3B2F 75%, #2F6B4F 130%);">

            <div class="grain-blob w-96 h-96 -top-20 -left-20" style="background:#3F7A57;"></div>
            <div class="grain-blob w-80 h-80 bottom-10 -right-16" style="background:#D8B968;"></div>

            <div class="relative z-10 flex items-center gap-3">
                <div class="rounded-2xl px-4 py-3 shadow-sm" style="background:#F4F5F1;">
                    <x-application-logo class="h-9 w-auto object-contain" />
                </div>
            </div>

            <div class="relative z-10 max-w-md">
                <h2 class="text-4xl font-extrabold text-white leading-tight mb-5">
                    घर-घरमा हरियाली<br>
                    <span class="text-[#D8B968]">— run from one place.</span>
                </h2>
                <p class="text-[#B9CBBB] text-[15px] leading-relaxed">
                    Approve vendors, settle commissions, and keep every order moving —
                    all secured behind two-factor verification.
                </p>

                <div class="flex items-center gap-6 mt-9">
                    <div>
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D8B968" stroke-width="1.5" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 10.5h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                        <p class="text-[11px] text-[#9AB3A0] mt-2">2FA secured</p>
                    </div>
                    <div class="w-px h-9 bg-white/10"></div>
                    <div>
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D8B968" stroke-width="1.5" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m3-9L21 12m0 0-4.5 4.5M21 12H7.5"/></svg>
                        <p class="text-[11px] text-[#9AB3A0] mt-2">Vendor network</p>
                    </div>
                    <div class="w-px h-9 bg-white/10"></div>
                    <div>
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D8B968" stroke-width="1.5" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5 12 3 3 7.5m18 0-9 4.5m9-4.5v9L12 21m0-9L3 7.5m9 4.5v9m-9-9v9l9 4.5"/></svg>
                        <p class="text-[11px] text-[#9AB3A0] mt-2">Live catalog</p>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-[11px] text-[#7FA089]">
                &copy; {{ date('Y') }} Biruwa. Internal admin access only.
            </p>
        </div>

        {{-- ═══ RIGHT — auth form panel ═══ --}}
        <div class="flex flex-col items-center justify-center px-6 py-14 bg-[#FBFAF6]">

            <div class="flex lg:hidden items-center gap-2.5 mb-8">
                <x-application-logo class="h-10 w-auto object-contain" />
            </div>

            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>
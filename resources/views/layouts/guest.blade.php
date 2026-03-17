<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FlowerPot') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .logo-font {
            font-family: 'Cinzel Decorative', serif;
            background: linear-gradient(135deg, #166534, #15803d, #a16207);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .auth-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1.5px solid #d6d3d1;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: #1c1917;
            background: #fafaf9;
            transition: all 0.2s;
            outline: none;
        }
        .auth-input:focus {
            border-color: #15803d;
            background: white;
            box-shadow: 0 0 0 3px rgba(21,128,61,0.1);
        }
        .auth-btn {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #166534, #15803d);
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.03em;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(21,128,61,0.3);
        }
        .auth-btn:hover {
            background: linear-gradient(135deg, #14532d, #166534);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(21,128,61,0.4);
        }
        .input-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #78716c;
            width: 18px;
            height: 18px;
        }
        .floating-leaf {
            position: absolute;
            opacity: 0.06;
            pointer-events: none;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }
        .leaf-1 { animation: float 6s ease-in-out infinite; }
        .leaf-2 { animation: float 8s ease-in-out infinite 2s; }
        .leaf-3 { animation: float 7s ease-in-out infinite 4s; }
    </style>
</head>
<body class="antialiased min-h-screen" style="background: linear-gradient(135deg, #f0fdf4 0%, #fefce8 50%, #f0fdf4 100%);">

    <!-- Decorative floating leaves -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <svg class="floating-leaf leaf-1" style="top:10%;left:5%;width:200px;" viewBox="0 0 100 100">
            <path d="M50 10 C20 10 5 40 10 70 C20 90 50 95 70 80 C90 60 90 20 50 10Z" fill="#166534"/>
        </svg>
        <svg class="floating-leaf leaf-2" style="top:60%;right:5%;width:150px;" viewBox="0 0 100 100">
            <path d="M50 10 C20 10 5 40 10 70 C20 90 50 95 70 80 C90 60 90 20 50 10Z" fill="#15803d"/>
        </svg>
        <svg class="floating-leaf leaf-3" style="bottom:10%;left:20%;width:120px;" viewBox="0 0 100 100">
            <path d="M50 10 C20 10 5 40 10 70 C20 90 50 95 70 80 C90 60 90 20 50 10Z" fill="#166534"/>
        </svg>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10 relative z-10">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex flex-col items-center mb-8 group">
            <x-application-logo class="h-20 w-20 drop-shadow-lg transition-transform group-hover:scale-105" />
            <span class="logo-font text-2xl mt-2 tracking-wide">FlowerPot</span>
            <span style="font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:#a16207;margin-top:2px;">
                Kathmandu, Nepal
            </span>
        </a>

        <!-- Card -->
        <div class="w-full max-w-md relative">
            <div class="absolute -inset-1 rounded-3xl opacity-30"
                 style="background:linear-gradient(135deg,#bbf7d0,#fef08a,#bbf7d0);filter:blur(12px);"></div>

            <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden"
                 style="border:1px solid rgba(21,128,61,0.12);">

                <!-- Top accent bar -->
                <div class="h-1.5 w-full"
                     style="background:linear-gradient(to right,#166534,#15803d,#a16207,#fbbf24);"></div>

                <div class="px-8 py-8">
                    {{ $slot }}
                </div>

                <!-- Back to home -->
                <div class="px-8 pb-6 text-center">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-1.5 text-sm font-medium text-stone-500 hover:text-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
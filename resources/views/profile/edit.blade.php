@extends('layouts.app')
@section('title', 'My Profile')
@section('content')

<section class="py-12 px-4 min-h-screen" style="background:linear-gradient(135deg,#f0fdf4 0%,#fefce8 50%,#f0fdf4 100%);">
    <div class="max-w-4xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-8 text-center">
            <h1 style="font-family:'Cinzel Decorative',serif;
                        background:linear-gradient(135deg,#166534,#15803d,#a16207);
                        -webkit-background-clip:text; -webkit-text-fill-color:transparent;
                        background-clip:text; font-size:2rem; font-weight:700;">
                My Profile
            </h1>
            <p style="color:#78716c; font-size:0.95rem; margin-top:0.4rem;">
                Manage your account information and security settings
            </p>
        </div>

        {{-- Profile Card Top --}}
        <div style="background:white; border-radius:1.5rem; overflow:hidden;
                    box-shadow:0 4px 24px rgba(0,0,0,0.08); margin-bottom:1.5rem;
                    border:1px solid rgba(21,128,61,0.1);">

            {{-- Green top bar --}}
            <div style="height:6px; background:linear-gradient(to right,#166534,#15803d,#a16207,#fbbf24);"></div>

            {{-- Avatar + Name Banner --}}
            <div style="background:linear-gradient(135deg,#166534,#15803d);
                        padding:2rem 2rem 3.5rem; position:relative; text-align:center;">
                {{-- Avatar --}}
                <div style="width:90px; height:90px; border-radius:50%; overflow:hidden;
                             border:4px solid white; margin:0 auto 1rem;
                             box-shadow:0 4px 20px rgba(0,0,0,0.2);">
                    <x-avatar :avatar="Auth::user()->avatar" :size="90" />
                </div>
                <h2 style="color:white; font-size:1.4rem; font-weight:700; margin:0;">
                    {{ Auth::user()->name }}
                </h2>
                <p style="color:#bbf7d0; font-size:0.875rem; margin-top:0.25rem;">
                    {{ Auth::user()->email }}
                </p>
                <span style="display:inline-block; margin-top:0.5rem;
                              background:rgba(251,191,36,0.2); border:1px solid rgba(251,191,36,0.4);
                              color:#fbbf24; font-size:0.7rem; font-weight:700;
                              padding:0.2rem 0.75rem; border-radius:999px;
                              letter-spacing:0.08em; text-transform:uppercase;">
                    {{ ucfirst(Auth::user()->gender) }} Member
                </span>
            </div>

            {{-- Stats Row --}}
            <div style="display:grid; grid-template-columns:repeat(3,1fr);
                        border-top:1px solid #f5f5f4; margin-top:-1.5rem;
                        background:white; border-radius:0 0 1.5rem 1.5rem;">
                @php
                    $orderCount     = \App\Models\Order::where('user_id', Auth::id())->count();
                    $pendingCount   = \App\Models\Order::where('user_id', Auth::id())->where('status','pending')->count();
                    $deliveredCount = \App\Models\Order::where('user_id', Auth::id())->where('status','delivered')->count();
                @endphp
                <div style="padding:1.5rem; text-align:center; border-right:1px solid #f5f5f4;">
                    <p style="font-size:1.75rem; font-weight:800; color:#166534; margin:0;">{{ $orderCount }}</p>
                    <p style="font-size:0.75rem; color:#78716c; margin-top:0.2rem; text-transform:uppercase; letter-spacing:0.08em;">Total Orders</p>
                </div>
                <div style="padding:1.5rem; text-align:center; border-right:1px solid #f5f5f4;">
                    <p style="font-size:1.75rem; font-weight:800; color:#d97706; margin:0;">{{ $pendingCount }}</p>
                    <p style="font-size:0.75rem; color:#78716c; margin-top:0.2rem; text-transform:uppercase; letter-spacing:0.08em;">Pending</p>
                </div>
                <div style="padding:1.5rem; text-align:center;">
                    <p style="font-size:1.75rem; font-weight:800; color:#15803d; margin:0;">{{ $deliveredCount }}</p>
                    <p style="font-size:0.75rem; color:#78716c; margin-top:0.2rem; text-transform:uppercase; letter-spacing:0.08em;">Delivered</p>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1.5rem;">
            <a href="{{ route('orders.index') }}"
               style="background:white; border-radius:1rem; padding:1.25rem;
                      text-align:center; text-decoration:none;
                      border:1px solid rgba(21,128,61,0.1);
                      box-shadow:0 2px 8px rgba(0,0,0,0.06);
                      transition:all 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="font-size:1.75rem; margin-bottom:0.4rem;">📦</div>
                <p style="font-size:0.8rem; font-weight:700; color:#1c1917; margin:0;">My Orders</p>
                <p style="font-size:0.7rem; color:#78716c; margin:0.2rem 0 0;">View order history</p>
            </a>
            <a href="{{ route('cart.index') }}"
               style="background:white; border-radius:1rem; padding:1.25rem;
                      text-align:center; text-decoration:none;
                      border:1px solid rgba(21,128,61,0.1);
                      box-shadow:0 2px 8px rgba(0,0,0,0.06);
                      transition:all 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="font-size:1.75rem; margin-bottom:0.4rem;">🛒</div>
                <p style="font-size:0.8rem; font-weight:700; color:#1c1917; margin:0;">My Cart</p>
                <p style="font-size:0.7rem; color:#78716c; margin:0.2rem 0 0;">View cart items</p>
            </a>
            <a href="{{ route('products.index') }}"
               style="background:white; border-radius:1rem; padding:1.25rem;
                      text-align:center; text-decoration:none;
                      border:1px solid rgba(21,128,61,0.1);
                      box-shadow:0 2px 8px rgba(0,0,0,0.06);
                      transition:all 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="font-size:1.75rem; margin-bottom:0.4rem;">🌿</div>
                <p style="font-size:0.8rem; font-weight:700; color:#1c1917; margin:0;">Shop Now</p>
                <p style="font-size:0.7rem; color:#78716c; margin:0.2rem 0 0;">Browse products</p>
            </a>
        </div>

        {{-- Update Profile Information --}}
        <div style="background:white; border-radius:1.5rem; overflow:hidden;
                    box-shadow:0 2px 12px rgba(0,0,0,0.07);
                    border:1px solid rgba(21,128,61,0.1); margin-bottom:1.5rem;">
            <div style="padding:1.5rem 2rem; border-bottom:1px solid #f5f5f4;
                        display:flex; align-items:center; gap:0.75rem;">
                <div style="width:36px; height:36px; background:#dcfce7; border-radius:0.75rem;
                             display:flex; align-items:center; justify-content:center; font-size:1.1rem;">
                    👤
                </div>
                <div>
                    <h3 style="font-size:1rem; font-weight:700; color:#1c1917; margin:0;">Profile Information</h3>
                    <p style="font-size:0.8rem; color:#78716c; margin:0;">Update your name and email address</p>
                </div>
            </div>
            <div style="padding:1.75rem 2rem;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div style="background:white; border-radius:1.5rem; overflow:hidden;
                    box-shadow:0 2px 12px rgba(0,0,0,0.07);
                    border:1px solid rgba(21,128,61,0.1); margin-bottom:1.5rem;">
            <div style="padding:1.5rem 2rem; border-bottom:1px solid #f5f5f4;
                        display:flex; align-items:center; gap:0.75rem;">
                <div style="width:36px; height:36px; background:#fef9c3; border-radius:0.75rem;
                             display:flex; align-items:center; justify-content:center; font-size:1.1rem;">
                    🔒
                </div>
                <div>
                    <h3 style="font-size:1rem; font-weight:700; color:#1c1917; margin:0;">Update Password</h3>
                    <p style="font-size:0.8rem; color:#78716c; margin:0;">Ensure your account is using a strong password</p>
                </div>
            </div>
            <div style="padding:1.75rem 2rem;">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account --}}
        <div style="background:white; border-radius:1.5rem; overflow:hidden;
                    box-shadow:0 2px 12px rgba(0,0,0,0.07);
                    border:1px solid rgba(239,68,68,0.2); margin-bottom:1.5rem;">
            <div style="padding:1.5rem 2rem; border-bottom:1px solid #fef2f2;
                        display:flex; align-items:center; gap:0.75rem;">
                <div style="width:36px; height:36px; background:#fee2e2; border-radius:0.75rem;
                             display:flex; align-items:center; justify-content:center; font-size:1.1rem;">
                    ⚠️
                </div>
                <div>
                    <h3 style="font-size:1rem; font-weight:700; color:#b91c1c; margin:0;">Delete Account</h3>
                    <p style="font-size:0.8rem; color:#78716c; margin:0;">Permanently delete your account and all data</p>
                </div>
            </div>
            <div style="padding:1.75rem 2rem;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

        {{-- Back to home --}}
        <div style="text-align:center; margin-top:2rem;">
            <a href="{{ route('home') }}"
               style="display:inline-flex; align-items:center; gap:0.5rem;
                      color:#15803d; font-size:0.875rem; font-weight:600;
                      text-decoration:none; transition:color 0.2s;"
               onmouseover="this.style.color='#166534'"
               onmouseout="this.style.color='#15803d'">
                ← Back to Home
            </a>
        </div>

    </div>
</section>

@endsection
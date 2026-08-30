<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminTwoFactorVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('admin_2fa_verified')) {
            return redirect()->route('admin.2fa.show');
        }

        return $next($request);
    }
}
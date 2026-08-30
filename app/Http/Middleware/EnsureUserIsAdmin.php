<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isAdmin()) {
            // Admin session but role was changed elsewhere (e.g. by another
            // admin) mid-session — don't just 403, kick them out of the
            // admin area entirely and send them to the customer login.
            if ($user) {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return redirect()->route('login')
                ->withErrors(['email' => 'Your admin access has been removed. Please log in as a customer.']);
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Sends an already-authenticated user to the correct area for
     * their role, instead of Laravel's default behaviour of always
     * redirecting to the customer 'dashboard' route regardless of
     * who's logged in.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /** @var User $user */
                $user = Auth::guard($guard)->user();

                if ($user->isAdmin()) {
                    return redirect()->route('admin.vendors.index');
                }

                if ($user->isVendor()) {
                    return redirect()->route('vendor.dashboard');
                }

                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
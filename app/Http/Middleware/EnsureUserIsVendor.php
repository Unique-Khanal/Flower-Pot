<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsVendor
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isVendor() || ! $user->vendor) {
            abort(403, 'Unauthorized.');
        }

        // Only fully approved vendors get the real dashboard — pending/rejected
        // vendors are routed to a status page instead (handled in the controller).
        return $next($request);
    }
}
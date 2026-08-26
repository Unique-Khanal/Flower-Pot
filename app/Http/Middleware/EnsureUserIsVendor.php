<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsVendor
{
    /**
     * Second line of defense behind the login-time check in
     * RedirectsAfterAuthentication — even if a vendor somehow reaches
     * an authenticated request without going through login (e.g. an
     * old session from before approval), this middleware independently
     * re-verifies status on every request to /vendor/* routes.
     *
     * Same whitelist principle: only 'approved' passes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isVendor() || ! $user->vendor) {
            abort(403, 'Unauthorized.');
        }

        if ($user->vendor->status !== 'approved') {
            abort(403, 'Your vendor account is not yet approved.');
        }

        return $next($request);
    }
}
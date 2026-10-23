<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in, or not an admin: stop with 403 Forbidden
        if (! $request->user()?->isAdmin()) {
            abort(403);
        }

        return $next($request);
    }
}

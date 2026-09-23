<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Allow the request through only for signed-in administrators.
     *
     * A signed-in student who reaches an admin URL gets a 403 rather than a
     * redirect to the admin login: they are authenticated, just not permitted,
     * and bouncing them to a login form they cannot satisfy would be a loop.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}

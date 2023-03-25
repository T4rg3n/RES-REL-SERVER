<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Access\Gate;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Gate::denies($role)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
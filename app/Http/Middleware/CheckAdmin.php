<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Utilisateur;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Gate::allows('isAdminOrHigher', $request)) {
            abort(403);
        }

        return $next($request);
    }
}

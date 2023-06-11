<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Utilisateur;

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
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->role->nom_role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}

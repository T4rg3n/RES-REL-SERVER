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
        $user = $request->utilisateur();

        if (Gate::allows('isSuperAdmin', $user->role->nom_role)) {
            return $next($request);
        }

        if (Gate::allows('isAdmin', $user->id_uti)) {
            return $next($request);
        }

        if (Gate::allows('isModerator', $user->id_uti)) {
            return $next($request);
        }

        if (Gate::allows('isUser', $user->id_uti)) {
            return $next($request);
        }

        abort(403);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado y si tiene el rol adecuado
        if (!Auth::check() || Auth::user()->rol !== $role) {
            return response()->json(['message' => 'No tienes acceso a este recurso.'], 403);
        }

        return $next($request);
    }
}
    
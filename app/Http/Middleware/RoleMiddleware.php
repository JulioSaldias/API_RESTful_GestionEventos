<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado y si tiene uno de los roles permitidos
        if ($user && in_array($user->rol, $roles)) {
            return $next($request);
        }

        return response()->json(['message' => 'Acceso denegado'], 403);
    }
}

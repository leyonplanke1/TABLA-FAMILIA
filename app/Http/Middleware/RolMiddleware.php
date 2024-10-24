<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica si el usuario tiene alguno de los roles permitidos
            foreach ($roles as $role) {
                if (($role === 'admin' && $user->esAdmin()) || 
                    ($role === 'cliente' && $user->esCliente())) {
                    return $next($request);
                }
            }
        }

        // Redirige si no tiene los permisos adecuados
        return redirect('/home')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}

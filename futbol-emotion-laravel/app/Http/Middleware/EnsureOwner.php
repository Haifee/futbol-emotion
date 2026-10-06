<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Candado de rol: solo deja pasar al dueño (owner).
 * El rol viene de la sesión (lo pone AuthPin), no del cliente,
 * así que no se puede falsificar desde el navegador.
 */
class EnsureOwner
{
    public function handle(Request $request, Closure $next)
    {
        if (session('rol') !== 'owner') {
            return response()->json([
                'error' => 'Solo el dueño puede realizar esta acción',
            ], 403);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthPin
{
    // PINs — cámbialos antes de subir al servidor
    const PINS = [
        'manager' => '1234',
        'owner'   => '0000',
    ];

    public function handle(Request $request, Closure $next)
    {
        $rol = session('rol');

        if (!$rol || !isset(self::PINS[$rol])) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        // Guardar el rol en el request para usarlo en los controladores
        $request->merge(['_rol' => $rol]);

        return $next($request);
    }
}

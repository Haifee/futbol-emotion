<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    const PINS = [
        'manager' => '1234',
        'owner'   => '0000',
    ];

    public function login(Request $request)
    {
        $rol = $request->input('rol');
        $pin = $request->input('pin');

        if (!isset(self::PINS[$rol]) || self::PINS[$rol] !== $pin) {
            return response()->json(['error' => 'PIN incorrecto'], 401);
        }

        session(['rol' => $rol]);

        return response()->json([
            'ok'  => true,
            'rol' => $rol,
        ]);
    }

    public function logout()
    {
        session()->forget('rol');
        return response()->json(['ok' => true]);
    }

    public function me(Request $request)
    {
        $rol = session('rol');
        if (!$rol) {
            return response()->json(['autenticado' => false], 401);
        }
        return response()->json(['autenticado' => true, 'rol' => $rol]);
    }
}

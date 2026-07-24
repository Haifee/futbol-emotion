<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    /** Claves permitidas y su valor por defecto */
    private const CLAVES = [
        'proveedor_1'       => '',
        'proveedor_2'       => '',
        'proveedor_3'       => '',
        'proveedor_4'       => '',
        'manager_bloqueado' => '0',
    ];

    public function index(Request $request)
    {
        $filas = DB::table('configuracion')->get()->pluck('valor', 'clave')->toArray();
        $config = array_merge(self::CLAVES, array_intersect_key($filas, self::CLAVES));

        // El encargado no necesita saber si está por ser bloqueado ni los nombres
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['manager_bloqueado' => $config['manager_bloqueado']]);
        }

        return response()->json($config);
    }

    public function update(Request $request)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede cambiar la configuración'], 403);
        }

        $guardadas = [];

        foreach (self::CLAVES as $clave => $default) {
            if (!$request->has($clave)) {
                continue;
            }

            $valor = (string) $request->input($clave);

            if ($clave === 'manager_bloqueado') {
                $valor = in_array($valor, ['1', 'true', 'on'], true) ? '1' : '0';
            } else {
                $valor = mb_substr(trim($valor), 0, 60);
            }

            DB::table('configuracion')->updateOrInsert(
                ['clave' => $clave],
                ['valor' => $valor, 'updated_at' => now(), 'created_at' => now()]
            );

            $guardadas[$clave] = $valor;
        }

        return response()->json(['ok' => true, 'config' => $guardadas]);
    }
}

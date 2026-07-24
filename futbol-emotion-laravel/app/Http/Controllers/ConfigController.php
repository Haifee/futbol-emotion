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
        'tasa_bcv'          => '0',
        'tasa_fecha'        => '',
        'tasa_origen'       => 'manual',
    ];

    public function index(Request $request)
    {
        $filas = DB::table('configuracion')->get()->pluck('valor', 'clave')->toArray();
        $config = array_merge(self::CLAVES, array_intersect_key($filas, self::CLAVES));

        // El encargado no necesita saber si está por ser bloqueado ni los nombres
        if ($request->input('_rol') !== 'owner') {
            return response()->json([
                'manager_bloqueado' => $config['manager_bloqueado'],
                'tasa_bcv'          => $config['tasa_bcv'],
                'tasa_fecha'        => $config['tasa_fecha'],
                'tasa_origen'       => $config['tasa_origen'],
            ]);
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

            if ($clave === 'tasa_bcv') {
                $num = (float) str_replace(',', '.', $valor);
                if ($num < 0 || $num > 1000000) {
                    return response()->json(['error' => 'La tasa no es válida'], 422);
                }
                $valor = number_format($num, 4, '.', '');
            } elseif ($clave === 'manager_bloqueado') {
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

    /**
     * Consulta la tasa oficial del BCV desde el servidor.
     * Si la fuente no responde, la app se queda con la última tasa guardada.
     */
    public function tasaBcv(Request $request)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede actualizar la tasa'], 403);
        }

        $fuentes = [
            ['url' => 'https://ve.dolarapi.com/v1/dolares/oficial', 'campo' => 'promedio'],
            ['url' => 'https://pydolarve.org/api/v1/dollar?page=bcv', 'campo' => null],
        ];

        foreach ($fuentes as $f) {
            try {
                $ctx = stream_context_create([
                    'http' => ['timeout' => 8, 'header' => "User-Agent: FutbolEmotion/1.0\r\n"],
                    'ssl'  => ['verify_peer' => true, 'verify_peer_name' => true],
                ]);
                $raw = @file_get_contents($f['url'], false, $ctx);
                if ($raw === false) continue;

                $json = json_decode($raw, true);
                if (!is_array($json)) continue;

                $tasa = null;
                if ($f['campo'] && isset($json[$f['campo']])) {
                    $tasa = (float) $json[$f['campo']];
                } elseif (isset($json['monitors']['bcv']['price'])) {
                    $tasa = (float) $json['monitors']['bcv']['price'];
                }

                if ($tasa && $tasa > 0) {
                    $tasa = number_format($tasa, 4, '.', '');
                    $hoy  = now()->toDateString();

                    foreach ([['tasa_bcv', $tasa], ['tasa_fecha', $hoy], ['tasa_origen', 'BCV automática']] as $par) {
                        DB::table('configuracion')->updateOrInsert(
                            ['clave' => $par[0]],
                            ['valor' => $par[1], 'updated_at' => now(), 'created_at' => now()]
                        );
                    }

                    return response()->json([
                        'ok'     => true,
                        'tasa'   => $tasa,
                        'fecha'  => $hoy,
                        'origen' => 'BCV automática',
                    ]);
                }
            } catch (\Throwable $e) {
                continue;
            }
        }

        return response()->json([
            'error' => 'No se pudo consultar la tasa oficial ahora. Escríbela a mano.',
        ], 503);
    }
}

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
        'tasa_euro'         => '0',
        'tasa_binance'      => '0',
        'tasa_fecha'        => '',
        'tasa_origen'       => 'manual',
        'banco_receptor'    => '',
        'titular_pago'      => '',
        'telefono_pago'     => '',
        'cedula_pago'       => '',
        'clave_cierre'      => '',
        'nombre_owner'      => '',
        'nombre_manager'    => '',
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
                'tasa_euro'         => $config['tasa_euro'],
                'tasa_binance'      => $config['tasa_binance'],
                'tasa_fecha'        => $config['tasa_fecha'],
                'tasa_origen'       => $config['tasa_origen'],
                'banco_receptor'    => $config['banco_receptor'],
                'titular_pago'      => $config['titular_pago'],
                'telefono_pago'     => $config['telefono_pago'],
                'cedula_pago'       => $config['cedula_pago'],
                'clave_cierre_activa' => !empty($config['clave_cierre']) ? '1' : '0',
                'nombre_owner'      => $config['nombre_owner'],
                'nombre_manager'    => $config['nombre_manager'],
            ]);
        }

        // La clave de cierre nunca se envía; solo si está configurada o no
        $config['clave_cierre_activa'] = !empty($config['clave_cierre']) ? '1' : '0';
        unset($config['clave_cierre']);

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

            if (in_array($clave, ['tasa_bcv', 'tasa_euro', 'tasa_binance'], true)) {
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

        $resultado = [];
        $hoy = now()->toDateString();

        // 1) Dólar y Euro oficiales BCV (DolarAPI, sin registro)
        $dolar = $this->pedirJson('https://ve.dolarapi.com/v1/dolares/oficial');
        if ($dolar && isset($dolar['promedio']) && $dolar['promedio'] > 0) {
            $resultado['tasa_bcv'] = number_format((float) $dolar['promedio'], 4, '.', '');
        }

        $euro = $this->pedirJson('https://ve.dolarapi.com/v1/euros/oficial');
        if ($euro && isset($euro['promedio']) && $euro['promedio'] > 0) {
            $resultado['tasa_euro'] = number_format((float) $euro['promedio'], 4, '.', '');
        }

        // 2) Binance (pydolarve, campo monitors.binance.price)
        $py = $this->pedirJson('https://pydolarve.org/api/v1/dollar?page=binance');
        if ($py && isset($py['monitors']['binance']['price']) && $py['monitors']['binance']['price'] > 0) {
            $resultado['tasa_binance'] = number_format((float) $py['monitors']['binance']['price'], 4, '.', '');
        }

        if (empty($resultado)) {
            return response()->json([
                'error' => 'No se pudieron consultar las tasas ahora. Escríbelas a mano.',
            ], 503);
        }

        // Guardar lo que se haya podido traer
        $resultado['tasa_fecha']  = $hoy;
        $resultado['tasa_origen'] = 'automática';
        foreach ($resultado as $clave => $valor) {
            DB::table('configuracion')->updateOrInsert(
                ['clave' => $clave],
                ['valor' => $valor, 'updated_at' => now(), 'created_at' => now()]
            );
        }

        return response()->json(['ok' => true, 'tasas' => $resultado, 'fecha' => $hoy]);
    }

    /**
     * GET a una URL con timeout corto. Devuelve el JSON como array o null.
     */
    private function pedirJson(string $url)
    {
        try {
            $ctx = stream_context_create([
                'http' => ['timeout' => 8, 'header' => "User-Agent: FutbolEmotion/1.0\r\n"],
                'ssl'  => ['verify_peer' => true, 'verify_peer_name' => true],
            ]);
            $raw = @file_get_contents($url, false, $ctx);
            if ($raw === false) return null;
            $json = json_decode($raw, true);
            return is_array($json) ? $json : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

}

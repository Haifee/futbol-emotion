<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigracionController extends Controller
{
    /**
     * Recibe todos los datos del localStorage y los importa a MySQL.
     * Se llama una sola vez desde migrar.html
     */
    public function importar(Request $request)
    {
        $datos = $request->validate([
            'camisetas'      => 'nullable|array',
            'pedidos'        => 'nullable|array',
            'envios'         => 'nullable|array',
            'devoluciones'   => 'nullable|array',
            'ventas'         => 'nullable|array',
            'transacciones'  => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $resumen = [];

            // CAMISETAS
            if (!empty($datos['camisetas'])) {
                DB::table('camisetas')->truncate();
                foreach ($datos['camisetas'] as $c) {
                    DB::table('camisetas')->insert([
                        'id'           => $c['id'],
                        'equipo'       => $c['equipo'],
                        'temporada'    => $c['temp'] ?? '24/25',
                        'tipo'         => $c['tipo'] ?? 'Local',
                        'talla_s'      => $c['tallas']['S']   ?? 0,
                        'talla_m'      => $c['tallas']['M']   ?? 0,
                        'talla_l'      => $c['tallas']['L']   ?? 0,
                        'talla_xl'     => $c['tallas']['XL']  ?? 0,
                        'talla_xxl'    => $c['tallas']['XXL'] ?? 0,
                        'stock_minimo' => $c['min'] ?? 5,
                        'proveedor_id' => $c['prov'] ?? 1,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                }
                $resumen['camisetas'] = count($datos['camisetas']);
            }

            // PEDIDOS
            if (!empty($datos['pedidos'])) {
                DB::table('pedido_lineas')->truncate();
                DB::table('pedidos')->truncate();
                foreach ($datos['pedidos'] as $p) {
                    DB::table('pedidos')->insert([
                        'id'           => $p['id'],
                        'proveedor_id' => $p['provId'] ?? 1,
                        'estado'       => $p['estado'] ?? 'pendiente',
                        'notas'        => $p['notas'] ?? '',
                        'fecha'        => $p['fecha'] ?? now()->toDateString(),
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                    foreach (($p['lineas'] ?? []) as $l) {
                        $tallas = $l['tallas'] ?? [];
                        DB::table('pedido_lineas')->insert([
                            'pedido_id'  => $p['id'],
                            'equipo'     => $l['equipo'] ?? '',
                            'temporada'  => $l['temp']   ?? '24/25',
                            'talla_s'    => $tallas['S']   ?? 0,
                            'talla_m'    => $tallas['M']   ?? 0,
                            'talla_l'    => $tallas['L']   ?? 0,
                            'talla_xl'   => $tallas['XL']  ?? 0,
                            'talla_xxl'  => $tallas['XXL'] ?? 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $resumen['pedidos'] = count($datos['pedidos']);
            }

            // ENVÍOS
            if (!empty($datos['envios'])) {
                DB::table('envios')->truncate();
                foreach ($datos['envios'] as $e) {
                    DB::table('envios')->insert([
                        'id'           => $e['id'],
                        'cliente'      => $e['cliente']  ?? '',
                        'productos'    => $e['prods']    ?? '',
                        'origen'       => $e['origen']   ?? 'Otro',
                        'transportista'=> $e['trans']    ?? 'MRW',
                        'direccion'    => $e['dir']      ?? '',
                        'importe'      => $e['imp']      ?? 0,
                        'estado'       => $e['estado']   ?? 'preparando',
                        'notas'        => $e['notas']    ?? '',
                        'fecha'        => $e['fecha']    ?? now()->toDateString(),
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                }
                $resumen['envios'] = count($datos['envios']);
            }

            // DEVOLUCIONES
            if (!empty($datos['devoluciones'])) {
                DB::table('devoluciones')->truncate();
                foreach ($datos['devoluciones'] as $d) {
                    DB::table('devoluciones')->insert([
                        'id'                  => $d['id'],
                        'cliente'             => $d['cliente'] ?? '',
                        'motivo'              => $d['motivo']  ?? '',
                        'camiseta_devuelta'   => $d['dev']     ?? '',
                        'camiseta_solicitada' => $d['sol']     ?? '',
                        'importe'             => $d['imp']     ?? 0,
                        'estado'              => $d['estado']  ?? 'pendiente',
                        'fecha'               => $d['fecha']   ?? now()->toDateString(),
                        'created_at'          => now(),
                        'updated_at'          => now(),
                    ]);
                }
                $resumen['devoluciones'] = count($datos['devoluciones']);
            }

            // VENTAS
            if (!empty($datos['ventas'])) {
                DB::table('ventas')->truncate();
                foreach ($datos['ventas'] as $v) {
                    DB::table('ventas')->insert([
                        'id'          => $v['id'],
                        'camiseta_id' => $v['camId']  ?? 1,
                        'equipo'      => $v['equipo'] ?? '',
                        'talla'       => $v['talla']  ?? 'M',
                        'cantidad'    => $v['cant']   ?? 1,
                        'canal'       => $v['canal']  ?? 'Tienda física',
                        'cliente'     => $v['cliente'] ?? null,
                        'importe'     => $v['imp']    ?? 0,
                        'fecha'       => $v['fecha']  ?? now()->toDateString(),
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
                $resumen['ventas'] = count($datos['ventas']);
            }

            // TRANSACCIONES
            if (!empty($datos['transacciones'])) {
                DB::table('transacciones')->truncate();
                foreach ($datos['transacciones'] as $t) {
                    DB::table('transacciones')->insert([
                        'id'          => $t['id'],
                        'tipo'        => $t['tipo']  ?? 'ingreso',
                        'descripcion' => $t['desc']  ?? '',
                        'importe'     => $t['imp']   ?? 0,
                        'canal'       => $t['canal'] ?? 'Tienda física',
                        'fecha'       => $t['fecha'] ?? now()->toDateString(),
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
                $resumen['transacciones'] = count($datos['transacciones']);
            }

            DB::commit();

            return response()->json([
                'ok'      => true,
                'mensaje' => 'Migración completada exitosamente',
                'resumen' => $resumen,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error'   => 'Error durante la migración',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }
}

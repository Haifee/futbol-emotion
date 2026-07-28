<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PushService;

class DevolucionController extends Controller
{
    public function index()
    {
        return response()->json(
            DB::table('devoluciones')->orderBy('fecha', 'desc')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente'             => 'required|string',
            'motivo'              => 'required|string',
            'camiseta_devuelta'   => 'required|string',
            'camiseta_solicitada' => 'required|string',
        ]);

        $id = DB::table('devoluciones')->insertGetId([
            'cliente'             => $request->cliente,
            'motivo'              => $request->motivo,
            'camiseta_devuelta'   => $request->camiseta_devuelta,
            'dev_camiseta_id'     => $request->input('dev_camiseta_id'),
            'dev_talla'           => $request->input('dev_talla'),
            'camiseta_solicitada' => $request->camiseta_solicitada,
            'sol_camiseta_id'     => $request->input('sol_camiseta_id'),
            'sol_talla'           => $request->input('sol_talla'),
            'importe'             => $request->input('importe', 0),
            'estado'              => 'pendiente',
            'fecha'               => now()->toDateString(),
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        $actor = $request->input('_rol') === 'owner' ? 'owner' : 'manager';
        PushService::evento('devolucion', $actor, 'Nueva devolución ↩️',
            'Se registró una devolución/cambio');

        return response()->json(DB::table('devoluciones')->find($id), 201);
    }

    public function aprobar(Request $request, $id)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Sin permisos'], 403);
        }

        $dev = DB::table('devoluciones')->find($id);
        if (!$dev) return response()->json(['error' => 'No encontrada'], 404);

        DB::table('devoluciones')->where('id', $id)->update([
            'estado'     => 'aprobado',
            'updated_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }

    public function rechazar(Request $request, $id)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Sin permisos'], 403);
        }

        $dev = DB::table('devoluciones')->find($id);
        if (!$dev) return response()->json(['error' => 'No encontrada'], 404);

        DB::table('devoluciones')->where('id', $id)->update([
            'estado'     => 'rechazado',
            'updated_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }

    public function completar($id)
    {
        $dev = DB::table('devoluciones')->find($id);
        if (!$dev) return response()->json(['error' => 'No encontrada'], 404);

        if ($dev->estado !== 'aprobado') {
            return response()->json(['error' => 'El dueño debe aprobar este cambio primero'], 422);
        }

        // Columnas de talla válidas
        $tallaCol = function ($talla) {
            $t = strtolower((string) $talla);
            $validas = ['s','m','l','xl','xxl','10','12','14','16','u'];
            return in_array($t, $validas, true) ? 'talla_' . $t : null;
        };

        DB::beginTransaction();
        try {
            // Solo ajustar una vez
            if (!$dev->stock_aplicado) {
                // La camiseta que se lleva el cliente: RESTA del stock
                if ($dev->sol_camiseta_id && ($col = $tallaCol($dev->sol_talla))) {
                    $cam = DB::table('camisetas')->find($dev->sol_camiseta_id);
                    if ($cam) {
                        $actual = (int) $cam->$col;
                        $nuevo = max(0, $actual - 1); // nunca negativo
                        DB::table('camisetas')->where('id', $dev->sol_camiseta_id)->update([$col => $nuevo, 'updated_at' => now()]);
                    }
                }

                // La camiseta que devuelve el cliente: SUMA al stock
                if ($dev->dev_camiseta_id && ($col = $tallaCol($dev->dev_talla))) {
                    $cam = DB::table('camisetas')->find($dev->dev_camiseta_id);
                    if ($cam) {
                        DB::table('camisetas')->where('id', $dev->dev_camiseta_id)->update([
                            $col => (int) $cam->$col + 1,
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            DB::table('devoluciones')->where('id', $id)->update([
                'estado'         => 'cambiado',
                'stock_aplicado' => true,
                'updated_at'     => now(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'No se pudo completar el cambio'], 500);
        }

        return response()->json(['ok' => true]);
    }
}

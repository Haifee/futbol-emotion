<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatosController extends Controller
{
    // Borra datos del servidor (solo dueño). tipo: ventas | envios | transacciones | todo
    public function borrar(Request $request)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede borrar datos'], 403);
        }

        $tipo = $request->input('tipo');
        if (!in_array($tipo, ['ventas', 'envios', 'transacciones', 'todo'])) {
            return response()->json(['error' => 'Tipo inválido'], 422);
        }

        DB::beginTransaction();
        try {
            if ($tipo === 'ventas' || $tipo === 'todo') {
                // Las transacciones vinculadas quedan con venta_id = null (nullOnDelete)
                DB::table('ventas')->delete();
                // Reiniciar el contador de ventas de tienda física (#001, #002...)
                DB::table('configuracion')->where('clave', 'contador_ventas')->delete();
            }

            if ($tipo === 'envios' || $tipo === 'todo') {
                DB::table('envios')->delete();
            }

            if ($tipo === 'transacciones' || $tipo === 'todo') {
                DB::table('transacciones')->delete();
            }

            if ($tipo === 'todo') {
                DB::table('devoluciones')->delete();
                DB::table('pedidos')->delete();          // pedido_lineas caen en cascada
                DB::table('codigos_barras')->delete();
                DB::table('camisetas')->delete();        // después de ventas (FK restrict)
                DB::table('notificaciones_vistas')->delete();
                DB::table('actividad')->delete();
                DB::table('configuracion')->delete();
            }

            DB::commit();
            return response()->json(['ok' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al borrar los datos'], 500);
        }
    }
}

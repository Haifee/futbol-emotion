<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PushService;

class TransaccionController extends Controller
{
    public function index(Request $request)
    {
        // Rendimiento: por defecto solo lo reciente (?desde=YYYY-MM-DD); ?desde=all = todo.
        $desde = $request->query('desde');
        $q = DB::table('transacciones');
        if ($desde && $desde !== 'all') {
            $q->where('fecha', '>=', $desde);
        }
        return response()->json(
            $q->orderBy('fecha', 'desc')->orderBy('id', 'desc')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo'        => 'required|in:ingreso,gasto',
            'descripcion' => 'required|string',
            'importe'     => 'required|numeric|min:0',
            'canal'       => 'required|string',
        ]);

        $id = DB::table('transacciones')->insertGetId([
            'tipo'        => $request->tipo,
            'descripcion' => $request->descripcion,
            'importe'     => $request->importe,
            'canal'       => $request->canal,
            'fecha'       => now()->toDateString(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Notificar el gasto al dueño (si lo registró el encargado)
        $actor = $request->input('_rol') === 'owner' ? 'owner' : 'manager';
        if ($request->tipo === 'gasto') {
            PushService::evento('gasto', $actor, 'Nuevo gasto 🧾',
                $request->descripcion . ' · $' . number_format((float)$request->importe, 2));
        }

        return response()->json(DB::table('transacciones')->find($id), 201);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede eliminar movimientos'], 403);
        }

        $tx = DB::table('transacciones')->find($id);
        if (!$tx) return response()->json(['error' => 'Movimiento no encontrado'], 404);

        if (!empty($tx->venta_id)) {
            return response()->json(['error' => 'Este movimiento pertenece a una venta — edítala o elimínala desde Ventas'], 409);
        }

        DB::table('transacciones')->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }

    public function cierre()
    {
        $hoy       = now()->toDateString();
        $inicioSem = now()->startOfWeek()->toDateString();
        $inicioMes = now()->startOfMonth()->toDateString();

        $calcular = function ($desde) {
            $txs  = DB::table('transacciones')->where('fecha', '>=', $desde)->get();
            $vtas = DB::table('ventas')->where('fecha', '>=', $desde)->get();
            $envs = DB::table('envios')->where('fecha', '>=', $desde)->get();

            $ingresos = $txs->where('tipo', 'ingreso')->sum('importe');
            $gastos   = $txs->where('tipo', 'gasto')->sum('importe');
            $neto     = $ingresos - $gastos;

            $vFis = $vtas->where('canal', 'Tienda física');
            $vOnl = $vtas->where('canal', '!=', 'Tienda física');

            return [
                'ingresos'            => round($ingresos, 2),
                'gastos'              => round($gastos, 2),
                'neto'                => round($neto, 2),
                'margen'              => $ingresos > 0 ? round(($neto / $ingresos) * 100) : 0,
                'ventas_fisicas'      => $vFis->count(),
                'ventas_online'       => $vOnl->count(),
                'total_fisicas'       => round($vFis->sum('importe'), 2),
                'total_online'        => round($vOnl->sum('importe'), 2),
                'envios'              => $envs->count(),
                'movimientos'         => $txs->values(),
            ];
        };

        return response()->json([
            'hoy'    => $hoy,
            'dia'    => $calcular($hoy),
            'semana' => $calcular($inicioSem),
            'mes'    => $calcular($inicioMes),
        ]);
    }
}

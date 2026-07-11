<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $ventas = DB::table('ventas')
            ->orderBy('fecha', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($ventas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'camiseta_id' => 'nullable|integer|exists:camisetas,id',
            'equipo'      => 'required_without:camiseta_id|string',
            'talla'       => 'required|string|max:5',
            'cantidad'    => 'required|integer|min:1',
            'canal'       => 'required|string',
            'importe'     => 'required|numeric|min:0',
        ]);

        $camiseta = null;
        $equipoNombre = $request->input('equipo');
        $col = null;

        // Si viene camiseta_id, es una venta desde el inventario: validar stock
        if ($request->camiseta_id) {
            $camiseta = DB::table('camisetas')->find($request->camiseta_id);
            if (!$camiseta) {
                return response()->json(['error' => 'Camiseta no encontrada'], 404);
            }

            $col = 'talla_' . strtolower($request->talla);
            $stockActual = $camiseta->$col ?? 0;

            if ($stockActual < $request->cantidad) {
                return response()->json([
                    'error' => "Solo hay {$stockActual} UND en talla {$request->talla}"
                ], 422);
            }

            $equipoNombre = $camiseta->equipo . ' ' . $camiseta->tipo . ' ' . $camiseta->temporada;
        }
        // Si no viene camiseta_id, es una venta libre (escrita a mano): no toca stock

        DB::beginTransaction();
        try {
            if ($camiseta) {
                DB::table('camisetas')
                    ->where('id', $request->camiseta_id)
                    ->decrement($col, $request->cantidad);
            }

            // Número de venta para tienda física
            $numeroVenta = null;
            $cliente     = $request->input('cliente');
            if ($request->canal === 'Tienda física') {
                $contador    = DB::table('configuracion')->where('clave', 'contador_ventas')->first();
                $num         = $contador ? (int)$contador->valor + 1 : 1;
                $numeroVenta = '#' . str_pad($num, 3, '0', STR_PAD_LEFT);
                $cliente     = $numeroVenta;
                DB::table('configuracion')->updateOrInsert(
                    ['clave' => 'contador_ventas'],
                    ['valor' => $num, 'updated_at' => now()]
                );
            }

            // Registrar venta
            $id = DB::table('ventas')->insertGetId([
                'camiseta_id'   => $request->camiseta_id,
                'equipo'        => $equipoNombre,
                'talla'         => $request->talla,
                'cantidad'      => $request->cantidad,
                'canal'         => $request->canal,
                'cliente'       => $cliente,
                'numero_venta'  => $numeroVenta,
                'importe'       => $request->importe,
                'fecha'         => now()->toDateString(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // Registrar transacción automáticamente (para venta con o sin inventario)
            DB::table('transacciones')->insert([
                'tipo'        => 'ingreso',
                'descripcion' => "Venta {$equipoNombre} {$request->talla} x{$request->cantidad}",
                'importe'     => $request->importe,
                'canal'       => $request->canal,
                'fecha'       => now()->toDateString(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            DB::commit();

            $venta = DB::table('ventas')->find($id);
            $stockNuevo = $camiseta
                ? DB::table('camisetas')->find($request->camiseta_id)->$col
                : null;

            return response()->json([
                'venta'       => $venta,
                'stock_nuevo' => $stockNuevo,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al registrar la venta'], 500);
        }
    }

    public function resumen(Request $request)
    {
        $hoy      = now()->toDateString();
        $inicioSem = now()->startOfWeek()->toDateString();
        $inicioMes = now()->startOfMonth()->toDateString();

        $calcular = function ($desde) {
            $txs = DB::table('transacciones')->where('fecha', '>=', $desde)->get();
            $vtas = DB::table('ventas')->where('fecha', '>=', $desde)->get();
            $envs = DB::table('envios')->where('fecha', '>=', $desde)->get();

            return [
                'ingresos' => $txs->where('tipo', 'ingreso')->sum('importe'),
                'gastos'   => $txs->where('tipo', 'gasto')->sum('importe'),
                'ventas_fisicas' => $vtas->where('canal', 'Tienda física')->count(),
                'ventas_online'  => $vtas->where('canal', '!=', 'Tienda física')->count(),
                'total_ventas_fisicas' => $vtas->where('canal', 'Tienda física')->sum('importe'),
                'total_ventas_online'  => $vtas->where('canal', '!=', 'Tienda física')->sum('importe'),
                'envios' => $envs->count(),
            ];
        };

        return response()->json([
            'dia'    => $calcular($hoy),
            'semana' => $calcular($inicioSem),
            'mes'    => $calcular($inicioMes),
        ]);
    }
}

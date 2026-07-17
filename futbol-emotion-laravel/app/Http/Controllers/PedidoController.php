<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = DB::table('pedidos')->orderBy('id', 'desc')->get();

        return response()->json($pedidos->map(function ($p) {
            $p->lineas = DB::table('pedido_lineas')
                ->where('pedido_id', $p->id)
                ->get()
                ->map(fn($l) => [
                    'equipo' => $l->equipo,
                    'temp'   => $l->temporada,
                    'tallas' => [
                        'S'   => (int)$l->talla_s,
                        'M'   => (int)$l->talla_m,
                        'L'   => (int)$l->talla_l,
                        'XL'  => (int)$l->talla_xl,
                        'XXL' => (int)$l->talla_xxl,
                        '10'  => (int)$l->talla_10,
                        '12'  => (int)$l->talla_12,
                        '14'  => (int)$l->talla_14,
                        '16'  => (int)$l->talla_16,
                        'U'   => (int)($l->talla_u ?? 0),
                    ],
                ]);
            return $p;
        }));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|integer|between:1,4',
            'lineas'       => 'required|array|min:1',
            'lineas.*.equipo' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $id = DB::table('pedidos')->insertGetId([
                'proveedor_id' => $request->proveedor_id,
                'estado'       => 'pendiente',
                'notas'        => $request->input('notas', ''),
                'fecha'        => now()->toDateString(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            foreach ($request->lineas as $linea) {
                $tallas = $linea['tallas'] ?? [];
                DB::table('pedido_lineas')->insert([
                    'pedido_id'  => $id,
                    'equipo'     => $linea['equipo'],
                    'temporada'  => $linea['temp'] ?? '24/25',
                    'talla_s'    => $tallas['S']   ?? 0,
                    'talla_m'    => $tallas['M']   ?? 0,
                    'talla_l'    => $tallas['L']   ?? 0,
                    'talla_xl'   => $tallas['XL']  ?? 0,
                    'talla_xxl'  => $tallas['XXL'] ?? 0,
                    'talla_10'   => $tallas['10']  ?? 0,
                    'talla_12'   => $tallas['12']  ?? 0,
                    'talla_14'   => $tallas['14']  ?? 0,
                    'talla_16'   => $tallas['16']  ?? 0,
                    'talla_u'    => $tallas['U']   ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return response()->json(['ok' => true, 'id' => $id], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al crear el pedido'], 500);
        }
    }

    public function aprobar(Request $request, $id)
    {
        // Solo el dueño puede aprobar
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Sin permisos'], 403);
        }
        DB::table('pedidos')->where('id', $id)->update(['estado' => 'aprobado', 'updated_at' => now()]);
        return response()->json(['ok' => true]);
    }

    public function rechazar(Request $request, $id)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Sin permisos'], 403);
        }
        DB::table('pedidos')->where('id', $id)->update(['estado' => 'rechazado', 'updated_at' => now()]);
        return response()->json(['ok' => true]);
    }

    public function marcarRecibido($id)
    {
        $pedido = DB::table('pedidos')->find($id);
        if (!$pedido || $pedido->estado !== 'aprobado') {
            return response()->json(['error' => 'Pedido no válido'], 422);
        }

        $lineas = DB::table('pedido_lineas')->where('pedido_id', $id)->get();

        DB::beginTransaction();
        try {
            foreach ($lineas as $linea) {
                // Buscar la camiseta por equipo y temporada
                $camiseta = DB::table('camisetas')
                    ->where('equipo', 'like', '%' . explode(' ', $linea->equipo)[0] . '%')
                    ->where('temporada', $linea->temporada)
                    ->first();

                if ($camiseta) {
                    DB::table('camisetas')->where('id', $camiseta->id)->update([
                        'talla_s'    => $camiseta->talla_s   + $linea->talla_s,
                        'talla_m'    => $camiseta->talla_m   + $linea->talla_m,
                        'talla_l'    => $camiseta->talla_l   + $linea->talla_l,
                        'talla_xl'   => $camiseta->talla_xl  + $linea->talla_xl,
                        'talla_xxl'  => $camiseta->talla_xxl + $linea->talla_xxl,
                        'talla_10'   => $camiseta->talla_10  + $linea->talla_10,
                        'talla_12'   => $camiseta->talla_12  + $linea->talla_12,
                        'talla_14'   => $camiseta->talla_14  + $linea->talla_14,
                        'talla_16'   => $camiseta->talla_16  + $linea->talla_16,
                        'talla_u'    => $camiseta->talla_u   + $linea->talla_u,
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::table('pedidos')->where('id', $id)->update(['estado' => 'recibido', 'updated_at' => now()]);
            DB::commit();

            return response()->json(['ok' => true, 'mensaje' => 'Stock actualizado automáticamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al procesar la recepción'], 500);
        }
    }
}

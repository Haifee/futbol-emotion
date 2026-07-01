<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CamisetaController extends Controller
{
    public function index()
    {
        $camisetas = DB::table('camisetas')->orderBy('equipo')->get();

        return response()->json($camisetas->map(function ($c) {
            return $this->formatear($c);
        }));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo'       => 'required|string|max:100',
            'temporada'    => 'required|string|max:10',
            'tipo'         => 'required|in:Local,Visitante,Tercera,Portero',
            'tallas'       => 'required|array',
            'stock_minimo' => 'required|integer|min:0',
            'proveedor_id' => 'required|integer|between:1,4',
        ]);

        $tallas = $request->input('tallas', []);

        $id = DB::table('camisetas')->insertGetId([
            'equipo'        => $request->equipo,
            'temporada'     => $request->temporada,
            'tipo'          => $request->tipo,
            'talla_s'       => $tallas['S']   ?? 0,
            'talla_m'       => $tallas['M']   ?? 0,
            'talla_l'       => $tallas['L']   ?? 0,
            'talla_xl'      => $tallas['XL']  ?? 0,
            'talla_xxl'     => $tallas['XXL'] ?? 0,
            'stock_minimo'  => $request->stock_minimo,
            'proveedor_id'  => $request->proveedor_id,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return response()->json($this->formatear(DB::table('camisetas')->find($id)), 201);
    }

    public function update(Request $request, $id)
    {
        $camiseta = DB::table('camisetas')->find($id);
        if (!$camiseta) return response()->json(['error' => 'No encontrada'], 404);

        $tallas = $request->input('tallas', []);

        DB::table('camisetas')->where('id', $id)->update([
            'equipo'       => $request->input('equipo', $camiseta->equipo),
            'temporada'    => $request->input('temporada', $camiseta->temporada),
            'tipo'         => $request->input('tipo', $camiseta->tipo),
            'talla_s'      => $tallas['S']   ?? $camiseta->talla_s,
            'talla_m'      => $tallas['M']   ?? $camiseta->talla_m,
            'talla_l'      => $tallas['L']   ?? $camiseta->talla_l,
            'talla_xl'     => $tallas['XL']  ?? $camiseta->talla_xl,
            'talla_xxl'    => $tallas['XXL'] ?? $camiseta->talla_xxl,
            'stock_minimo' => $request->input('stock_minimo', $camiseta->stock_minimo),
            'proveedor_id' => $request->input('proveedor_id', $camiseta->proveedor_id),
            'updated_at'   => now(),
        ]);

        return response()->json($this->formatear(DB::table('camisetas')->find($id)));
    }

    public function destroy($id)
    {
        $eliminadas = DB::table('camisetas')->where('id', $id)->delete();
        if (!$eliminadas) return response()->json(['error' => 'No encontrada'], 404);
        return response()->json(['ok' => true]);
    }

    public function ajustarStock(Request $request, $id)
    {
        $camiseta = DB::table('camisetas')->find($id);
        if (!$camiseta) return response()->json(['error' => 'No encontrada'], 404);

        $tallas = $request->input('tallas', []);

        DB::table('camisetas')->where('id', $id)->update([
            'talla_s'    => $tallas['S']   ?? $camiseta->talla_s,
            'talla_m'    => $tallas['M']   ?? $camiseta->talla_m,
            'talla_l'    => $tallas['L']   ?? $camiseta->talla_l,
            'talla_xl'   => $tallas['XL']  ?? $camiseta->talla_xl,
            'talla_xxl'  => $tallas['XXL'] ?? $camiseta->talla_xxl,
            'updated_at' => now(),
        ]);

        return response()->json($this->formatear(DB::table('camisetas')->find($id)));
    }

    // Convierte el formato de la BD al formato que usa el frontend
    private function formatear($c)
    {
        return [
            'id'      => $c->id,
            'equipo'  => $c->equipo,
            'temp'    => $c->temporada,
            'tipo'    => $c->tipo,
            'tallas'  => [
                'S'   => (int)$c->talla_s,
                'M'   => (int)$c->talla_m,
                'L'   => (int)$c->talla_l,
                'XL'  => (int)$c->talla_xl,
                'XXL' => (int)$c->talla_xxl,
            ],
            'min'  => (int)$c->stock_minimo,
            'prov' => (int)$c->proveedor_id,
        ];
    }
}

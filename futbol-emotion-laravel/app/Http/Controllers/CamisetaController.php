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
            'tipo'         => 'required|in:Local,Visitante,Tercera,Portero,Otro',
            'categoria'    => 'nullable|string|max:50',
            'tallas'       => 'required|array',
            'stock_minimo' => 'required|integer|min:0',
            'proveedor_id' => 'required|integer|between:1,4',
            'precio'       => 'nullable|numeric|min:0',
        ]);

        $tallas = $request->input('tallas', []);

        $id = DB::table('camisetas')->insertGetId([
            'equipo'        => $request->equipo,
            'temporada'     => $request->temporada,
            'tipo'          => $request->tipo,
            'categoria'     => $request->input('categoria', 'camiseta') ?: 'camiseta',
            'talla_s'       => $tallas['S']   ?? 0,
            'talla_m'       => $tallas['M']   ?? 0,
            'talla_l'       => $tallas['L']   ?? 0,
            'talla_xl'      => $tallas['XL']  ?? 0,
            'talla_xxl'     => $tallas['XXL'] ?? 0,
            'talla_10'      => $tallas['10']  ?? 0,
            'talla_12'      => $tallas['12']  ?? 0,
            'talla_14'      => $tallas['14']  ?? 0,
            'talla_16'      => $tallas['16']  ?? 0,
            'talla_u'       => $tallas['U']   ?? 0,
            'stock_minimo'  => $request->stock_minimo,
            'proveedor_id'  => $request->proveedor_id,
            'precio'        => $request->input('precio'),
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
            'categoria'    => $request->input('categoria', $camiseta->categoria ?? 'camiseta'),
            'equipo'       => $request->input('equipo', $camiseta->equipo),
            'temporada'    => $request->input('temporada', $camiseta->temporada),
            'tipo'         => $request->input('tipo', $camiseta->tipo),
            'talla_s'      => $tallas['S']   ?? $camiseta->talla_s,
            'talla_m'      => $tallas['M']   ?? $camiseta->talla_m,
            'talla_l'      => $tallas['L']   ?? $camiseta->talla_l,
            'talla_xl'     => $tallas['XL']  ?? $camiseta->talla_xl,
            'talla_xxl'    => $tallas['XXL'] ?? $camiseta->talla_xxl,
            'talla_10'     => $tallas['10']  ?? $camiseta->talla_10,
            'talla_12'     => $tallas['12']  ?? $camiseta->talla_12,
            'talla_14'     => $tallas['14']  ?? $camiseta->talla_14,
            'talla_16'     => $tallas['16']  ?? $camiseta->talla_16,
            'talla_u'      => $tallas['U']   ?? $camiseta->talla_u,
            'stock_minimo' => $request->input('stock_minimo', $camiseta->stock_minimo),
            'proveedor_id' => $request->input('proveedor_id', $camiseta->proveedor_id),
            'precio'       => $request->input('precio', $camiseta->precio),
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
            'talla_10'   => $tallas['10']  ?? $camiseta->talla_10,
            'talla_12'   => $tallas['12']  ?? $camiseta->talla_12,
            'talla_14'   => $tallas['14']  ?? $camiseta->talla_14,
            'talla_16'   => $tallas['16']  ?? $camiseta->talla_16,
            'talla_u'    => $tallas['U']   ?? $camiseta->talla_u,
            'updated_at' => now(),
        ]);

        return response()->json($this->formatear(DB::table('camisetas')->find($id)));
    }

    // ── CÓDIGOS DE BARRAS ────────────────────────────────────────────────────

    // Buscar camiseta+talla por código escaneado.
    // Siempre responde 200: {encontrado:true, ...} o {encontrado:false}
    public function buscarPorCodigo($codigo)
    {
        $fila = DB::table('codigos_barras')
            ->where('codigo', $codigo)
            ->first();

        if (!$fila) {
            return response()->json(['encontrado' => false, 'codigo' => $codigo]);
        }

        $camiseta = DB::table('camisetas')->find($fila->camiseta_id);
        if (!$camiseta) {
            // Código huérfano (no debería pasar por el cascade, pero por si acaso)
            DB::table('codigos_barras')->where('id', $fila->id)->delete();
            return response()->json(['encontrado' => false, 'codigo' => $codigo]);
        }

        return response()->json([
            'encontrado' => true,
            'codigo'     => $codigo,
            'talla'      => $fila->talla,
            'camiseta'   => $this->formatear($camiseta),
        ]);
    }

    // Asociar un código de barras a una camiseta + talla
    public function asociarCodigo(Request $request)
    {
        $request->validate([
            'codigo'      => 'required|string|max:64',
            'camiseta_id' => 'required|integer|exists:camisetas,id',
            'talla'       => 'required|in:S,M,L,XL,XXL,10,12,14,16,U',
        ]);

        $existente = DB::table('codigos_barras')->where('codigo', $request->codigo)->first();
        if ($existente) {
            return response()->json(['error' => 'Ese código ya está asociado a otra camiseta'], 422);
        }

        DB::table('codigos_barras')->insert([
            'codigo'      => $request->codigo,
            'camiseta_id' => $request->camiseta_id,
            'talla'       => $request->talla,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return response()->json(['ok' => true], 201);
    }

    // Convierte el formato de la BD al formato que usa el frontend
    private function formatear($c)
    {
        return [
            'id'      => $c->id,
            'equipo'  => $c->equipo,
            'temp'    => $c->temporada,
            'tipo'    => $c->tipo,
            'categoria' => $c->categoria ?? 'camiseta',
            'tallas'  => [
                'S'   => (int)$c->talla_s,
                'M'   => (int)$c->talla_m,
                'L'   => (int)$c->talla_l,
                'XL'  => (int)$c->talla_xl,
                'XXL' => (int)$c->talla_xxl,
                '10'  => (int)$c->talla_10,
                '12'  => (int)$c->talla_12,
                '14'  => (int)$c->talla_14,
                '16'  => (int)$c->talla_16,
                'U'   => (int)($c->talla_u ?? 0),
            ],
            'min'    => (int)$c->stock_minimo,
            'prov'   => (int)$c->proveedor_id,
            'precio' => isset($c->precio) && $c->precio !== null ? (float)$c->precio : null,
        ];
    }
}

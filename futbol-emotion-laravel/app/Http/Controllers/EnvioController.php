<?php
// ── ENVÍOS ────────────────────────────────────────────────────────────────────
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnvioController extends Controller
{
    public function index()
    {
        return response()->json(
            DB::table('envios')->orderBy('fecha', 'desc')->orderBy('id', 'desc')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente'      => 'required|string',
            'productos'    => 'required|string',
            'origen'       => 'required|string',
            'transportista'=> 'required|string',
            'importe'      => 'required|numeric|min:0',
        ]);

        $id = DB::table('envios')->insertGetId([
            'cliente'      => $request->cliente,
            'productos'    => $request->productos,
            'origen'       => $request->origen,
            'transportista'=> $request->transportista,
            'direccion'    => $request->input('direccion', ''),
            'importe'      => $request->importe,
            'estado'       => $request->input('estado', 'preparando'),
            'notas'        => $request->input('notas', ''),
            'fecha'        => now()->toDateString(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return response()->json(DB::table('envios')->find($id), 201);
    }

    public function update(Request $request, $id)
    {
        $envio = DB::table('envios')->find($id);
        if (!$envio) return response()->json(['error' => 'No encontrado'], 404);

        DB::table('envios')->where('id', $id)->update(array_merge(
            (array) $envio,
            $request->only(['cliente','productos','origen','transportista','direccion','importe','estado','notas']),
            ['updated_at' => now()]
        ));

        return response()->json(DB::table('envios')->find($id));
    }

    public function avanzarEstado($id)
    {
        $envio = DB::table('envios')->find($id);
        if (!$envio) return response()->json(['error' => 'No encontrado'], 404);

        $siguiente = ['preparando' => 'ruta', 'ruta' => 'entregado'];
        $nuevoEstado = $siguiente[$envio->estado] ?? $envio->estado;

        DB::table('envios')->where('id', $id)->update(['estado' => $nuevoEstado, 'updated_at' => now()]);

        return response()->json(['ok' => true, 'estado' => $nuevoEstado]);
    }
}

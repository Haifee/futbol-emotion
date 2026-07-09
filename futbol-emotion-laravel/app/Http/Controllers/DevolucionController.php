<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'camiseta_solicitada' => $request->camiseta_solicitada,
            'importe'             => $request->input('importe', 0),
            'estado'              => 'pendiente',
            'fecha'               => now()->toDateString(),
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

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

        DB::table('devoluciones')->where('id', $id)->update([
            'estado'     => 'cambiado',
            'updated_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
{
    // Devuelve el historial completo + qué eventos ya vio el rol actual
    public function index(Request $request)
    {
        $rol = $request->input('rol', session('rol'));

        $actividad = DB::table('actividad')
            ->orderByDesc('id')
            ->limit(200)
            ->get()
            ->map(function ($a) {
                $fecha = \Carbon\Carbon::parse($a->created_at);
                return [
                    'id'     => $a->id,
                    'tipo'   => $a->tipo,
                    'desc'   => $a->descripcion,
                    'extra'  => $a->extra,
                    'rol'    => $a->rol,
                    'quien'  => $a->rol === 'manager' ? 'Encargado' : 'Dueño',
                    'fecha'  => $fecha->toDateString(),
                    'hora'   => $fecha->format('H:i'),
                ];
            });

        $vistas = [];
        if ($rol) {
            $vistas = DB::table('notificaciones_vistas')
                ->where('rol', $rol)
                ->pluck('actividad_id')
                ->toArray();
        }

        return response()->json([
            'actividad' => $actividad,
            'vistas'    => $vistas,
        ]);
    }

    // Registra un nuevo evento de actividad
    public function store(Request $request)
    {
        $request->validate([
            'tipo'        => 'required|string|max:50',
            'descripcion' => 'required|string',
            'rol'         => 'required|in:manager,owner',
        ]);

        $id = DB::table('actividad')->insertGetId([
            'tipo'        => $request->tipo,
            'descripcion' => $request->descripcion,
            'extra'       => $request->input('extra', ''),
            'rol'         => $request->rol,
            'created_at'  => now(),
        ]);

        return response()->json(['ok' => true, 'id' => $id], 201);
    }

    // Eliminar una entrada del historial (solo dueño)
    public function destroy(Request $request, $id)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede eliminar del historial'], 403);
        }

        $fila = DB::table('actividad')->find($id);
        if (!$fila) return response()->json(['error' => 'No encontrada'], 404);

        DB::table('notificaciones_vistas')->where('actividad_id', $id)->delete();
        DB::table('actividad')->where('id', $id)->delete();

        return response()->json(['ok' => true]);
    }

    // Vaciar todo el historial (solo dueño)
    public function limpiar(Request $request)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede limpiar el historial'], 403);
        }

        DB::table('notificaciones_vistas')->delete();
        DB::table('actividad')->delete();

        return response()->json(['ok' => true]);
    }

    // Marca como vistos todos los eventos del otro rol
    public function marcarVistas(Request $request)
    {
        $rol = $request->input('rol');
        if (!in_array($rol, ['manager', 'owner'])) {
            return response()->json(['error' => 'Rol inválido'], 422);
        }

        $idsNoVistos = DB::table('actividad')
            ->where('rol', '!=', $rol)
            ->pluck('id');

        $yaVistos = DB::table('notificaciones_vistas')
            ->where('rol', $rol)
            ->pluck('actividad_id')
            ->toArray();

        $nuevos = array_diff($idsNoVistos->toArray(), $yaVistos);

        $filas = array_map(fn($id) => [
            'rol'          => $rol,
            'actividad_id' => $id,
            'created_at'   => now(),
            'updated_at'   => now(),
        ], $nuevos);

        if ($filas) {
            DB::table('notificaciones_vistas')->insert($filas);
        }

        return response()->json(['ok' => true]);
    }
}

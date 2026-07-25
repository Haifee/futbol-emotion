<?php

namespace App\Http\Controllers;

use App\Services\PushService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CierreController extends Controller
{
    /** Lista de cierres (para el historial) */
    public function index()
    {
        $cierres = DB::table('cierres_caja')
            ->orderBy('fecha', 'desc')
            ->orderBy('id', 'desc')
            ->limit(90)
            ->get();

        return response()->json($cierres);
    }

    /** Guarda un cierre de caja tras validar la clave de cierre */
    public function store(Request $request)
    {
        $request->validate([
            'clave'         => 'required|string',
            'ingresos'      => 'required|numeric',
            'gastos'        => 'required|numeric',
            'num_ventas'    => 'required|integer',
            'total_divisas' => 'nullable|numeric',
            'total_bs'      => 'nullable|numeric',
        ]);

        // Verificar la clave de cierre (guardada en configuracion)
        $fila = DB::table('configuracion')->where('clave', 'clave_cierre')->first();
        $claveGuardada = $fila->valor ?? '';

        if ($claveGuardada === '') {
            return response()->json(['error' => 'No hay clave de cierre configurada. El dueño debe crearla en Ajustes.'], 422);
        }

        if (!hash_equals($claveGuardada, (string) $request->input('clave'))) {
            return response()->json(['error' => 'Clave de cierre incorrecta.'], 401);
        }

        $ingresos = (float) $request->ingresos;
        $gastos   = (float) $request->gastos;
        $rol      = $request->input('_rol') === 'owner' ? 'owner' : 'manager';

        $id = DB::table('cierres_caja')->insertGetId([
            'fecha'         => now()->toDateString(),
            'cerrado_por'   => $rol,
            'ingresos'      => $ingresos,
            'gastos'        => $gastos,
            'beneficio'     => $ingresos - $gastos,
            'num_ventas'    => (int) $request->num_ventas,
            'total_divisas' => (float) $request->input('total_divisas', 0),
            'total_bs'      => (float) $request->input('total_bs', 0),
            'nota'          => $request->input('nota'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Avisar al otro rol que se hizo el cierre
        PushService::enviarARol(
            $rol === 'owner' ? 'manager' : 'owner',
            'Cierre de caja 🧾',
            'Se cerró la caja del ' . now()->toDateString() . ' · Beneficio $' . number_format($ingresos - $gastos, 2)
        );

        return response()->json(['ok' => true, 'id' => $id]);
    }
}

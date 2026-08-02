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
        $fechaCierre = $request->input('fecha') ?: now()->toDateString();

        // Evitar cerrar dos veces el mismo día
        $yaExiste = DB::table('cierres_caja')->where('fecha', $fechaCierre)->exists();
        if ($yaExiste) {
            return response()->json(['error' => 'Ese día ya tiene un cierre registrado.'], 409);
        }

        $id = DB::table('cierres_caja')->insertGetId([
            'fecha'         => $fechaCierre,
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

    /**
     * Estado para la app: ¿hay caja de días anteriores sin cerrar?
     * Y genera el cierre mensual del mes anterior si aún no existe.
     */
    public function estado(Request $request)
    {
        $hoy = now()->toDateString();

        // ── Cierre mensual automático ──
        $this->generarCierreMensualSiTocaLugar();

        // ── ¿Hay días con ventas anteriores a hoy que no tienen cierre? ──
        $ultimoCierre = DB::table('cierres_caja')->max('fecha');

        // Buscar el día con ventas más antiguo que esté sin cerrar (antes de hoy)
        $q = DB::table('ventas')->where('fecha', '<', $hoy);
        if ($ultimoCierre) {
            $q->where('fecha', '>', $ultimoCierre);
        }
        $diaPendiente = $q->min('fecha');

        return response()->json([
            'caja_pendiente'  => $diaPendiente,   // fecha (YYYY-MM-DD) o null
            'ultimo_cierre'   => $ultimoCierre,
        ]);
    }

    /** Resumen de un día concreto (para cerrar días atrasados) */
    public function resumenDia(Request $request, $fecha)
    {
        $ventas = DB::table('ventas')->where('fecha', $fecha)->get();
        $txs = DB::table('transacciones')->where('fecha', $fecha)->get();

        $ingresos = $txs->where('tipo', 'ingreso')->sum('importe');
        $gastos = $txs->where('tipo', 'gasto')->sum('importe');

        $divisas = 0; $bs = 0;
        try {
            $pagos = DB::table('pagos')->where('fecha', $fecha)->get();
            foreach ($pagos as $p) {
                if ($p->moneda === 'VES') $bs += (float) $p->monto;
                else $divisas += (float) $p->monto_usd;
            }
        } catch (\Throwable $e) {}

        return response()->json([
            'fecha'         => $fecha,
            'ingresos'      => (float) $ingresos,
            'gastos'        => (float) $gastos,
            'num_ventas'    => $ventas->count(),
            'total_divisas' => $divisas,
            'total_bs'      => $bs,
        ]);
    }

    /** Lista de cierres mensuales */
    public function mensuales()
    {
        try {
            return response()->json(DB::table('cierres_mensuales')->orderBy('mes', 'desc')->limit(36)->get());
        } catch (\Throwable $e) {
            return response()->json([]);
        }
    }

    /** Genera el cierre del mes anterior si el mes cambió y aún no existe */
    private function generarCierreMensualSiTocaLugar(): void
    {
        try {
            $mesActual = now()->format('Y-m');
            $mesAnterior = now()->subMonth()->format('Y-m');

            // ¿Ya existe el cierre del mes anterior?
            $existe = DB::table('cierres_mensuales')->where('mes', $mesAnterior)->exists();
            if ($existe) return;

            // ¿Hay datos del mes anterior?
            $inicio = now()->subMonth()->startOfMonth()->toDateString();
            $fin = now()->subMonth()->endOfMonth()->toDateString();

            $ventas = DB::table('ventas')->whereBetween('fecha', [$inicio, $fin])->get();
            if ($ventas->isEmpty()) return; // no generar meses vacíos

            $txs = DB::table('transacciones')->whereBetween('fecha', [$inicio, $fin])->get();
            $ingresos = $txs->where('tipo', 'ingreso')->sum('importe');
            $gastos = $txs->where('tipo', 'gasto')->sum('importe');

            $divisas = 0; $bs = 0;
            try {
                $pagos = DB::table('pagos')->whereBetween('fecha', [$inicio, $fin])->get();
                foreach ($pagos as $p) {
                    if ($p->moneda === 'VES') $bs += (float) $p->monto;
                    else $divisas += (float) $p->monto_usd;
                }
            } catch (\Throwable $e) {}

            DB::table('cierres_mensuales')->insert([
                'mes'           => $mesAnterior,
                'ingresos'      => $ingresos,
                'gastos'        => $gastos,
                'beneficio'     => $ingresos - $gastos,
                'num_ventas'    => $ventas->count(),
                'total_divisas' => $divisas,
                'total_bs'      => $bs,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        } catch (\Throwable $e) {
            // nunca romper la app por esto
        }
    }

    /** Anula un cierre de caja (solo dueño, con la clave de cierre) */
    public function destroy(Request $request, $id)
    {
        if ($request->input('_rol') !== 'owner') {
            return response()->json(['error' => 'Solo el dueño puede anular un cierre'], 403);
        }

        $fila = DB::table('configuracion')->where('clave', 'clave_cierre')->first();
        $claveGuardada = $fila->valor ?? '';
        if ($claveGuardada === '' || !hash_equals($claveGuardada, (string) $request->input('clave'))) {
            return response()->json(['error' => 'Clave de cierre incorrecta.'], 401);
        }

        $cierre = DB::table('cierres_caja')->find($id);
        if (!$cierre) return response()->json(['error' => 'Cierre no encontrado'], 404);

        DB::table('cierres_caja')->where('id', $id)->delete();

        return response()->json(['ok' => true]);
    }
}
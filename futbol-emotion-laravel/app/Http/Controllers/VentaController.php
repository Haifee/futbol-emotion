<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PushService;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        // Rendimiento: por defecto la app pide solo lo reciente (?desde=YYYY-MM-DD).
        // Con ?desde=all se devuelve TODO el historico (reportes de meses viejos).
        $desde = $request->query('desde');
        $q = DB::table('ventas');
        if ($desde && $desde !== 'all') {
            $q->where('fecha', '>=', $desde);
        }
        $ventas = $q
            ->orderBy('fecha', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // Adjuntar cómo se pagó cada venta
        try {
            $pagos = DB::table('pagos')->whereNotNull('venta_id')->get()->groupBy('venta_id');
            $ventas = $ventas->map(function ($v) use ($pagos) {
                $v->pagos = isset($pagos[$v->id]) ? $pagos[$v->id]->values() : [];
                return $v;
            });
        } catch (\Throwable $e) {
            // Si la tabla aún no existe (migración pendiente), la app sigue funcionando
        }

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
            'pago'        => 'nullable|array',
            'pago.metodo' => 'nullable|string|max:30',
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

            // Talla válida: evita construir una columna inexistente (y cierra un hueco de validación)
            $tallasValidas = ['S', 'M', 'L', 'XL', 'XXL', '10', '12', '14', '16', 'U'];
            $tallaNorm = strtoupper($request->talla);
            if (!in_array($tallaNorm, $tallasValidas)) {
                return response()->json(['error' => 'Talla inválida'], 422);
            }
            $col = 'talla_' . strtolower($tallaNorm);
            $stockActual = $camiseta->$col ?? 0;

            // Pre-chequeo amable para el caso común; el descuento atómico de abajo es la garantía real
            if ($stockActual < $request->cantidad) {
                return response()->json([
                    'error' => "Solo hay {$stockActual} UND en talla {$tallaNorm}"
                ], 422);
            }

            $equipoNombre = $camiseta->equipo . ' ' . $camiseta->tipo . ' ' . $camiseta->temporada;
        }
        // Si no viene camiseta_id, es una venta libre (escrita a mano): no toca stock

        DB::beginTransaction();
        try {
            if ($camiseta) {
                // Descuento atómico y condicional: solo resta si AÚN queda suficiente.
                // Si dos ventas compiten por la última unidad, la BD sólo deja pasar una.
                $afectadas = DB::table('camisetas')
                    ->where('id', $request->camiseta_id)
                    ->where($col, '>=', $request->cantidad)
                    ->decrement($col, $request->cantidad);
                if ($afectadas === 0) {
                    DB::rollBack();
                    return response()->json([
                        'error' => "Stock insuficiente en talla {$tallaNorm} — otra venta se adelantó"
                    ], 409);
                }
            }

            // Número de venta para tienda física
            $numeroVenta = null;
            $cliente     = $request->input('cliente');
            if ($request->canal === 'Tienda física') {
                $contador    = DB::table('configuracion')->where('clave', 'contador_ventas')->lockForUpdate()->first();
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
                'venta_id'    => $id,
                'tipo'        => 'ingreso',
                'descripcion' => "Venta {$equipoNombre} {$request->talla} x{$request->cantidad}",
                'importe'     => $request->importe,
                'canal'       => $request->canal,
                'fecha'       => now()->toDateString(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // Cómo pagó el cliente (opcional)
            $this->guardarPago($request->input('pago'), $id, (float) $request->importe);

            DB::commit();

            $venta = DB::table('ventas')->find($id);
            $stockNuevo = $camiseta
                ? DB::table('camisetas')->find($request->camiseta_id)->$col
                : null;

            // ── Notificaciones push ──
            $actor = $request->input('_rol') === 'owner' ? 'owner' : 'manager';
            $nombreProd = $request->input('equipo', 'Producto');
            $tallaTxt = ($request->talla && $request->talla !== '—') ? (' talla ' . $request->talla) : '';
            PushService::evento('venta', $actor, 'Nueva venta 💰',
                "{$nombreProd}{$tallaTxt} · \${$request->importe}");

            // Aviso de stock crítico
            if ($camiseta && $stockNuevo !== null && $stockNuevo <= 2) {
                $cam = DB::table('camisetas')->find($request->camiseta_id);
                $nombre = $cam->equipo . ' ' . $cam->tipo;
                PushService::evento('stock_critico', 'nadie', 'Stock crítico ⚠️',
                    "{$nombre} talla {$request->talla}: quedan {$stockNuevo} UND");
            }

            return response()->json([
                'venta'       => $venta,
                'stock_nuevo' => $stockNuevo,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al registrar la venta'], 500);
        }
    }

    // Editar una venta existente (corrige también stock y transacción vinculada)
    // Venta multi-producto (carrito) con pago dividido, TODO en una sola transacción.
    // Si cualquier línea falla (p.ej. stock insuficiente), se revierte la venta completa.
    public function storeCarrito(Request $request)
    {
        $request->validate([
            'lineas'            => 'required|array|min:1',
            'lineas.*.cantidad' => 'required|integer|min:1',
            'lineas.*.importe'  => 'required|numeric|min:0',
            'canal'             => 'required|string|max:40',
        ]);

        $lineas = $request->input('lineas');
        $canal  = $request->input('canal');
        $pagos  = $request->input('pagos', []);
        $tallasValidas = ['S', 'M', 'L', 'XL', 'XXL', '10', '12', '14', '16', 'U'];

        DB::beginTransaction();
        try {
            // Un solo número de venta para toda la compra (si es tienda física)
            $numeroVenta = null;
            $clienteBase = $request->input('cliente');
            if ($canal === 'Tienda física') {
                $contador    = DB::table('configuracion')->where('clave', 'contador_ventas')->lockForUpdate()->first();
                $num         = $contador ? (int) $contador->valor + 1 : 1;
                $numeroVenta = '#' . str_pad($num, 3, '0', STR_PAD_LEFT);
                $clienteBase = $numeroVenta;
                DB::table('configuracion')->updateOrInsert(
                    ['clave' => 'contador_ventas'],
                    ['valor' => $num, 'updated_at' => now()]
                );
            }

            $idsVentas = [];
            $total     = 0;
            $descItems = [];

            foreach ($lineas as $ln) {
                $camId   = $ln['camiseta_id'] ?? null;
                $talla   = $ln['talla'] ?? '';
                $cant    = (int) ($ln['cantidad'] ?? 1);
                $importe = (float) ($ln['importe'] ?? 0);
                $equipoNombre = $ln['equipo'] ?? 'Producto';

                if ($camId) {
                    $camiseta = DB::table('camisetas')->find($camId);
                    if (!$camiseta) {
                        DB::rollBack();
                        return response()->json(['error' => "Un producto del carrito ya no existe"], 404);
                    }
                    $tallaNorm = strtoupper($talla);
                    if (!in_array($tallaNorm, $tallasValidas)) {
                        DB::rollBack();
                        return response()->json(['error' => 'Talla inválida'], 422);
                    }
                    $col = 'talla_' . strtolower($tallaNorm);
                    // Descuento atómico y condicional (a prueba de carreras)
                    $afectadas = DB::table('camisetas')
                        ->where('id', $camId)
                        ->where($col, '>=', $cant)
                        ->decrement($col, $cant);
                    if ($afectadas === 0) {
                        DB::rollBack();
                        return response()->json([
                            'error' => "Stock insuficiente en {$camiseta->equipo} talla {$tallaNorm}"
                        ], 409);
                    }
                    $equipoNombre = $camiseta->equipo . ' ' . $camiseta->tipo . ' ' . $camiseta->temporada;
                }

                $id = DB::table('ventas')->insertGetId([
                    'camiseta_id'  => $camId,
                    'equipo'       => $equipoNombre,
                    'talla'        => $talla,
                    'cantidad'     => $cant,
                    'canal'        => $canal,
                    'cliente'      => $clienteBase,
                    'numero_venta' => $numeroVenta,
                    'importe'      => $importe,
                    'fecha'        => now()->toDateString(),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
                $idsVentas[] = $id;
                $total      += $importe;
                $descItems[] = ($ln['equipo'] ?? $equipoNombre) . ($talla ? " {$talla}" : '') . " x{$cant}";
            }

            $ventaPrincipal = $idsVentas[0];

            // Una sola transacción de ingreso por el TOTAL de la compra
            $descTx = count($lineas) > 1
                ? ('Venta de ' . count($lineas) . ' productos: ' . implode(', ', array_slice($descItems, 0, 3)) . (count($descItems) > 3 ? '…' : ''))
                : ('Venta ' . $descItems[0]);
            DB::table('transacciones')->insert([
                'venta_id'    => $ventaPrincipal,
                'tipo'        => 'ingreso',
                'descripcion' => mb_substr($descTx, 0, 190),
                'importe'     => $total,
                'canal'       => $canal,
                'fecha'       => now()->toDateString(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // Pagos mixtos (uno o varios métodos), atados a la venta principal del grupo
            if (is_array($pagos)) {
                foreach ($pagos as $pg) {
                    if (is_array($pg) && !empty($pg['metodo'])) {
                        $this->guardarPago($pg, $ventaPrincipal, (float) ($pg['monto'] ?? 0));
                    }
                }
            }

            DB::commit();

            $ventas = DB::table('ventas')->whereIn('id', $idsVentas)->orderBy('id')->get();
            return response()->json([
                'ventas'       => $ventas,
                'numero_venta' => $numeroVenta,
                'total'        => $total,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'No se pudo registrar la venta: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $venta = DB::table('ventas')->find($id);
        if (!$venta) return response()->json(['error' => 'Venta no encontrada'], 404);

        $request->validate([
            'equipo'   => 'nullable|string',
            'talla'    => 'nullable|string|max:5',
            'cantidad' => 'nullable|integer|min:1',
            'importe'  => 'nullable|numeric|min:0',
            'canal'    => 'nullable|string',
            'cliente'  => 'nullable|string',
        ]);

        $nuevaTalla    = $request->input('talla', $venta->talla);
        $nuevaCantidad = (int) $request->input('cantidad', $venta->cantidad);
        $nuevoImporte  = $request->input('importe', $venta->importe);
        $nuevoCanal    = $request->input('canal', $venta->canal);
        $nuevoCliente  = $request->input('cliente', $venta->cliente);
        $nuevoEquipo   = $request->input('equipo', $venta->equipo);

        DB::beginTransaction();
        try {
            $stockNuevo = null;

            // Si la venta descontó stock, corregir el inventario
            if ($venta->camiseta_id) {
                $camiseta = DB::table('camisetas')->find($venta->camiseta_id);
                if ($camiseta) {
                    $tallasValidas = ['S', 'M', 'L', 'XL', 'XXL', '10', '12', '14', '16', 'U'];
                    if (!in_array(strtoupper($nuevaTalla), $tallasValidas)) {
                        DB::rollBack();
                        return response()->json(['error' => 'Talla inválida'], 422);
                    }
                    $nuevaTalla = strtoupper($nuevaTalla);
                    $colVieja = 'talla_' . strtolower($venta->talla);
                    $colNueva = 'talla_' . strtolower($nuevaTalla);

                    // 1) Devolver lo que la venta original había descontado
                    DB::table('camisetas')->where('id', $venta->camiseta_id)
                        ->increment($colVieja, $venta->cantidad);

                    // 2) Verificar que alcanza para la nueva talla/cantidad
                    $fresca = DB::table('camisetas')->find($venta->camiseta_id);
                    if (($fresca->$colNueva ?? 0) < $nuevaCantidad) {
                        DB::rollBack();
                        return response()->json([
                            'error' => "Solo hay {$fresca->$colNueva} UND en talla {$nuevaTalla}"
                        ], 422);
                    }

                    // 3) Descontar según la venta corregida
                    DB::table('camisetas')->where('id', $venta->camiseta_id)
                        ->decrement($colNueva, $nuevaCantidad);

                    $stockNuevo = DB::table('camisetas')->find($venta->camiseta_id)->$colNueva;

                    // El nombre para display sigue derivado de la camiseta del stock
                    $nuevoEquipo = $camiseta->equipo . ' ' . $camiseta->tipo . ' ' . $camiseta->temporada;
                }
            }

            DB::table('ventas')->where('id', $id)->update([
                'equipo'     => $nuevoEquipo,
                'talla'      => $nuevaTalla,
                'cantidad'   => $nuevaCantidad,
                'importe'    => $nuevoImporte,
                'canal'      => $nuevoCanal,
                'cliente'    => $nuevoCliente,
                'updated_at' => now(),
            ]);

            // Corregir la transacción de ingreso vinculada
            DB::table('transacciones')->where('venta_id', $id)->update([
                'descripcion' => "Venta {$nuevoEquipo} {$nuevaTalla} x{$nuevaCantidad}",
                'importe'     => $nuevoImporte,
                'canal'       => $nuevoCanal,
                'updated_at'  => now(),
            ]);

            DB::commit();

            return response()->json([
                'venta'       => DB::table('ventas')->find($id),
                'stock_nuevo' => $stockNuevo,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar la venta'], 500);
        }
    }

    // Eliminar una venta (devuelve el stock y borra la transacción vinculada)
    /**
     * Registra cómo se pagó la venta (efectivo, pago móvil, Zelle, Binance…).
     */
    private function guardarPago($pago, int $ventaId, float $importeUsd): void
    {
        $metodosValidos = [
            'efectivo_usd', 'efectivo_bs', 'pago_movil', 'punto_venta',
            'transferencia', 'zelle', 'binance', 'zinli', 'cashea',
        ];

        if (!is_array($pago) || empty($pago['metodo']) || !in_array($pago['metodo'], $metodosValidos, true)) {
            return;
        }

        $enBolivares = in_array($pago['metodo'], ['efectivo_bs', 'pago_movil', 'punto_venta', 'transferencia'], true);
        $moneda = $enBolivares ? 'VES' : 'USD';
        $tasa   = isset($pago['tasa']) ? (float) $pago['tasa'] : null;
        $monto  = isset($pago['monto']) ? (float) $pago['monto'] : null;

        if ($enBolivares) {
            if (!$monto && $tasa > 0) $monto = round($importeUsd * $tasa, 2);
            $montoUsd = ($tasa > 0 && $monto) ? round($monto / $tasa, 2) : $importeUsd;
        } else {
            $monto    = $monto ?: $importeUsd;
            $montoUsd = $monto;
            $tasa     = null;
        }

        $corta = function ($k, $len = 60) use ($pago) {
            return isset($pago[$k]) && $pago[$k] !== ''
                ? mb_substr(trim((string) $pago[$k]), 0, $len)
                : null;
        };

        DB::table('pagos')->insert([
            'venta_id'       => $ventaId,
            'metodo'         => $pago['metodo'],
            'monto'          => $monto ?: 0,
            'moneda'         => $moneda,
            'tasa'           => $tasa,
            'monto_usd'      => $montoUsd,
            'referencia'     => $corta('referencia'),
            'ref_emisor'     => $corta('ref_emisor', 20),
            'ref_receptor'   => $corta('ref_receptor', 20),
            'banco_emisor'   => $corta('banco_emisor'),
            'banco_receptor' => $corta('banco_receptor'),
            'correo'         => $corta('correo', 120),
            'titular'        => $corta('titular', 120),
            'telefono'       => $corta('telefono', 30),
            'confirmacion'   => $corta('confirmacion'),
            'id_orden'       => $corta('id_orden'),
            'nota'           => $corta('nota', 200),
            'fecha'          => now()->toDateString(),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public function destroy($id)
    {
        $venta = DB::table('ventas')->find($id);
        if (!$venta) return response()->json(['error' => 'Venta no encontrada'], 404);

        DB::beginTransaction();
        try {
            // Devolver las unidades al inventario si la venta descontó stock
            if ($venta->camiseta_id) {
                $col = 'talla_' . strtolower($venta->talla);
                if (in_array($col, ['talla_s', 'talla_m', 'talla_l', 'talla_xl', 'talla_xxl', 'talla_10', 'talla_12', 'talla_14', 'talla_16', 'talla_u'])) {
                    DB::table('camisetas')->where('id', $venta->camiseta_id)
                        ->increment($col, $venta->cantidad);
                }
            }

            // Borrar la transacción de ingreso vinculada (si existe)
            DB::table('transacciones')->where('venta_id', $id)->delete();

            // Borrar la venta
            DB::table('ventas')->where('id', $id)->delete();

            DB::commit();
            return response()->json(['ok' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar la venta'], 500);
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

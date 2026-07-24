<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CamisetaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\MigracionController;
use App\Http\Controllers\ActividadController;

// ── AUTH ─────────────────────────────────────────────────────────────────────
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'me']);

// ── RUTAS PROTEGIDAS (requieren sesión) ───────────────────────────────────────
Route::middleware('auth.pin')->group(function () {

    // Camisetas / Inventario
    Route::get('/camisetas/barcode/{codigo}', [CamisetaController::class, 'buscarPorCodigo']);
    Route::post('/camisetas/barcode', [CamisetaController::class, 'asociarCodigo']);
    Route::get('/camisetas',          [CamisetaController::class, 'index']);
    Route::post('/camisetas',         [CamisetaController::class, 'store']);
    Route::put('/camisetas/{id}',     [CamisetaController::class, 'update']);
    Route::delete('/camisetas/{id}',  [CamisetaController::class, 'destroy']);
    Route::put('/camisetas/{id}/stock', [CamisetaController::class, 'ajustarStock']);

    // Ventas
    Route::get('/ventas',             [VentaController::class, 'index']);
    Route::post('/ventas',            [VentaController::class, 'store']);
    Route::get('/ventas/resumen',     [VentaController::class, 'resumen']);
    Route::put('/ventas/{id}',        [VentaController::class, 'update']);
    Route::delete('/ventas/{id}',     [VentaController::class, 'destroy']);

    // Pedidos a proveedores
    Route::get('/pedidos',            [PedidoController::class, 'index']);
    Route::post('/pedidos',           [PedidoController::class, 'store']);
    Route::put('/pedidos/{id}/aprobar',  [PedidoController::class, 'aprobar']);
    Route::put('/pedidos/{id}/rechazar', [PedidoController::class, 'rechazar']);
    Route::put('/pedidos/{id}/recibido', [PedidoController::class, 'marcarRecibido']);

    // Envíos
    Route::get('/envios',             [EnvioController::class, 'index']);
    Route::post('/envios',            [EnvioController::class, 'store']);
    Route::put('/envios/{id}',        [EnvioController::class, 'update']);
    Route::put('/envios/{id}/estado', [EnvioController::class, 'avanzarEstado']);

    // Devoluciones
    Route::get('/devoluciones',       [DevolucionController::class, 'index']);
    Route::post('/devoluciones',      [DevolucionController::class, 'store']);
    Route::put('/devoluciones/{id}/aprobar',   [DevolucionController::class, 'aprobar']);
    Route::put('/devoluciones/{id}/rechazar',  [DevolucionController::class, 'rechazar']);
    Route::put('/devoluciones/{id}/completar', [DevolucionController::class, 'completar']);

    // Transacciones / Finanzas
    Route::get('/transacciones',      [TransaccionController::class, 'index']);
    Route::post('/transacciones',     [TransaccionController::class, 'store']);
    Route::get('/transacciones/cierre', [TransaccionController::class, 'cierre']);
    Route::delete('/transacciones/{id}', [TransaccionController::class, 'destroy']);

    Route::get('/config',  [ConfigController::class, 'index']);
    Route::post('/config', [ConfigController::class, 'update']);

    // Actividad / Notificaciones (historial compartido entre encargado y dueño)
    Route::get('/actividad',          [ActividadController::class, 'index']);
    Route::post('/actividad',         [ActividadController::class, 'store']);
    Route::post('/actividad/vistas',  [ActividadController::class, 'marcarVistas']);
    Route::delete('/actividad/{id}',  [ActividadController::class, 'destroy']);
    Route::delete('/actividad',       [ActividadController::class, 'limpiar']);

    // Migración de datos
    Route::post('/migrar',            [MigracionController::class, 'importar']);

    // Borrado de datos (reinicio, solo dueño)
    Route::post('/datos/borrar',      [\App\Http\Controllers\DatosController::class, 'borrar']);

});

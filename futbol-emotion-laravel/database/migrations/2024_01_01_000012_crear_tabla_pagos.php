<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Registro de cómo se pagó cada venta.
     * Una venta puede tener uno o varios pagos (pago mixto).
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id')->nullable();

            // efectivo_usd | efectivo_bs | pago_movil | punto_venta | transferencia
            // zelle | binance | zinli | cashea
            $table->string('metodo', 30);

            $table->decimal('monto', 14, 2);                 // monto en la moneda pagada
            $table->string('moneda', 3)->default('USD');     // USD o VES
            $table->decimal('tasa', 14, 4)->nullable();      // tasa usada si se pagó en Bs
            $table->decimal('monto_usd', 14, 2);             // equivalente en $ (contabilidad)

            $table->string('referencia', 60)->nullable();      // pago móvil, transferencia, Zinli
            $table->string('ref_emisor', 20)->nullable();      // punto de venta: últimos dígitos banco emisor
            $table->string('ref_receptor', 20)->nullable();    // punto de venta: últimos dígitos banco receptor
            $table->string('banco_emisor', 60)->nullable();
            $table->string('banco_receptor', 60)->nullable();
            $table->string('correo', 120)->nullable();         // Zelle, Binance, Zinli
            $table->string('titular', 120)->nullable();        // nombre de quien envía
            $table->string('telefono', 30)->nullable();        // pago móvil
            $table->string('confirmacion', 60)->nullable();    // Zelle: número de confirmación
            $table->string('id_orden', 60)->nullable();        // Binance: ID de la orden
            $table->string('nota', 200)->nullable();

            $table->date('fecha');
            $table->timestamps();

            $table->index('venta_id');
            $table->index('fecha');
            $table->foreign('venta_id')->references('id')->on('ventas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};

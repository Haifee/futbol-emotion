<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ENVÍOS
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('productos');
            $table->string('origen', 30);       // Instagram, WhatsApp, Tienda física, Web
            $table->string('transportista', 30); // MRW, Zoom, Recoger en tienda
            $table->string('direccion')->nullable();
            $table->decimal('importe', 10, 2)->default(0);
            $table->enum('estado', ['preparando', 'ruta', 'entregado'])->default('preparando');
            $table->text('notas')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });

        // DEVOLUCIONES
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('motivo', 50);
            $table->string('camiseta_devuelta');
            $table->string('camiseta_solicitada');
            $table->decimal('importe', 10, 2)->default(0);
            $table->enum('estado', ['pendiente', 'cambiado'])->default('pendiente');
            $table->date('fecha');
            $table->timestamps();
        });

        // TRANSACCIONES FINANCIERAS
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['ingreso', 'gasto']);
            $table->string('descripcion');
            $table->decimal('importe', 10, 2);
            $table->string('canal', 30);
            $table->date('fecha');
            $table->timestamps();
        });

        // CONTADOR DE VENTAS EN TIENDA
        Schema::create('configuracion', function (Blueprint $table) {
            $table->string('clave')->primary();
            $table->string('valor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones');
        Schema::dropIfExists('devoluciones');
        Schema::dropIfExists('envios');
        Schema::dropIfExists('configuracion');
    }
};

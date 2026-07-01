<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('proveedor_id'); // 1, 2, 3, 4
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado', 'recibido'])
                  ->default('pendiente');
            $table->text('notas')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });

        Schema::create('pedido_lineas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            $table->string('equipo');
            $table->string('temporada', 10);
            $table->unsignedInteger('talla_s')->default(0);
            $table->unsignedInteger('talla_m')->default(0);
            $table->unsignedInteger('talla_l')->default(0);
            $table->unsignedInteger('talla_xl')->default(0);
            $table->unsignedInteger('talla_xxl')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_lineas');
        Schema::dropIfExists('pedidos');
    }
};

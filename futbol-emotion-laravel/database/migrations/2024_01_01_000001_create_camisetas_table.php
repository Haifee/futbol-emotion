<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('camisetas', function (Blueprint $table) {
            $table->id();
            $table->string('equipo');
            $table->string('temporada', 10)->default('24/25');
            $table->string('tipo', 20)->default('Local'); // Local, Visitante, Tercera, Portero
            $table->unsignedInteger('talla_s')->default(0);
            $table->unsignedInteger('talla_m')->default(0);
            $table->unsignedInteger('talla_l')->default(0);
            $table->unsignedInteger('talla_xl')->default(0);
            $table->unsignedInteger('talla_xxl')->default(0);
            $table->unsignedInteger('stock_minimo')->default(5);
            $table->unsignedTinyInteger('proveedor_id')->default(1); // 1,2,3,4
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camisetas');
    }
};

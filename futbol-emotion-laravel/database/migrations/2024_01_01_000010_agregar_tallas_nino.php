<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega tallas de niño (10, 12, 14, 16) al inventario y a los pedidos.
     */
    public function up(): void
    {
        Schema::table('camisetas', function (Blueprint $table) {
            $table->unsignedInteger('talla_10')->default(0)->after('talla_xxl');
            $table->unsignedInteger('talla_12')->default(0)->after('talla_10');
            $table->unsignedInteger('talla_14')->default(0)->after('talla_12');
            $table->unsignedInteger('talla_16')->default(0)->after('talla_14');
        });

        Schema::table('pedido_lineas', function (Blueprint $table) {
            $table->unsignedInteger('talla_10')->default(0)->after('talla_xxl');
            $table->unsignedInteger('talla_12')->default(0)->after('talla_10');
            $table->unsignedInteger('talla_14')->default(0)->after('talla_12');
            $table->unsignedInteger('talla_16')->default(0)->after('talla_14');
        });
    }

    public function down(): void
    {
        Schema::table('camisetas', function (Blueprint $table) {
            $table->dropColumn(['talla_10', 'talla_12', 'talla_14', 'talla_16']);
        });

        Schema::table('pedido_lineas', function (Blueprint $table) {
            $table->dropColumn(['talla_10', 'talla_12', 'talla_14', 'talla_16']);
        });
    }
};

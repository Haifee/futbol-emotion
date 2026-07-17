<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Permite productos que no son camisetas (balones, medias, guantes...).
     * - categoria: 'camiseta' o el nombre libre del tipo de producto
     * - talla_u:   stock en unidades para productos sin tallas (talla "Única")
     */
    public function up(): void
    {
        Schema::table('camisetas', function (Blueprint $table) {
            $table->string('categoria', 50)->default('camiseta')->after('tipo');
            $table->unsignedInteger('talla_u')->default(0)->after('talla_16');
        });

        Schema::table('pedido_lineas', function (Blueprint $table) {
            $table->unsignedInteger('talla_u')->default(0)->after('talla_16');
        });
    }

    public function down(): void
    {
        Schema::table('camisetas', function (Blueprint $table) {
            $table->dropColumn(['categoria', 'talla_u']);
        });

        Schema::table('pedido_lineas', function (Blueprint $table) {
            $table->dropColumn('talla_u');
        });
    }
};

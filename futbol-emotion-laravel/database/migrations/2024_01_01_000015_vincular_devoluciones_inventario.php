<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Vincula cada lado del cambio con una camiseta+talla del inventario.
     * Si son texto libre (no están en inventario), quedan en null.
     */
    public function up(): void
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->unsignedBigInteger('dev_camiseta_id')->nullable()->after('camiseta_devuelta');
            $table->string('dev_talla', 5)->nullable()->after('dev_camiseta_id');
            $table->unsignedBigInteger('sol_camiseta_id')->nullable()->after('camiseta_solicitada');
            $table->string('sol_talla', 5)->nullable()->after('sol_camiseta_id');
            $table->boolean('stock_aplicado')->default(false)->after('estado');
        });
    }

    public function down(): void
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropColumn(['dev_camiseta_id', 'dev_talla', 'sol_camiseta_id', 'sol_talla', 'stock_aplicado']);
        });
    }
};

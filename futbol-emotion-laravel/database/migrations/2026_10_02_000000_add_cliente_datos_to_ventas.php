<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega la cédula y el teléfono del cliente a la tabla de ventas.
     * Columnas nuevas, opcionales (nullable): no afectan las ventas existentes.
     */
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            if (!Schema::hasColumn('ventas', 'cliente_cedula')) {
                $table->string('cliente_cedula', 20)->nullable()->after('cliente');
            }
            if (!Schema::hasColumn('ventas', 'cliente_telefono')) {
                $table->string('cliente_telefono', 30)->nullable()->after('cliente_cedula');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            foreach (['cliente_cedula', 'cliente_telefono'] as $col) {
                if (Schema::hasColumn('ventas', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};

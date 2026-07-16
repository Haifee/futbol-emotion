<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Vincula cada transacción de ingreso con la venta que la generó,
        // para poder corregirla o eliminarla junto con la venta.
        Schema::table('transacciones', function (Blueprint $table) {
            $table->foreignId('venta_id')->nullable()->after('id')
                  ->constrained('ventas')->nullOnDelete();
        });

        // Intentar vincular retroactivamente las transacciones existentes
        // (mismo día + mismo importe + descripción de venta). Es "best effort":
        // las que no se puedan emparejar con certeza quedan sin vincular.
        $ventas = \Illuminate\Support\Facades\DB::table('ventas')->get();
        foreach ($ventas as $v) {
            \Illuminate\Support\Facades\DB::table('transacciones')
                ->whereNull('venta_id')
                ->where('tipo', 'ingreso')
                ->where('fecha', $v->fecha)
                ->where('importe', $v->importe)
                ->where('descripcion', 'like', 'Venta %')
                ->limit(1)
                ->update(['venta_id' => $v->id]);
        }
    }

    public function down(): void
    {
        Schema::table('transacciones', function (Blueprint $table) {
            $table->dropConstrainedForeignId('venta_id');
        });
    }
};

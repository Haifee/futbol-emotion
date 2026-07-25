<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cierres de caja: una "foto" del día cuando se hace el corte.
     */
    public function up(): void
    {
        Schema::create('cierres_caja', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('cerrado_por', 20);       // owner | manager
            $table->decimal('ingresos', 14, 2)->default(0);
            $table->decimal('gastos', 14, 2)->default(0);
            $table->decimal('beneficio', 14, 2)->default(0);
            $table->unsignedInteger('num_ventas')->default(0);
            $table->decimal('total_divisas', 14, 2)->default(0);  // cobrado en $
            $table->decimal('total_bs', 14, 2)->default(0);       // cobrado en Bs
            $table->text('nota')->nullable();
            $table->timestamps();

            $table->index('fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cierres_caja');
    }
};

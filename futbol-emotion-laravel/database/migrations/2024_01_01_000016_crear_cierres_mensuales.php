<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cierres mensuales: la "foto" de cada mes que pasó.
     */
    public function up(): void
    {
        Schema::create('cierres_mensuales', function (Blueprint $table) {
            $table->id();
            $table->string('mes', 7)->unique();      // formato YYYY-MM
            $table->decimal('ingresos', 14, 2)->default(0);
            $table->decimal('gastos', 14, 2)->default(0);
            $table->decimal('beneficio', 14, 2)->default(0);
            $table->unsignedInteger('num_ventas')->default(0);
            $table->decimal('total_divisas', 14, 2)->default(0);
            $table->decimal('total_bs', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cierres_mensuales');
    }
};

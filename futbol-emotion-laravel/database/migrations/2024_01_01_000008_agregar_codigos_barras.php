<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Precio sugerido por camiseta (se autocompleta al vender, pero es editable)
        Schema::table('camisetas', function (Blueprint $table) {
            $table->decimal('precio', 10, 2)->nullable()->after('proveedor_id');
        });

        // Cada código de barras de fábrica corresponde a una camiseta + talla
        Schema::create('codigos_barras', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 64)->unique();
            $table->foreignId('camiseta_id')->constrained('camisetas')->onDelete('cascade');
            $table->string('talla', 5); // S, M, L, XL, XXL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codigos_barras');
        Schema::table('camisetas', function (Blueprint $table) {
            $table->dropColumn('precio');
        });
    }
};

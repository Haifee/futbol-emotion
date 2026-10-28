<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Segundo precio (oferta / descuento). Opcional. Se cobra con el toggle
    // "Cobrar con Precio 2" en el carrito.
    public function up(): void
    {
        if (!Schema::hasColumn('camisetas', 'precio2')) {
            Schema::table('camisetas', function (Blueprint $table) {
                $table->decimal('precio2', 10, 2)->nullable()->after('precio');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('camisetas', 'precio2')) {
            Schema::table('camisetas', function (Blueprint $table) {
                $table->dropColumn('precio2');
            });
        }
    }
};

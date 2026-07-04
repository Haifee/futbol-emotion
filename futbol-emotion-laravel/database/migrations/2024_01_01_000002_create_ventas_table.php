<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camiseta_id')->constrained()->onDelete('restrict');
            $table->string('equipo');               // nombre completo para display
            $table->string('talla', 5);             // S, M, L, XL, XXL
            $table->unsignedInteger('cantidad');
            $table->string('canal', 30);            // Tienda física, Instagram, WhatsApp, Web
            $table->string('cliente')->nullable();  // null en ventas de tienda física
            $table->string('numero_venta')->nullable(); // #001, #002 para tienda física
            $table->decimal('importe', 10, 2);
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actividad', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('descripcion');
            $table->string('extra')->nullable();
            $table->string('rol');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('notificaciones_vistas', function (Blueprint $table) {
            $table->id();
            $table->string('rol');
            $table->unsignedBigInteger('actividad_id');
            $table->timestamps();
            $table->unique(['rol', 'actividad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones_vistas');
        Schema::dropIfExists('actividad');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE devoluciones MODIFY estado ENUM('pendiente','aprobado','rechazado','cambiado') DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE devoluciones MODIFY estado ENUM('pendiente','cambiado') DEFAULT 'pendiente'");
    }
};

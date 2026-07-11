<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Quitar la restricción de llave foránea temporalmente para poder modificar la columna
        DB::statement('ALTER TABLE ventas DROP FOREIGN KEY ventas_camiseta_id_foreign');
        DB::statement('ALTER TABLE ventas MODIFY camiseta_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE ventas ADD CONSTRAINT ventas_camiseta_id_foreign FOREIGN KEY (camiseta_id) REFERENCES camisetas(id) ON DELETE RESTRICT');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE ventas DROP FOREIGN KEY ventas_camiseta_id_foreign');
        DB::statement('ALTER TABLE ventas MODIFY camiseta_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE ventas ADD CONSTRAINT ventas_camiseta_id_foreign FOREIGN KEY (camiseta_id) REFERENCES camisetas(id) ON DELETE RESTRICT');
    }
};

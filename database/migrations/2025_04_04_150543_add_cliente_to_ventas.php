<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agregar las columnas en la tabla 'ventas'
        Schema::table('ventas', function (Blueprint $table) {
            $table->string('dni');
            $table->string('nombre_cliente');
            $table->string('apellido_cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las columnas cuando se revierta la migración
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn(['dni', 'nombre_cliente', 'apellido_cliente']);
        });
    }
};

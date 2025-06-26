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
        Schema::create('empleado_curso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained('users');
            $table->foreignId('capacitacion_id')->constrained('capacitaciones');
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado'])->default('pendiente');
            $table->integer('progreso')->default(0);
            $table->dateTime('fecha_completado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_curso');
    }
};

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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_descuento', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('sku')->unique();
            $table->string('talla');
            $table->string('color');
            $table->string('material');
            $table->enum('genero', ['hombre', 'mujer', 'unisex', 'niño', 'niña']);
            $table->string('temporada');
            $table->string('imagen_principal');
            $table->json('imagenes_adicionales')->nullable();
            $table->boolean('es_destacado')->default(false);
            $table->boolean('es_nuevo')->default(false);
            $table->float('rating_promedio')->default(0);
            $table->integer('numero_valoraciones')->default(0);
            $table->integer('peso')->default(0);
            $table->string('origen')->nullable();
            $table->timestamps();

            $table->foreignId('marca_id')->constrained()->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

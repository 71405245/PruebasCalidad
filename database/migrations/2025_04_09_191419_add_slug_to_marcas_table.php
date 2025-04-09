<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('marcas', function (Blueprint $table) {
            $table->string('slug')->unique()->after('nombre');
            $table->boolean('es_activa')->default(true)->after('logo');
            $table->string('website')->nullable()->after('es_activa');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marcas', function (Blueprint $table) {
            //
        });
    }
};

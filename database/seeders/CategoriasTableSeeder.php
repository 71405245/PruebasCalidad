<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasTableSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nombre' => 'Camisetas', 'es_activa' => true],
            ['nombre' => 'Pantalones', 'es_activa' => true],
            ['nombre' => 'Vestidos', 'es_activa' => true],
            ['nombre' => 'Zapatos', 'es_activa' => true],
            ['nombre' => 'Accesorios', 'es_activa' => true],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
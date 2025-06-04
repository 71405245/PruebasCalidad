<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Producto;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_producto()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Teclado',
            'precio' => 100.00,
            'stock' => 10
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('productos', ['nombre' => 'Teclado']);
    }

    public function test_validacion_nombre_producto()
    {
        $response = $this->post('/productos', [
            'nombre' => '',
            'precio' => 50.00,
            'stock' => 5
        ]);

        $response->assertSessionHasErrors('nombre');
    }
}
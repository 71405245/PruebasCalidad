<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProductoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_puede_ver_lista_de_productos()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Actuar como ese usuario
        $response = $this->actingAs($user)->get('/productos');

        // Verifica que la página carga correctamente
        $response->assertStatus(200);

        // Verifica que contiene texto esperado
        $response->assertSee('Productos');
    }
}

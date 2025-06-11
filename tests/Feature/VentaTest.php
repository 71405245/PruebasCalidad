<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class VentaTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_puede_ver_lista_de_ventas()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/ventas');

        $response->assertStatus(200);
        $response->assertSee('Ventas'); // Asegúrate de que tu vista contenga esta palabra
    }
}

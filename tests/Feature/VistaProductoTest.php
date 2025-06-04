<?php

namespace Tests\Feature;

use Tests\TestCase;

class VistaProductosTest extends TestCase
{
    public function test_vista_productos_accesible()
    {
        $response = $this->get('/productos');
        $response->assertStatus(200); // suponiendo que no requiere auth
    }
}
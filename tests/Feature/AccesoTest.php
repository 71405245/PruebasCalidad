<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccesoTest extends TestCase
{
    public function test_restringe_ventas_sin_login()
    {
        $response = $this->get('/ventas');
        $response->assertRedirect('/login');
    }

    public function test_restringe_reporte_sin_login()
    {
        $response = $this->get('/reportes/ventas'); 

        $response->assertRedirect('/login');
    }
}

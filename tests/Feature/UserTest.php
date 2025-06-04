<?php

namespace Tests\Feature;

use Tests\TestCase;

class RutaDashboardTest extends TestCase
{
    public function test_dashboard_redirecciona_o_muestra()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302); // redirige si no está logueado
    }
}
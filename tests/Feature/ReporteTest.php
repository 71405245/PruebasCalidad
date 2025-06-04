<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReporteTest extends TestCase
{
    public function test_ver_reportes()
    {
        $response = $this->get('/reportes');
        $response->assertStatus(200);
        $response->assertSee('Reporte de Ingresos');
    }
}
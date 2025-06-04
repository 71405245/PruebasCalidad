<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Venta;

class VentaTest extends TestCase
{
    use RefreshDatabase;

    public function test_creacion_venta()
    {
        $venta = Venta::create([
            'cliente' => 'Jordan Quispe',
            'fecha' => now(),
            'total' => 150.00
        ]);

        $this->assertDatabaseHas('ventas', [
            'cliente' => 'Jordan Quispe'
        ]);
    }
}
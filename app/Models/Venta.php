<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Venta extends Model
{
    protected $fillable = ['dni', 'nombre_cliente', 'apellido_cliente', 'total'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_venta')
        ->withPivot('cantidad', 'precio_unitario', 'subtotal')
        ->withTimestamps();
    }
}

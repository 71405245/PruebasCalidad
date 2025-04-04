<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio', 'stock'];

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'producto_venta')
            ->withPivot('cantidad', 'subtotal')
            ->withTimestamps();
    }
}

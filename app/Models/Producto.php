<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'precio_descuento', // Para ofertas
        'stock',
        'sku', // Código único del producto
        'marca_id', // Relación con tabla de marcas
        'categoria_id', // Relación con tabla de categorías
        'talla', // Tallas de ropa
        'color',
        'material',
        'genero', // Hombre, Mujer, Unisex, Niño, Niña
        'temporada', // Primavera/Verano, Otoño/Invierno
        'imagen_principal',
        'imagenes_adicionales', // JSON con array de imágenes
        'es_destacado', // Para productos destacados en la página principal
        'es_nuevo', // Para productos recién llegados
        'rating_promedio', // Valoración promedio
        'numero_valoraciones', // Cantidad de valoraciones
        'peso', // Peso en gramos para cálculo de envío
        'origen' // País de origen/manufactura
    ];

    protected $casts = [
        'imagenes_adicionales' => 'array',
        'precio_descuento' => 'float',
        'es_destacado' => 'boolean',
        'es_nuevo' => 'boolean',
    ];

    // Relación con ventas
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'producto_venta')
            ->withPivot('cantidad', 'subtotal', 'precio_unitario')
            ->withTimestamps();
    }

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Accesor para calcular el porcentaje de descuento
    public function getPorcentajeDescuentoAttribute()
    {
        if ($this->precio_descuento && $this->precio) {
            return round((($this->precio - $this->precio_descuento) / $this->precio) * 100);
        }
        return 0;
    }

    // Accesor para obtener el precio actual (con descuento si aplica)
    public function getPrecioActualAttribute()
    {
        return $this->precio_descuento ?: $this->precio;
    }

    // Método para verificar disponibilidad
    public function estaDisponible()
    {
        return $this->stock > 0;
    }

    // Scope para productos destacados
    public function scopeDestacados($query)
    {
        return $query->where('es_destacado', true);
    }

    // Scope para productos nuevos
    public function scopeNuevos($query)
    {
        return $query->where('es_nuevo', true);
    }

    // Scope para productos en oferta
    public function scopeOfertas($query)
    {
        return $query->whereNotNull('precio_descuento');
    }

    // Scope para filtrar por categoría
    public function scopeDeCategoria($query, $categoria_id)
    {
        return $query->where('categoria_id', $categoria_id);
    }

    // Scope para filtrar por género
    public function scopeParaGenero($query, $genero)
    {
        return $query->where('genero', $genero);
    }
}
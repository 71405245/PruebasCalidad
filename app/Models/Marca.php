<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'logo',
        'website',
        'es_activa'
    ];

    public function scopeActive($query)
    {
        return $query->where('es_activa', true);
    }
    protected $casts = [
        'es_activa' => 'boolean'
    ];

    // Relación con productos
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    // URL amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

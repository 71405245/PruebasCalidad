<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Capacitacion extends Model
{
    protected $table = 'capacitaciones';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'duracion',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];

    public function empleados(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'empleado_curso')
            ->withPivot('estado', 'progreso', 'fecha_completado')
            ->withTimestamps();
    }
}

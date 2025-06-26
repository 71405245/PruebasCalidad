<div class="card">
    <div class="card-header">
        <h5>Mis Capacitaciones</h5>
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach (auth()->user()->capacitaciones as $capacitacion)
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>{{ $capacitacion->titulo }}</h6>
                            <small class="text-muted">
                                {{ $capacitacion->tipo }} | {{ $capacitacion->duracion }}
                            </small>
                        </div>
                        <div>
                            <span
                                class="badge bg-{{ [
                                    'pendiente' => 'warning',
                                    'en_progreso' => 'info',
                                    'completado' => 'success',
                                ][$capacitacion->pivot->estado] }}">
                                {{ Str::title(str_replace('_', ' ', $capacitacion->pivot->estado)) }}
                            </span>
                            <div class="progress mt-2" style="width: 150px; height: 20px;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $capacitacion->pivot->progreso }}%">
                                    {{ $capacitacion->pivot->progreso }}%
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($capacitacion->pivot->estado != 'completado')
                        <div class="mt-2">
                            <a href="{{ route('capacitaciones.progreso', $capacitacion) }}?progreso={{ $capacitacion->pivot->progreso + 10 }}"
                                class="btn btn-sm btn-outline-primary">
                                Marcar +10%
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

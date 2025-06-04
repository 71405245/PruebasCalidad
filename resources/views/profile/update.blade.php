@extends('layouts.app')

@section('title', 'Perfil Actualizado')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>¡Perfil Actualizado!</h5>
                </div>

                <div class="card-body text-center py-4">
                    <div class="mb-4">
                        <i class="fas fa-user-check fa-5x text-success mb-3"></i>
                        <h3 class="fw-bold">Cambios guardados exitosamente</h3>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-edit me-1"></i> Editar de nuevo
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-success">
                            <i class="fas fa-tachometer-alt me-1"></i> Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
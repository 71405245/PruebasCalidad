@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Editar Perfil</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Foto de perfil -->
                        <div class="mb-4 text-center">
                            <div class="position-relative d-inline-block">
                                <img src="{{ Auth::user()->photo ?? asset('storage/profile-default.jpg') }}" 
                                     class="rounded-circle border border-danger" 
                                     width="150" height="150" 
                                     alt="Foto de perfil">
                                <label class="btn btn-sm btn-danger position-absolute bottom-0 end-0 rounded-circle" 
                                       style="width: 40px; height: 40px;"
                                       title="Cambiar foto">
                                    <i class="fas fa-camera"></i>
                                    <input type="file" name="photo" class="d-none" accept="image/*">
                                </label>
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', Auth::user()->name) }}" 
                                   required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', Auth::user()->email) }}" 
                                   required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input id="phone" type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Vista previa de la imagen seleccionada
    document.querySelector('input[name="photo"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector('.rounded-circle').src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
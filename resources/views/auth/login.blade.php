@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Iniciar Sesión') }}</h4>
                        <img src="{{ asset('storage/logo.jpg') }}" alt="Ssamanth Clothes Shein" height="30">  
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Login con Google -->
                    <div class="text-center mb-4">
                        <a href="{{ route('login.google') }}" class="btn btn-outline-danger rounded-pill d-flex align-items-center justify-content-center">
                            <img src="https://img.freepik.com/vector-premium/logotipo-google_798572-207.jpg?ga=GA1.1.584119874.1748414002&semt=ais_hybrid&w=740" alt="Google" width="20" class="me-2">
                            {{ __('Continuar con Google') }}
                        </a>
                        <div class="my-3 position-relative">
                            <hr>
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 text-muted">o</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="tu@email.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password"
                                       placeholder="••••••••">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Recordar sesión y olvidé contraseña -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Recordar sesión') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Botón de login -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-danger py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Iniciar Sesión') }}
                            </button>
                        </div>

                        <!-- Enlace a registro -->
                        <div class="text-center">
                            <p class="mb-0">{{ __('¿No tienes una cuenta?') }}
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
                                    {{ __('Regístrate') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
</script>
@endpush
@endsection
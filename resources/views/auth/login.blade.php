@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<<<<<<< HEAD
<div class="min-vh-100 d-flex">
    <!-- Columna izquierda -->
    <div class="col-md-6 d-none d-md-flex bg-danger text-white flex-column justify-content-center align-items-center p-5">
        <img src="{{ asset('storage/logo.jpg') }}" alt="Logo" height="80" class="mb-4 rounded">
        <h1 class="fw-bold mb-3">Ssamanth Clothes</h1>
        <p class="lead text-center px-4">
            Sistema de gestión de ventas e inventario. Optimiza tu negocio con tecnología moderna.
        </p>
    </div>

    <!-- Columna derecha -->
    <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="width: 100%; max-width: 420px;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h5 class="fw-bold text-dark mb-1">Bienvenido</h5>
                    <small class="text-muted">Ingresa a tu cuenta</small>
                </div>

                <!-- Botón Google -->
                <div class="d-grid mb-3">
                    <a href="{{ route('login.google') }}" class="btn btn-outline-dark rounded-pill d-flex align-items-center justify-content-center gap-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" width="20">
                        <span class="fw-semibold">Continuar con Google</span>
                    </a>
                </div>

                <div class="text-center my-3">
                    <span class="text-muted small">o usa tu correo y contraseña</span>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                            class="form-control @error('email') is-invalid @enderror" placeholder="correo@example.com">
                        <label for="email">Correo Electrónico</label>
                        @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
=======
    <div class="min-vh-100 d-flex">
        <!-- Columna izquierda -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center p-5 text-white"
            style="background: url('{{ asset('storage/logo.jpg') }}') center center / cover no-repeat, #dc3545;">

=======
    <div class="min-vh-100 d-flex">
        <!-- Columna izquierda -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center p-5 text-white"
            style="background: url('{{ asset('storage/logo.jpg') }}') center center / cover no-repeat, #dc3545;">

>>>>>>> 2350b95 (código 7)
            <div style="background-color: rgba(0,0,0,0.5); padding: 2rem; border-radius: 1rem; text-align: center;">
                <img src="{{ asset('storage/logo.jpg') }}" alt="Logo" height="80" class="mb-4 rounded shadow">
                <h1 class="fw-bold mb-3">Ssamanth Shein Clothes</h1>
                <p class="lead px-4">
                    Sistema de gestión de ventas e inventario. Optimiza tu negocio con tecnología moderna.
                </p>
            </div>
        </div>


        <!-- Columna derecha -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
            <div class="card shadow-sm border-0 rounded-4 p-4" style="width: 100%; max-width: 420px;">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5 class="fw-bold text-dark mb-1">Bienvenido</h5>
                        <small class="text-muted">Ingresa a tu cuenta</small>
<<<<<<< HEAD
=======
                    </div>

                    <!-- Botón Google -->
                    <div class="d-grid mb-3">
                        <a href="{{ route('login.google') }}"
                            class="btn btn-outline-dark rounded-pill d-flex align-items-center justify-content-center gap-2">
                            <img src="storage/Google.png" width="20">
                            <span class="fw-semibold">Continuar con Google</span>
                        </a>
                    </div>

                    <div class="text-center my-3">
                        <span class="text-muted small">o usa tu correo y contraseña</span>
>>>>>>> 2350b95 (código 7)
                    </div>

                    <!-- Botón Google -->
                    <div class="d-grid mb-3">
                        <a href="{{ route('login.google') }}"
                            class="btn btn-outline-dark rounded-pill d-flex align-items-center justify-content-center gap-2">
                            <img src="storage/Google.png" width="20">
                            <span class="fw-semibold">Continuar con Google</span>
                        </a>
                    </div>

                    <div class="text-center my-3">
                        <span class="text-muted small">o usa tu correo y contraseña</span>
>>>>>>> 2350b95 (código 7)
                    </div>

                    <!-- Contraseña -->
                    <div class="form-floating mb-3 position-relative">
                        <input id="password" type="password" name="password" required 
                            class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                        <label for="password">Contraseña</label>
                        <button type="button" class="btn btn-sm btn-light position-absolute end-0 top-50 translate-middle-y me-2 toggle-password" style="z-index: 2;">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

<<<<<<< HEAD
                    <!-- Recordar y olvidar -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small" for="remember">Recordar sesión</label>
=======
                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="form-control @error('email') is-invalid @enderror" placeholder="correo@example.com">
                            <label for="email">Correo Electrónico</label>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
>>>>>>> 2350b95 (código 7)
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none text-muted">¿Olvidaste tu contraseña?</a>
                        @endif
                    </div>

<<<<<<< HEAD
                    <!-- Botón -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-danger rounded-pill py-2 fw-semibold">
                            <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                        </button>
                    </div>

                    <!-- Registro -->
                    <div class="text-center">
                        <small class="text-muted">¿No tienes una cuenta?</small>
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold ms-1">Regístrate</a>
                    </div>
                </form>
=======
                        <!-- Contraseña -->
                        <div class="form-floating mb-3 position-relative">
                            <input id="password" type="password" name="password" required
                                class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                            <label for="password">Contraseña</label>
                            <button type="button"
                                class="btn btn-sm btn-light position-absolute end-0 top-50 translate-middle-y me-2 toggle-password"
                                style="z-index: 2;">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Recordar y olvidar -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="remember">Recordar sesión</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="small text-decoration-none text-muted">¿Olvidaste tu contraseña?</a>
                            @endif
                        </div>

                        <!-- Botón -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-danger rounded-pill py-2 fw-semibold">
                                <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                            </button>
                        </div>

                        <!-- Registro -->
                        <div class="text-center">
                            <small class="text-muted">¿No tienes una cuenta?</small>
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold ms-1">Regístrate</a>
                        </div>
                    </form>
                </div>
>>>>>>> 2350b95 (código 7)
            </div>
        </div>
    </div>

<<<<<<< HEAD
<<<<<<< HEAD
@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.form-floating').querySelector('input');
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
=======
=======
>>>>>>> 2350b95 (código 7)
    @push('scripts')
        <script>
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.closest('.form-floating').querySelector('input');
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
<<<<<<< HEAD
>>>>>>> 2350b95 (código 7)
=======
>>>>>>> 2350b95 (código 7)
@endsection

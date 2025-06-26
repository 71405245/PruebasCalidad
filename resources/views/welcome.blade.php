@extends('layouts.app')

@section('title', 'Sistema de Ventas - Dashboard')

@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }

        .card-action {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-action {
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            background: linear-gradient(45deg, #c82333, #a71e2a);
            transform: scale(1.02);
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #dc3545;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }

            .btn-action {
                font-size: 1rem !important;
                padding: 1rem !important;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-store me-3"></i>
                Sistema de Ventas
            </h1>
            <p class="lead fs-4 mb-4">
                Gestiona tu negocio de manera inteligente y eficiente
            </p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="fs-5 opacity-75">
                        Controla tus productos, ventas y obtén reportes detallados para tomar mejores decisiones
                    </p>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
<<<<<<< HEAD
        <div class="d-flex justify-content-center gap-4 mt-5 flex-wrap">
            <a href="{{ route('ventas.index') }}" class="btn btn-danger text-white fw-bold w-25 py-6 fs-2 shadow rounded-4">
                <i class="fas fa-cash-register me-2"></i> Gestión de Ventas
            </a>
            <a href="{{ route('productos.create') }}" class="btn btn-danger text-white fw-bold w-25 py-6 fs-2 shadow rounded-4">
                <i class="fas fa-plus-circle me-2"></i> Crear Producto
            </a>
            <a href="{{ route('productos.index') }}" class="btn btn-danger text-white fw-bold w-25 py-6 fs-2 shadow rounded-4">
                <i class="fas fa-box-open me-2"></i> Catálogo
            </a>

            <!-- Botón de Reportes con dropdown -->
            <div class="dropdown w-25">
                <button class="btn btn-danger text-white fw-bold w-100 py-6 fs-2 shadow rounded-4 dropdown-toggle"
                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chart-pie me-2"></i> Reportes
                </button>
                <ul class="dropdown-menu w-100 fs-4 shadow rounded-4" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item fs-3 py-3" href="{{ route('reportes.ventas') }}">
                            <i class="fas fa-chart-line me-2"></i> Reporte de Ventas
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-3 py-3" href="{{ route('reportes.inventario') }}">
                            <i class="fas fa-boxes me-2"></i> Reporte de Inventario
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-3 py-3" href="{{ route('reportes.clientes') }}">
                            <i class="fas fa-users me-2"></i> Reporte de Clientes
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-3 py-3" href="{{ route('reportes.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Panel Analítico
                        </a>
                    </li>
                </ul>
=======
    <!-- Quick Stats Section -->
    @if (isset($stats))
        <div class="container mb-5">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-shopping-cart text-danger fs-1 mb-2"></i>
                        <h3 class="fw-bold text-danger">{{ $stats['ventas_hoy'] ?? '0' }}</h3>
                        <p class="text-muted mb-0">Ventas Hoy</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-boxes text-warning fs-1 mb-2"></i>
                        <h3 class="fw-bold text-warning">{{ $stats['productos_total'] ?? '0' }}</h3>
                        <p class="text-muted mb-0">Productos</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-dollar-sign text-success fs-1 mb-2"></i>
                        <h3 class="fw-bold text-success">${{ number_format($stats['ingresos_mes'] ?? 0, 2) }}</h3>
                        <p class="text-muted mb-0">Ingresos del Mes</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-users text-info fs-1 mb-2"></i>
                        <h3 class="fw-bold text-info">{{ $stats['clientes_total'] ?? '0' }}</h3>
                        <p class="text-muted mb-0">Clientes</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

=======
    <!-- Quick Stats Section -->
    @if (isset($stats))
        <div class="container mb-5">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-shopping-cart text-danger fs-1 mb-2"></i>
                        <h3 class="fw-bold text-danger">{{ $stats['ventas_hoy'] ?? '0' }}</h3>
                        <p class="text-muted mb-0">Ventas Hoy</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-boxes text-warning fs-1 mb-2"></i>
                        <h3 class="fw-bold text-warning">{{ $stats['productos_total'] ?? '0' }}</h3>
                        <p class="text-muted mb-0">Productos</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-dollar-sign text-success fs-1 mb-2"></i>
                        <h3 class="fw-bold text-success">${{ number_format($stats['ingresos_mes'] ?? 0, 2) }}</h3>
                        <p class="text-muted mb-0">Ingresos del Mes</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card text-center">
                        <i class="fas fa-users text-info fs-1 mb-2"></i>
                        <h3 class="fw-bold text-info">{{ $stats['clientes_total'] ?? '0' }}</h3>
                        <p class="text-muted mb-0">Clientes</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

>>>>>>> 2350b95 (código 7)
    <!-- Main Actions Section -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-5 fw-bold text-dark">
                    <i class="fas fa-cogs me-2"></i>
                    Panel de Control
                </h2>

                <div class="row g-4">
                    <!-- Gestión de Ventas -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-action h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-cash-register text-danger" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="card-title fw-bold mb-3">Gestión de Ventas</h4>
                                <p class="card-text text-muted mb-4">
                                    Registra nuevas ventas, consulta historial y gestiona transacciones
                                </p>
                                <a href="{{ route('ventas.index') }}"
                                    class="btn btn-action btn-lg text-white fw-bold px-4 py-3 w-100">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Ir a Ventas
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión de Productos -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-action h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-box-open text-danger" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="card-title fw-bold mb-3">Catálogo de Productos</h4>
                                <p class="card-text text-muted mb-4">
                                    Visualiza, edita y administra tu inventario de productos
                                </p>
                                <a href="{{ route('productos.index') }}"
                                    class="btn btn-action btn-lg text-white fw-bold px-4 py-3 w-100">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Ver Catálogo
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Crear Producto -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-action h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-plus-circle text-danger" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="card-title fw-bold mb-3">Agregar Producto</h4>
                                <p class="card-text text-muted mb-4">
                                    Añade nuevos productos a tu inventario de forma rápida
                                </p>
                                <a href="{{ route('productos.create') }}"
                                    class="btn btn-action btn-lg text-white fw-bold px-4 py-3 w-100">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Crear Producto
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Reportes -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-action h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-chart-pie text-danger" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="card-title fw-bold mb-3">Centro de Reportes</h4>
                                <p class="card-text text-muted mb-4">
                                    Accede a reportes detallados y análisis de tu negocio
                                </p>

                                <!-- Dropdown de Reportes -->
                                <div class="dropdown">
                                    <button class="btn btn-action btn-lg text-white fw-bold px-4 py-3 w-100 dropdown-toggle"
                                        type="button" id="reportesDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-chart-line me-2"></i>
                                        Ver Reportes
                                    </button>
                                    <ul class="dropdown-menu w-100 shadow-lg border-0" aria-labelledby="reportesDropdown">
                                        <li>
                                            <a class="dropdown-item py-3 px-4" href="{{ route('reportes.ventas') }}">
                                                <i class="fas fa-chart-line text-success me-3"></i>
                                                <span class="fw-semibold">Reporte de Ventas</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-3 px-4" href="{{ route('reportes.inventario') }}">
                                                <i class="fas fa-boxes text-warning me-3"></i>
                                                <span class="fw-semibold">Reporte de Inventario</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-3 px-4" href="{{ route('reportes.clientes') }}">
                                                <i class="fas fa-users text-info me-3"></i>
                                                <span class="fw-semibold">Reporte de Clientes</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-3 px-4 {{ request()->routeIs('dashboard') ? 'active bg-light' : '' }}"
                                                href="{{ route('dashboard') }}">
                                                <i class="fas fa-tachometer-alt text-primary me-3"></i>
                                                <span class="fw-semibold">Panel Analítico</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Capacitaciones -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-action h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-plus-circle text-danger" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="card-title fw-bold mb-3">Capacitaciones al Empleado</h4>
                                <p class="card-text text-muted mb-4">
                                    Añade nuevas capacitaciones para los empleados de forma rápida
                                </p>
                                <a href="{{ route('capacitaciones.index') }}"
                                    class="btn btn-action btn-lg text-white fw-bold px-4 py-3 w-100">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Ir a Capacitaciones
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            Acciones Rápidas
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('ventas.create') }}" class="btn btn-outline-danger w-100 py-2">
                                    <i class="fas fa-plus me-2"></i>Nueva Venta
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('productos.index') }}?filter=low_stock"
                                    class="btn btn-outline-warning w-100 py-2">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Stock Bajo
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('reportes.ventas') }}?period=today"
                                    class="btn btn-outline-success w-100 py-2">
                                    <i class="fas fa-calendar-day me-2"></i>Ventas Hoy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
>>>>>>> 2350b95 (código 7)
=======
>>>>>>> 2350b95 (código 7)
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Animación de entrada para las tarjetas
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-action');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        });

        // Tooltip para botones
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endpush

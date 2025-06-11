@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="container text-center mt-5">
        <h1>Bienvenido al Sistema de Ventas</h1>
        <p class="lead">Gestiona tus productos y ventas de manera eficiente.</p>

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
            </div>
        </div>
    </div>
@endsection

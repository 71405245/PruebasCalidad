@extends('layouts.app')

@push('styles')
    <style>
        .hero-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 30px 30px;
        }

        .filter-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .filter-card .card-body {
            padding: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none;
            transition: all 0.4s ease;
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            height: 250px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .product-badges {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 10;
        }

        .product-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-destacado {
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            color: #8b5a00;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .badge-nuevo {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .badge-promocion {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .product-sku {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 1rem;
            font-family: 'Courier New', monospace;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .product-price {
            margin-bottom: 1rem;
        }

        .price-current {
            font-size: 1.4rem;
            font-weight: 700;
            color: #dc3545;
        }

        .price-original {
            font-size: 1rem;
            color: #6c757d;
            text-decoration: line-through;
            margin-left: 0.5rem;
        }

        .stock-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .stock-high {
            background: #d4edda;
            color: #155724;
        }

        .stock-medium {
            background: #fff3cd;
            color: #856404;
        }

        .stock-low {
            background: #f8d7da;
            color: #721c24;
        }

        .stock-out {
            background: #f5c6cb;
            color: #721c24;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-action {
            flex: 1;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            padding: 0.6rem;
        }

        .btn-primary-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid #e9ecef;
            color: #6c757d;
        }

        .btn-outline-custom:hover {
            background: #f8f9fa;
            border-color: #dc3545;
            color: #dc3545;
        }

        .view-toggle {
            background: white;
            border-radius: 15px;
            padding: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            margin-bottom: 2rem;
        }

        .view-toggle .btn {
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }

        .view-toggle .btn.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #e9ecef;
            margin-bottom: 1rem;
        }

        .search-highlight {
            background: linear-gradient(45deg, #fff3cd, #ffeaa7);
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-weight: 600;
        }

        .filter-chip {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin: 0.2rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .filter-chip:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
            color: white;
            transform: scale(1.05);
        }

        .filter-chip .remove {
            margin-left: 0.5rem;
            cursor: pointer;
            opacity: 0.8;
        }

        .filter-chip .remove:hover {
            opacity: 1;
        }

        .pagination-custom {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination-custom .page-link {
            border: none;
            border-radius: 12px;
            margin: 0 0.2rem;
            padding: 0.8rem 1.2rem;
            color: #6c757d;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .pagination-custom .page-link:hover,
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        /* Estilos para el modal mejorado - RESPONSIVE */
        .delete-modal {
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, 0.5);
            z-index: 1060;
            /* Asegurar que esté por encima de otros elementos */
        }

        .delete-modal .modal-dialog {
            margin: 1rem;
            max-width: 90vw;
            /* Máximo 90% del ancho de viewport */
            width: 100%;
        }

        @media (min-width: 576px) {
            .delete-modal .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }
        }

        @media (min-width: 768px) {
            .delete-modal .modal-dialog {
                max-width: 600px;
            }
        }

        @media (min-width: 992px) {
            .delete-modal .modal-dialog {
                max-width: 700px;
            }
        }

        .delete-modal-content {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 25px;
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-height: 90vh;
            /* Máximo 90% de la altura del viewport */
            display: flex;
            flex-direction: column;
        }

        .delete-modal-header {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 1.5rem;
            text-align: center;
            flex-shrink: 0;
            /* No se encoge */
        }

        .delete-modal-header.warning {
            background: linear-gradient(135deg, #ffc107, #ff8f00);
        }

        .delete-modal-header.blocked {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        .delete-modal-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            animation: pulse 2s infinite;
        }

        .delete-modal-body {
            padding: 1.5rem;
            text-align: center;
            overflow-y: auto;
            /* Scroll si el contenido es muy largo */
            flex-grow: 1;
            /* Ocupa el espacio disponible */
        }

        .product-preview {
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            /* Permite que se envuelva en pantallas pequeñas */
        }

        .product-preview img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .product-preview-info {
            flex-grow: 1;
            min-width: 0;
            /* Permite que el texto se trunque si es necesario */
        }

        .product-preview-info h6 {
            margin: 0;
            font-weight: 700;
            color: #2c3e50;
            font-size: 0.9rem;
            word-break: break-word;
            /* Rompe palabras largas */
        }

        .product-preview-info small {
            color: #6c757d;
            font-size: 0.75rem;
        }

        .sales-info {
            background: linear-gradient(145deg, #fff3cd, #ffeaa7);
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem 0;
            border-left: 5px solid #ffc107;
        }

        .sales-info.blocked {
            background: linear-gradient(145deg, #f8d7da, #f5c6cb);
            border-left-color: #dc3545;
        }

        .sales-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .sales-stat {
            text-align: center;
            flex: 1;
            min-width: 80px;
        }

        .sales-stat-number {
            font-size: 1.2rem;
            font-weight: 700;
            color: #dc3545;
        }

        .sales-stat-label {
            font-size: 0.7rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .delete-modal-footer {
            padding: 1.5rem;
            border: none;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            flex-shrink: 0;
            /* No se encoge */
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-delete-confirm,
        .btn-delete-cancel {
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            flex: 1;
            min-width: 120px;
            max-width: 200px;
        }

        .btn-delete-confirm {
            background: linear-gradient(45deg, #dc3545, #c82333);
        }

        .btn-delete-confirm:hover {
            background: linear-gradient(45deg, #c82333, #a71e2a);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
        }

        .btn-delete-cancel {
            background: linear-gradient(45deg, #6c757d, #5a6268);
        }

        .btn-delete-cancel:hover {
            background: linear-gradient(45deg, #5a6268, #495057);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25px;
            z-index: 1000;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #dc3545;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Responsive específico para móviles */
        @media (max-width: 576px) {
            .delete-modal .modal-dialog {
                margin: 0.5rem;
                max-width: 95vw;
            }

            .delete-modal-content {
                border-radius: 20px;
                max-height: 95vh;
            }

            .delete-modal-header {
                padding: 1rem;
            }

            .delete-modal-icon {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
            }

            .delete-modal-body {
                padding: 1rem;
            }

            .delete-modal-footer {
                padding: 1rem;
                flex-direction: column;
            }

            .btn-delete-confirm,
            .btn-delete-cancel {
                width: 100%;
                max-width: none;
                margin-bottom: 0.5rem;
            }

            .product-preview {
                flex-direction: column;
                text-align: center;
                padding: 0.75rem;
            }

            .product-preview img {
                width: 50px;
                height: 50px;
            }

            .sales-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .sales-stat {
                min-width: auto;
            }

            .sales-info,
            .product-preview {
                margin: 0.75rem 0;
            }
        }

        /* Para pantallas muy pequeñas */
        @media (max-width: 400px) {
            .delete-modal .modal-dialog {
                margin: 0.25rem;
                max-width: 98vw;
            }

            .delete-modal-content {
                border-radius: 15px;
                max-height: 98vh;
            }

            .delete-modal-header,
            .delete-modal-body,
            .delete-modal-footer {
                padding: 0.75rem;
            }

            .delete-modal-icon {
                font-size: 2rem;
            }

            .product-preview-info h6 {
                font-size: 0.8rem;
            }

            .sales-stat-number {
                font-size: 1rem;
            }

            .sales-stat-label {
                font-size: 0.6rem;
            }
        }

        /* Asegurar que el modal esté siempre visible */
        .modal.show {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        /* Scroll suave para el contenido del modal */
        .delete-modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .delete-modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .delete-modal-body::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .delete-modal-body::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @media (max-width: 768px) {
            .hero-header {
                padding: 2rem 0;
            }

            .product-image-container {
                height: 200px;
            }

            .filter-card .card-body {
                padding: 1.5rem;
            }

            .product-info {
                padding: 1rem;
            }

            .product-actions {
                flex-direction: column;
            }

            .delete-modal-header,
            .delete-modal-body,
            .delete-modal-footer {
                padding: 1.5rem;
            }

            .product-preview {
                flex-direction: column;
                text-align: center;
            }

            .sales-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('content')
<<<<<<< HEAD
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold">
                    <i class="bi bi-tag"></i> Catálogo de Productos
                </h2>
                <p class="text-muted">Administra todos los productos de tu tienda de ropa</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('productos.create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle"></i> Nuevo Producto
                </a>
=======
    <!-- Hero Header -->
    <div class="hero-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-store me-3"></i>
                        Catálogo de Productos
                    </h1>
                    <p class="lead mb-0">
                        Descubre nuestra colección completa de productos de moda
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('productos.create') }}" class="btn btn-light btn-lg px-4 py-3">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nuevo Producto
                    </a>
                </div>
>>>>>>> 2350b95 (código 7)
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Alertas -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert"
                style="border-radius: 15px;">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert"
                style="border-radius: 15px;">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filtros Avanzados -->
        <div class="card filter-card">
            <div class="card-body">
                <form action="{{ route('productos.index') }}" method="GET" id="filterForm">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <label for="search" class="form-label fw-semibold">
                                <i class="fas fa-search me-2"></i>Buscar Productos
                            </label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-lg" id="search" name="search"
                                    value="{{ request('search') }}" placeholder="Nombre, SKU, descripción..."
                                    style="border-radius: 12px; padding-left: 3rem;">
                                <i class="fas fa-search position-absolute"
                                    style="left: 1rem; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <label for="categoria" class="form-label fw-semibold">
                                <i class="fas fa-layer-group me-2"></i>Categoría
                            </label>
                            <select class="form-select form-select-lg" id="categoria" name="categoria"
                                style="border-radius: 12px;">
                                <option value="">Todas las categorías</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <label for="marca" class="form-label fw-semibold">
                                <i class="fas fa-award me-2"></i>Marca
                            </label>
                            <select class="form-select form-select-lg" id="marca" name="marca"
                                style="border-radius: 12px;">
                                <option value="">Todas las marcas</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}"
                                        {{ request('marca') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <label for="genero" class="form-label fw-semibold">
                                <i class="fas fa-venus-mars me-2"></i>Género
                            </label>
                            <select class="form-select form-select-lg" id="genero" name="genero"
                                style="border-radius: 12px;">
                                <option value="">Todos</option>
                                <option value="hombre" {{ request('genero') == 'hombre' ? 'selected' : '' }}>Hombre
                                </option>
                                <option value="mujer" {{ request('genero') == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                <option value="unisex" {{ request('genero') == 'unisex' ? 'selected' : '' }}>Unisex
                                </option>
                                <option value="niño" {{ request('genero') == 'niño' ? 'selected' : '' }}>Niño</option>
                                <option value="niña" {{ request('genero') == 'niña' ? 'selected' : '' }}>Niña</option>
                            </select>
                        </div>
<<<<<<< HEAD
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-danger me-2">
                                <i class="bi bi-funnel"></i> Filtrar
                            </button>
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
=======

                        <div class="col-lg-2 d-flex align-items-end">
                            <div class="d-flex gap-2 w-100">
                                <button type="submit" class="btn btn-primary-custom btn-lg flex-fill"
                                    style="border-radius: 12px;">
                                    <i class="fas fa-filter me-2"></i>Filtrar
                                </button>
                                <a href="{{ route('productos.index') }}" class="btn btn-outline-custom btn-lg"
                                    style="border-radius: 12px;" title="Limpiar filtros">
                                    <i class="fas fa-undo"></i>
                                </a>
                            </div>
>>>>>>> 2350b95 (código 7)
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filtros Activos -->
        @if (request()->hasAny(['search', 'categoria', 'marca', 'genero']))
            <div class="mb-4">
                <h6 class="fw-semibold mb-3">Filtros activos:</h6>
                <div class="d-flex flex-wrap">
                    @if (request('search'))
                        <span class="filter-chip">
                            <i class="fas fa-search me-2"></i>
                            "{{ request('search') }}"
                            <span class="remove" onclick="removeFilter('search')">&times;</span>
                        </span>
                    @endif
                    @if (request('categoria'))
                        <span class="filter-chip">
                            <i class="fas fa-layer-group me-2"></i>
                            {{ $categorias->find(request('categoria'))->nombre ?? 'Categoría' }}
                            <span class="remove" onclick="removeFilter('categoria')">&times;</span>
                        </span>
                    @endif
                    @if (request('marca'))
                        <span class="filter-chip">
                            <i class="fas fa-award me-2"></i>
                            {{ $marcas->find(request('marca'))->nombre ?? 'Marca' }}
                            <span class="remove" onclick="removeFilter('marca')">&times;</span>
                        </span>
                    @endif
                    @if (request('genero'))
                        <span class="filter-chip">
                            <i class="fas fa-venus-mars me-2"></i>
                            {{ ucfirst(request('genero')) }}
                            <span class="remove" onclick="removeFilter('genero')">&times;</span>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <!-- Toggle de Vista y Estadísticas -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="view-toggle">
                <button class="btn active" id="gridView" onclick="toggleView('grid')">
                    <i class="fas fa-th-large me-2"></i>Cuadrícula
                </button>
                <button class="btn" id="listView" onclick="toggleView('list')">
                    <i class="fas fa-list me-2"></i>Lista
                </button>
            </div>

            <div class="text-muted">
                <i class="fas fa-info-circle me-2"></i>
                Mostrando {{ $productos->count() }} de {{ $productos->total() }} productos
            </div>
        </div>

        <!-- Grid de Productos -->
        <div id="productsGrid" class="row g-4">
            @forelse ($productos as $producto)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 fade-in">
                    <div class="product-card">
                        <!-- Imagen del Producto -->
                        <div class="product-image-container">
                            @if ($producto->imagen_principal)
                                <img src="{{ asset('storage/' . $producto->imagen_principal) }}"
                                    alt="{{ $producto->nombre }}" class="product-image" loading="lazy">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif

                            <!-- Overlay con acciones rápidas -->
                            <div class="product-overlay">
                                <div class="d-flex gap-2 w-100">
                                    <a href="{{ route('productos.show', $producto->id) }}"
                                        class="btn btn-light btn-sm flex-fill">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </a>
                                    <a href="{{ route('productos.edit', $producto->id) }}"
                                        class="btn btn-primary btn-sm flex-fill">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                </div>
                            </div>

                            <!-- Badges -->
                            <div class="product-badges">
                                @if ($producto->es_destacado)
                                    <span class="product-badge badge-destacado">
                                        <i class="fas fa-star me-1"></i>Destacado
                                    </span>
                                @endif
                                @if ($producto->es_nuevo)
                                    <span class="product-badge badge-nuevo">
                                        <i class="fas fa-sparkles me-1"></i>Nuevo
                                    </span>
                                @endif
                                @if ($producto->precio_descuento)
                                    <span class="product-badge badge-promocion">
                                        <i class="fas fa-percentage me-1"></i>Oferta
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Información del Producto -->
                        <div class="product-info">
                            <h5 class="product-title">{{ $producto->nombre }}</h5>
                            <div class="product-sku">SKU: {{ $producto->sku }}</div>

                            <div class="product-meta">
                                <span>
                                    <i class="fas fa-layer-group me-1"></i>
                                    {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                </span>
                                <span>
                                    <i class="fas fa-award me-1"></i>
                                    {{ $producto->marca->nombre ?? 'Sin marca' }}
                                </span>
                            </div>

                            <div class="product-price">
                                @if ($producto->precio_descuento)
                                    <span
                                        class="price-current">${{ number_format($producto->precio_descuento, 2) }}</span>
                                    <span class="price-original">${{ number_format($producto->precio, 2) }}</span>
                                @else
                                    <span class="price-current">${{ number_format($producto->precio, 2) }}</span>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <small class="text-muted">Stock:</small>
                                    @php
                                        $stockClass = 'stock-out';
                                        $stockText = 'Agotado';
                                        if ($producto->stock > 20) {
                                            $stockClass = 'stock-high';
                                            $stockText = 'Disponible';
                                        } elseif ($producto->stock > 5) {
                                            $stockClass = 'stock-medium';
                                            $stockText = 'Pocas unidades';
                                        } elseif ($producto->stock > 0) {
                                            $stockClass = 'stock-low';
                                            $stockText = 'Últimas unidades';
                                        }
                                    @endphp
                                    <span class="stock-indicator {{ $stockClass }}">
                                        {{ $producto->stock }} - {{ $stockText }}
                                    </span>
                                </div>
                                <div class="text-muted small">
                                    <i class="fas fa-ruler me-1"></i>{{ $producto->talla }}
                                </div>
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('productos.edit', $producto->id) }}"
                                    class="btn btn-primary-custom btn-action">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                                <button type="button" class="btn btn-outline-custom btn-action delete-btn"
                                    data-product-id="{{ $producto->id }}" data-product-name="{{ $producto->nombre }}"
                                    data-product-sku="{{ $producto->sku }}"
                                    data-product-image="{{ $producto->imagen_principal ? asset('storage/' . $producto->imagen_principal) : asset('img/default-product.png') }}"
                                    data-product-price="{{ number_format($producto->precio, 2) }}">
                                    <i class="fas fa-trash me-1"></i>Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3 class="fw-bold text-muted mb-3">No se encontraron productos</h3>
                        <p class="text-muted mb-4">
                            @if (request()->hasAny(['search', 'categoria', 'marca', 'genero']))
                                No hay productos que coincidan con los filtros seleccionados.
                            @else
                                Aún no tienes productos en tu catálogo.
                            @endif
                        </p>
                        <div class="d-flex gap-3 justify-content-center">
                            @if (request()->hasAny(['search', 'categoria', 'marca', 'genero']))
                                <a href="{{ route('productos.index') }}" class="btn btn-outline-custom btn-lg">
                                    <i class="fas fa-undo me-2"></i>Limpiar Filtros
                                </a>
                            @endif
                            <a href="{{ route('productos.create') }}" class="btn btn-primary-custom btn-lg">
                                <i class="fas fa-plus-circle me-2"></i>Crear Primer Producto
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if ($productos->hasPages())
            <div class="pagination-custom">
                {{ $productos->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>

    <!-- Modal de Confirmación de Eliminación Mejorado -->
    <div class="modal fade delete-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content delete-modal-content position-relative">
                <!-- Loading Overlay -->
                <div class="loading-overlay d-none" id="loadingOverlay">
                    <div class="text-center">
                        <div class="loading-spinner mb-3"></div>
                        <p class="mb-0 fw-semibold">Verificando información...</p>
                    </div>
                </div>

                <!-- Modal Header -->
                <div class="modal-header delete-modal-header" id="modalHeader">
                    <div class="w-100">
                        <div class="delete-modal-icon" id="modalIcon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h4 class="modal-title fw-bold mb-0" id="modalTitle">
                            Confirmar Eliminación
                        </h4>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="modal-body delete-modal-body">
                    <!-- Vista previa del producto -->
                    <div class="product-preview" id="productPreview">
                        <img src="/placeholder.svg" alt="Producto" id="productImage">
                        <div class="product-preview-info">
                            <h6 id="productName"></h6>
                            <small class="d-block" id="productSku"></small>
                            <small class="text-success fw-semibold" id="productPrice"></small>
                        </div>
                    </div>

                    <!-- Mensaje principal -->
                    <div id="mainMessage">
                        <p class="mb-3" id="confirmMessage">
                            ¿Estás seguro de que deseas eliminar este producto?
                        </p>
                        <small class="text-muted" id="warningMessage">
                            Esta acción no se puede deshacer.
                        </small>
                    </div>

                    <!-- Información de ventas -->
                    <div class="sales-info d-none" id="salesInfo">
                        <div class="d-flex align-items-center mb-3 flex-wrap">
                            <i class="fas fa-chart-line fa-2x text-warning me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Información de Ventas</h6>
                                <small class="text-muted">Este producto tiene historial de ventas</small>
                            </div>
                        </div>

                        <div class="sales-stats">
                            <div class="sales-stat">
                                <div class="sales-stat-number" id="totalSales">0</div>
                                <div class="sales-stat-label">Ventas</div>
                            </div>
                            <div class="sales-stat">
                                <div class="sales-stat-number" id="totalRevenue">$0</div>
                                <div class="sales-stat-label">Ingresos</div>
                            </div>
                            <div class="sales-stat">
                                <div class="sales-stat-number" id="lastSaleDate">-</div>
                                <div class="sales-stat-label">Última</div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de bloqueo -->
                    <div class="sales-info blocked d-none" id="blockedInfo">
                        <div class="d-flex align-items-center mb-3 flex-wrap">
                            <i class="fas fa-ban fa-2x text-danger me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold text-danger">Eliminación Bloqueada</h6>
                                <small class="text-muted">Este producto no puede ser eliminado</small>
                            </div>
                        </div>
                        <p class="mb-0 small">
                            <strong>Motivo:</strong> <span id="blockReason"></span>
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer delete-modal-footer">
                    <button type="button" class="btn btn-delete-cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-delete-confirm d-none" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-2"></i>Eliminar
                    </button>
                    <button type="button" class="btn btn-delete-confirm" id="forceDeleteBtn" style="display: none;">
                        <i class="fas fa-exclamation-triangle me-2"></i>Forzar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables globales
            let currentProductId = null;
            let currentProductData = null;

            // Búsqueda en tiempo real
            const searchInput = document.getElementById('search');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (this.value.length >= 3 || this.value.length === 0) {
                        document.getElementById('filterForm').submit();
                    }
                }, 500);
            });

            // Auto-submit en cambio de filtros
            document.querySelectorAll('#categoria, #marca, #genero').forEach(select => {
                select.addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });
            });

            // Animación de entrada para las tarjetas
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            // Manejo de eliminación mejorado
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Obtener datos del producto
                    currentProductId = this.dataset.productId;
                    currentProductData = {
                        id: this.dataset.productId,
                        name: this.dataset.productName,
                        sku: this.dataset.productSku,
                        image: this.dataset.productImage,
                        price: this.dataset.productPrice
                    };

                    // Mostrar modal y verificar ventas
                    showDeleteModal();
                });
            });

            function showDeleteModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));

                // Mostrar loading
                showLoading();

                // Actualizar vista previa del producto
                updateProductPreview();

                // Mostrar modal
                modal.show();

                // Verificar ventas del producto
                checkProductSales();
            }

            function showLoading() {
                document.getElementById('loadingOverlay').classList.remove('d-none');
                document.getElementById('salesInfo').classList.add('d-none');
                document.getElementById('blockedInfo').classList.add('d-none');
                document.getElementById('confirmDeleteBtn').classList.add('d-none');
                document.getElementById('forceDeleteBtn').style.display = 'none';
            }

            function hideLoading() {
                document.getElementById('loadingOverlay').classList.add('d-none');
            }

            function updateProductPreview() {
                document.getElementById('productImage').src = currentProductData.image;
                document.getElementById('productName').textContent = currentProductData.name;
                document.getElementById('productSku').textContent = `SKU: ${currentProductData.sku}`;
                document.getElementById('productPrice').textContent = `$${currentProductData.price}`;
            }

            function checkProductSales() {
                // Simular verificación de ventas (aquí harías una petición AJAX real)
                setTimeout(() => {
                    // Simular datos de ventas (reemplaza con datos reales)
                    const salesData = {
                        hasSales: Math.random() > 0.5, // 50% probabilidad de tener ventas
                        totalSales: Math.floor(Math.random() * 50) + 1,
                        totalRevenue: (Math.random() * 5000 + 100).toFixed(2),
                        lastSaleDate: '15/12/2024',
                        canDelete: Math.random() > 0.3 // 70% probabilidad de poder eliminar
                    };

                    hideLoading();
                    updateModalContent(salesData);
                }, 1500);
            }

            function updateModalContent(salesData) {
                const modalHeader = document.getElementById('modalHeader');
                const modalIcon = document.getElementById('modalIcon');
                const modalTitle = document.getElementById('modalTitle');
                const confirmMessage = document.getElementById('confirmMessage');
                const warningMessage = document.getElementById('warningMessage');
                const salesInfo = document.getElementById('salesInfo');
                const blockedInfo = document.getElementById('blockedInfo');
                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                const forceDeleteBtn = document.getElementById('forceDeleteBtn');

                if (!salesData.hasSales) {
                    // Producto sin ventas - eliminación normal
                    modalHeader.className = 'modal-header delete-modal-header';
                    modalIcon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
                    modalTitle.textContent = 'Confirmar Eliminación';
                    confirmMessage.textContent = '¿Estás seguro de que deseas eliminar este producto?';
                    warningMessage.textContent = 'Esta acción no se puede deshacer.';
                    confirmDeleteBtn.classList.remove('d-none');

                } else if (salesData.canDelete) {
                    // Producto con ventas pero se puede eliminar
                    modalHeader.className = 'modal-header delete-modal-header warning';
                    modalIcon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
                    modalTitle.textContent = 'Producto con Historial de Ventas';
                    confirmMessage.textContent = 'Este producto tiene ventas registradas. ¿Deseas continuar?';
                    warningMessage.textContent =
                        'El historial de ventas se mantendrá, pero el producto será eliminado.';

                    // Mostrar información de ventas
                    salesInfo.classList.remove('d-none');
                    document.getElementById('totalSales').textContent = salesData.totalSales;
                    document.getElementById('totalRevenue').textContent = `$${salesData.totalRevenue}`;
                    document.getElementById('lastSaleDate').textContent = salesData.lastSaleDate;

                    forceDeleteBtn.style.display = 'inline-block';

                } else {
                    // Producto bloqueado para eliminación
                    modalHeader.className = 'modal-header delete-modal-header blocked';
                    modalIcon.innerHTML = '<i class="fas fa-ban"></i>';
                    modalTitle.textContent = 'Eliminación Bloqueada';
                    confirmMessage.textContent = 'Este producto no puede ser eliminado en este momento.';
                    warningMessage.textContent = 'Contacta al administrador si necesitas eliminar este producto.';

                    // Mostrar información de bloqueo
                    blockedInfo.classList.remove('d-none');
                    document.getElementById('blockReason').textContent =
                        'Producto con ventas recientes y stock crítico';
                }
            }

            // Confirmar eliminación
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                performDelete(false);
            });

            document.getElementById('forceDeleteBtn').addEventListener('click', function() {
                performDelete(true);
            });

            function performDelete(force = false) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('productos.index') }}/${currentProductId}`;

                // CSRF Token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Method DELETE
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Force delete flag
                if (force) {
                    const forceInput = document.createElement('input');
                    forceInput.type = 'hidden';
                    forceInput.name = 'force';
                    forceInput.value = '1';
                    form.appendChild(forceInput);
                }

                document.body.appendChild(form);

                // Mostrar loading en el botón
                const activeBtn = force ? document.getElementById('forceDeleteBtn') : document.getElementById(
                    'confirmDeleteBtn');
                const originalText = activeBtn.innerHTML;
                activeBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Eliminando...';
                activeBtn.disabled = true;

                // Enviar formulario
                setTimeout(() => {
                    form.submit();
                }, 1000);
            }
        });

        function toggleView(view) {
            const gridBtn = document.getElementById('gridView');
            const listBtn = document.getElementById('listView');
            const productsGrid = document.getElementById('productsGrid');

            if (view === 'grid') {
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
                productsGrid.className = 'row g-4';
                productsGrid.querySelectorAll('.col-xl-3').forEach(col => {
                    col.className = 'col-xl-3 col-lg-4 col-md-6 col-sm-6 fade-in';
                });
            } else {
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
                productsGrid.className = 'row g-3';
                productsGrid.querySelectorAll('.col-xl-3').forEach(col => {
                    col.className = 'col-12 fade-in';
                });
            }

            localStorage.setItem('productView', view);
        }

        function removeFilter(filterName) {
            const url = new URL(window.location);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        }

        // Restaurar vista preferida
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('productView');
            if (savedView) {
                toggleView(savedView);
            }
        });

        // Lazy loading para imágenes
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('loading-skeleton');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                img.classList.add('loading-skeleton');
                imageObserver.observe(img);
            });
        }
    </script>
@endpush

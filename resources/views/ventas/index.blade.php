@extends('layouts.app')

@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 30px 30px;
        }

        .stats-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-color);
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stats-card.primary {
            --card-color: linear-gradient(45deg, #667eea, #764ba2);
        }

        .stats-card.success {
            --card-color: linear-gradient(45deg, #56ab2f, #a8e6cf);
        }

        .stats-card.info {
            --card-color: linear-gradient(45deg, #4facfe, #00f2fe);
        }

        .stats-card.warning {
            --card-color: linear-gradient(45deg, #ffd89b, #19547b);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stats-icon.primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .stats-icon.success {
            background: linear-gradient(45deg, #56ab2f, #a8e6cf);
        }

        .stats-icon.info {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
        }

        .stats-icon.warning {
            background: linear-gradient(45deg, #ffd89b, #19547b);
        }

        .stats-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .btn-new-sale {
            background: linear-gradient(45deg, #56ab2f, #a8e6cf);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(86, 171, 47, 0.3);
        }

        .btn-new-sale:hover {
            background: linear-gradient(45deg, #4a9428, #96d9b8);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(86, 171, 47, 0.4);
            color: white;
        }

        .sales-table-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white;
            border: none;
            padding: 1.5rem 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .table-modern tbody tr {
            border: none;
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table-modern tbody td {
            padding: 1.5rem 1rem;
            border: none;
            vertical-align: middle;
        }

        .sale-id {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: #667eea;
            background: #f8f9ff;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .client-info {
            font-weight: 600;
            color: #2c3e50;
        }

        .client-name {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 0.2rem;
        }

        .products-dropdown {
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .products-dropdown:hover {
            border-color: #667eea;
            background: linear-gradient(45deg, #ffffff, #f8f9ff);
        }

        .products-list {
            max-height: 300px;
            overflow-y: auto;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-item {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #f1f3f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .product-item:hover {
            background: #f8f9ff;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .quantity-badge {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .amount-display {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .amount-positive {
            color: #28a745;
        }

        .amount-negative {
            color: #dc3545;
        }

        .amount-total {
            color: #2c3e50;
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-voucher {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
        }

        .btn-voucher:hover {
            background: linear-gradient(45deg, #3d8bfe, #00d4fe);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
        }

        .btn-edit {
            background: linear-gradient(45deg, #ffd89b, #19547b);
            color: white;
        }

        .btn-edit:hover {
            background: linear-gradient(45deg, #ffcd7a, #164a6b);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 216, 155, 0.3);
        }

        .btn-delete {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
        }

        .btn-delete:hover {
            background: linear-gradient(45deg, #ff5252, #e53935);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #e9ecef;
            margin-bottom: 1rem;
        }

        .pagination-custom {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
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

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .filter-chip {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .date-range-picker {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }

        .date-range-picker:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }

            .stats-card {
                margin-bottom: 1rem;
            }

            .search-section {
                padding: 1.5rem;
            }

            .table-responsive {
                border-radius: 20px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 35px;
                height: 35px;
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

        .slide-in {
            animation: slideIn 0.8s ease forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
@endpush

@section('content')
<<<<<<< HEAD
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-4">Lista de Ventas</h1>
            
            <!-- Filtros y búsqueda -->
            <div class="d-flex">
                <input type="text" id="searchInput" class="form-danger me-2" placeholder="Buscar ventas..." style="width: 250px;">
                <a href="{{ route('ventas.create') }}" class="btn btn-danger btn-lg">
                    <i class="bi bi-plus-circle"></i> Nueva Venta
                </a>
=======
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-chart-line me-3"></i>
                        Gestión de Ventas
                    </h1>
                    <p class="lead mb-0">
                        Administra y controla todas las transacciones de tu negocio
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('ventas.create') }}" class="btn btn-new-sale btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nueva Venta
                    </a>
                </div>
>>>>>>> 2350b95 (código 7)
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Alertas -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm fade-in" role="alert"
                style="border-radius: 15px;">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Estadísticas -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card primary fade-in">
                    <div class="stats-icon primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stats-value">{{ $ventasHoy->count() }}</div>
                    <div class="stats-label">Ventas Hoy</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-calendar-day me-1"></i>
                            {{ now()->format('d/m/Y') }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card success fade-in" style="animation-delay: 0.1s;">
                    <div class="stats-icon success">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stats-value">S/. {{ number_format($ventasHoy->sum('total'), 2) }}</div>
                    <div class="stats-label">Ingresos Hoy</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-arrow-up me-1"></i>
                            Efectivo del día
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card info fade-in" style="animation-delay: 0.2s;">
                    <div class="stats-icon info">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="stats-value">{{ $ventasMes->count() }}</div>
                    <div class="stats-label">Ventas del Mes</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ now()->format('F Y') }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stats-card warning fade-in" style="animation-delay: 0.3s;">
                    <div class="stats-icon warning">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stats-value">S/. {{ number_format($ventasMes->sum('total'), 2) }}</div>
                    <div class="stats-label">Total del Mes</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-trending-up me-1"></i>
                            Acumulado mensual
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Búsqueda y Filtros -->
        <div class="search-section slide-in">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control search-input"
                            placeholder="Buscar por ID, cliente, productos...">
                    </div>
                </div>
                <div class="col-lg-3">
                    <input type="date" id="dateFilter" class="form-control date-range-picker" title="Filtrar por fecha">
                </div>
                <div class="col-lg-3">
                    <select id="statusFilter" class="form-select date-range-picker">
                        <option value="">Todos los estados</option>
                        <option value="completed">Completadas</option>
                        <option value="pending">Pendientes</option>
                        <option value="cancelled">Canceladas</option>
                    </select>
                </div>
            </div>

            <!-- Filtros Activos -->
            <div class="filter-chips mt-3" id="activeFilters" style="display: none;">
                <span class="text-muted me-2">Filtros activos:</span>
            </div>
        </div>

        <!-- Tabla de Ventas -->
        <div class="sales-table-container slide-in" style="animation-delay: 0.2s;">
            <div class="table-responsive">
                <table class="table table-modern" id="ventasTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th><i class="fas fa-calendar me-2"></i>Fecha</th>
                            <th><i class="fas fa-user me-2"></i>Cliente</th>
                            <th><i class="fas fa-box me-2"></i>Productos</th>
                            <th><i class="fas fa-sort-numeric-up me-2"></i>Cantidad</th>
                            <th><i class="fas fa-calculator me-2"></i>Subtotal</th>
                            <th><i class="fas fa-percentage me-2"></i>Descuentos</th>
                            <th><i class="fas fa-money-bill-wave me-2"></i>Total</th>
                            <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ventas as $venta)
                            @php
                                $totalDescuentos = 0;
                                $subtotal = 0;
                                $cantidadTotal = 0;

                                foreach ($venta->productos as $producto) {
                                    $precioOriginal = $producto->pivot->precio_unitario;
                                    $precioFinal =
                                        $producto->precio_descuento && $producto->precio_descuento < $precioOriginal
                                            ? $producto->precio_descuento
                                            : $precioOriginal;

                                    $totalDescuentos += ($precioOriginal - $precioFinal) * $producto->pivot->cantidad;
                                    $subtotal += $precioFinal * $producto->pivot->cantidad;
                                    $cantidadTotal += $producto->pivot->cantidad;
                                }
                            @endphp
                            <tr class="sale-row">
                                <td>
                                    <span class="sale-id">#{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $venta->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $venta->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="client-info">{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}
                                    </div>
                                    <div class="client-name">
                                        <i class="fas fa-user-circle me-1"></i>Cliente
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn products-dropdown dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="fas fa-box me-2"></i>
                                            {{ $venta->productos->count() }} productos
                                        </button>
                                        <ul class="dropdown-menu products-list">
                                            @foreach ($venta->productos as $producto)
                                                <li class="product-item">
                                                    <div>
                                                        <div class="fw-semibold">{{ $producto->nombre }}</div>
                                                        <small class="text-muted">{{ $producto->sku }}</small>
                                                    </div>
                                                    <span class="quantity-badge">{{ $producto->pivot->cantidad }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill fs-6">{{ $cantidadTotal }}</span>
                                </td>
                                <td>
                                    <span class="amount-display amount-positive">
                                        S/. {{ number_format($subtotal + $totalDescuentos, 2) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($totalDescuentos > 0)
                                        <span class="amount-display amount-negative">
                                            -S/. {{ number_format($totalDescuentos, 2) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="amount-display amount-total">
                                        S/. {{ number_format($subtotal, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('ventas.voucher', $venta->id) }}"
                                            class="btn btn-action btn-voucher" title="Ver Voucher"
                                            data-bs-toggle="tooltip">
                                            <i class="fas fa-receipt"></i>
                                        </a>
                                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-action btn-edit"
                                            title="Editar Venta" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-action btn-delete" title="Eliminar Venta"
                                            data-bs-toggle="tooltip"
                                            onclick="confirmDelete({{ $venta->id }}, '{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                        <h4 class="fw-bold mb-3">No hay ventas registradas</h4>
                                        <p class="mb-4">Comienza registrando tu primera venta</p>
                                        <a href="{{ route('ventas.create') }}" class="btn btn-new-sale">
                                            <i class="fas fa-plus-circle me-2"></i>
                                            Crear Primera Venta
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        @if ($ventas->hasPages())
            <div class="pagination-custom">
                {{ $ventas->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="mb-2">¿Estás seguro de que deseas eliminar la venta de:</p>
                    <p class="fw-bold text-primary mb-2" id="clientName"></p>
                    <small class="text-muted">Esta acción no se puede deshacer y afectará el inventario.</small>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Eliminar Venta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Búsqueda en tiempo real
            const searchInput = document.getElementById('searchInput');
            const dateFilter = document.getElementById('dateFilter');
            const statusFilter = document.getElementById('statusFilter');
            const activeFilters = document.getElementById('activeFilters');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();
                const dateValue = dateFilter.value;
                const statusValue = statusFilter.value;
                const rows = document.querySelectorAll('#ventasTable tbody .sale-row');

                let hasActiveFilters = false;
                let filtersHtml = '<span class="text-muted me-2">Filtros activos:</span>';

                rows.forEach(row => {
                    let showRow = true;
                    const text = row.textContent.toLowerCase();

                    // Filtro de búsqueda
                    if (searchTerm && !text.includes(searchTerm)) {
                        showRow = false;
                    }

                    // Filtro de fecha
                    if (dateValue) {
                        const rowDate = row.querySelector('td:nth-child(2) .fw-semibold').textContent;
                        const formattedDate = dateValue.split('-').reverse().join('/');
                        if (!rowDate.includes(formattedDate)) {
                            showRow = false;
                        }
                    }

                    row.style.display = showRow ? '' : 'none';
                });

                // Mostrar filtros activos
                if (searchTerm) {
                    filtersHtml +=
                        `<span class="filter-chip">Búsqueda: "${searchTerm}" <span onclick="clearSearch()" class="ms-2" style="cursor: pointer;">&times;</span></span>`;
                    hasActiveFilters = true;
                }

                if (dateValue) {
                    filtersHtml +=
                        `<span class="filter-chip">Fecha: ${dateValue} <span onclick="clearDateFilter()" class="ms-2" style="cursor: pointer;">&times;</span></span>`;
                    hasActiveFilters = true;
                }

                activeFilters.style.display = hasActiveFilters ? 'block' : 'none';
                activeFilters.innerHTML = filtersHtml;
            }

            searchInput.addEventListener('input', performSearch);
            dateFilter.addEventListener('change', performSearch);
            statusFilter.addEventListener('change', performSearch);

            // Animaciones de entrada
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

            document.querySelectorAll('.sale-row').forEach(row => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                row.style.transition = 'all 0.6s ease';
                observer.observe(row);
            });
        });

        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchInput').dispatchEvent(new Event('input'));
        }

        function clearDateFilter() {
            document.getElementById('dateFilter').value = '';
            document.getElementById('dateFilter').dispatchEvent(new Event('change'));
        }

        function confirmDelete(saleId, clientName) {
            document.getElementById('clientName').textContent = clientName;
            document.getElementById('deleteForm').action = `/ventas/${saleId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Efecto de hover mejorado para las filas
        document.querySelectorAll('.sale-row').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.zIndex = '10';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.zIndex = '1';
            });
        });
    </script>
@endpush

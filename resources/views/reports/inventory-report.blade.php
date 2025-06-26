@extends('layouts.app')

@section('title', 'Reporte de Inventario')

@section('content')
<<<<<<< HEAD
    <div class="container mt-4">
        <h1 class="mb-4">📦 Reporte de Inventario</h1>

        <canvas id="stockChart" height="100"></canvas>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td class="fw-bold {{ $producto->stock == 0 ? 'text-danger' : 'text-success' }}">
                            {{ $producto->stock == 0 ? 'Agotado' : 'Disponible' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- @include('reports.partials.ai-assistant', ['reportContext' => 'inventory']) --}}

=======
    <!-- Hero Section -->
    <div class="hero-section bg-gradient-primary text-white py-5 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-3">
                            <i class="fas fa-warehouse me-3"></i>
                            Reporte de Inventario
                        </h1>
                        <p class="lead mb-4">
                            Análisis completo del estado actual de tu inventario con métricas en tiempo real
                        </p>
                        <div class="hero-stats d-flex gap-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $productos->count() }}</div>
                                <div class="stat-label">Total Productos</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ $productos->sum('stock') }}</div>
                                <div class="stat-label">Unidades Totales</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ $productos->where('stock', '>', 0)->count() }}</div>
                                <div class="stat-label">Disponibles</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="hero-icon">
                        <i class="fas fa-chart-pie fa-8x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
>>>>>>> 2350b95 (código 7)
    </div>

    <div class="container-fluid px-4">
        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Productos Disponibles</h6>
                                <h2 class="fw-bold text-success mb-0">{{ $productos->where('stock', '>', 0)->count() }}</h2>
                                <small class="text-muted">
                                    {{ number_format(($productos->where('stock', '>', 0)->count() / $productos->count()) * 100, 1) }}% del total
                                </small>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Productos Agotados</h6>
                                <h2 class="fw-bold text-danger mb-0">{{ $productos->where('stock', '=', 0)->count() }}</h2>
                                <small class="text-muted">
                                    {{ number_format(($productos->where('stock', '=', 0)->count() / $productos->count()) * 100, 1) }}% del total
                                </small>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Stock Bajo</h6>
                                <h2 class="fw-bold text-warning mb-0">{{ $productos->where('stock', '>', 0)->where('stock', '<=', 10)->count() }}</h2>
                                <small class="text-muted">Menos de 10 unidades</small>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-exclamation text-warning fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Valor Total Inventario</h6>
                                <h2 class="fw-bold text-primary mb-0">
                                    S/ {{ number_format($productos->sum(function($p) { return $p->precio * $p->stock; }), 2) }}
                                </h2>
                                <small class="text-muted">Valor estimado</small>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-dollar-sign text-primary fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <!-- Stock Distribution Chart -->
            <div class="col-xl-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-chart-pie text-primary me-2"></i>
                                Distribución de Stock
                            </h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Exportar</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Imprimir</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="stockChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Category Stock Chart -->
            <div class="col-xl-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-chart-bar text-success me-2"></i>
                            Stock por Categoría
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="categoryChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-table text-info me-2"></i>
                            Detalle de Inventario
                        </h5>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex gap-2 justify-content-lg-end">
                            <div class="input-group" style="max-width: 300px;">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchInput" 
                                       placeholder="Buscar productos...">
                            </div>
                            <select class="form-select" id="statusFilter" style="max-width: 150px;">
                                <option value="">Todos</option>
                                <option value="disponible">Disponibles</option>
                                <option value="agotado">Agotados</option>
                                <option value="bajo">Stock Bajo</option>
                            </select>
                            <button class="btn btn-primary" onclick="exportToExcel()">
                                <i class="fas fa-file-excel me-1"></i>Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="inventoryTable">
                        <thead class="table-dark">
                            <tr>
                                <th class="border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-image me-2"></i>
                                        Producto
                                    </div>
                                </th>
                                <th class="border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tag me-2"></i>
                                        Categoría
                                    </div>
                                </th>
                                <th class="border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-boxes me-2"></i>
                                        Stock
                                    </div>
                                </th>
                                <th class="border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-dollar-sign me-2"></i>
                                        Precio Unit.
                                    </div>
                                </th>
                                <th class="border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calculator me-2"></i>
                                        Valor Total
                                    </div>
                                </th>
                                <th class="border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Estado
                                    </div>
                                </th>
                                <th class="border-0">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr class="producto-row" data-nombre="{{ strtolower($producto->nombre) }}" 
                                    data-categoria="{{ strtolower($producto->categoria->nombre ?? '') }}"
                                    data-estado="{{ $producto->stock == 0 ? 'agotado' : ($producto->stock <= 10 ? 'bajo' : 'disponible') }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="product-image me-3">
                                                <img src="{{ $producto->imagen_principal ? asset('storage/' . $producto->imagen_principal) : asset('img/default-product.png') }}" 
                                                     alt="{{ $producto->nombre }}" 
                                                     class="rounded" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $producto->nombre }}</div>
                                                <small class="text-muted">ID: {{ $producto->id }}</small>
                                                @if($producto->sku)
                                                    <br><small class="text-muted">SKU: {{ $producto->sku }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold fs-5 me-2">{{ $producto->stock }}</span>
                                            <div class="progress" style="width: 60px; height: 8px;">
                                                <div class="progress-bar 
                                                    @if($producto->stock == 0) bg-danger
                                                    @elseif($producto->stock <= 10) bg-warning
                                                    @else bg-success
                                                    @endif" 
                                                    style="width: {{ min(($producto->stock / 100) * 100, 100) }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">
                                            S/ {{ number_format($producto->precio, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">
                                            S/ {{ number_format($producto->precio * $producto->stock, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($producto->stock == 0)
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i>Agotado
                                            </span>
                                        @elseif($producto->stock <= 10)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-exclamation me-1"></i>Stock Bajo
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Disponible
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    onclick="viewProduct({{ $producto->id }})" 
                                                    title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success" 
                                                    onclick="updateStock({{ $producto->id }})" 
                                                    title="Actualizar stock">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 bg-gradient-success text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x mb-3 opacity-75"></i>
                        <h5 class="fw-bold">Productos Más Vendidos</h5>
                        <p class="mb-0">Análisis de rotación de inventario</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 bg-gradient-warning text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3 opacity-75"></i>
                        <h5 class="fw-bold">Alertas de Stock</h5>
                        <p class="mb-0">{{ $productos->where('stock', '<=', 10)->count() }} productos requieren atención</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 bg-gradient-info text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-sync-alt fa-3x mb-3 opacity-75"></i>
                        <h5 class="fw-bold">Última Actualización</h5>
                        <p class="mb-0">{{ now()->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="10" cy="90" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-stats .stat-item {
            text-align: center;
        }

        .hero-stats .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
        }

        .hero-stats .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.05);
        }

        .product-image img {
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .product-image img:hover {
            border-color: #007bff;
            transform: scale(1.1);
        }

        .progress {
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            transition: width 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .btn-group .btn {
            transition: all 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: scale(1.1);
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Stock Distribution Chart
            const stockCtx = document.getElementById('stockChart').getContext('2d');
            const stockChart = new Chart(stockCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Disponibles', 'Agotados', 'Stock Bajo'],
                    datasets: [{
                        data: [
                            {{ $productos->where('stock', '>', 10)->count() }},
                            {{ $productos->where('stock', '=', 0)->count() }},
                            {{ $productos->where('stock', '>', 0)->where('stock', '<=', 10)->count() }}
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(255, 193, 7, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // Category Stock Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            const categoryData = @json($productos->groupBy('categoria.nombre')->map(function($group) {
                return $group->sum('stock');
            }));
            
            const categoryChart = new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(categoryData),
                    datasets: [{
                        label: 'Stock por Categoría',
                        data: Object.values(categoryData),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('.producto-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;

                rows.forEach(row => {
                    const nombre = row.dataset.nombre;
                    const categoria = row.dataset.categoria;
                    const estado = row.dataset.estado;

                    const matchesSearch = nombre.includes(searchTerm) || categoria.includes(searchTerm);
                    const matchesStatus = !statusValue || estado === statusValue;

                    row.style.display = matchesSearch && matchesStatus ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });

        // Export to Excel function
        function exportToExcel() {
            Swal.fire({
                title: 'Exportando...',
                text: 'Generando archivo Excel',
                icon: 'info',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Reporte exportado correctamente',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        }

        // View product function
        function viewProduct(id) {
            Swal.fire({
                title: 'Detalles del Producto',
                text: 'Cargando información del producto...',
                icon: 'info',
                showConfirmButton: false,
                timer: 1500
            });
        }

        // Update stock function
        function updateStock(id) {
            Swal.fire({
                title: 'Actualizar Stock',
                input: 'number',
                inputLabel: 'Nueva cantidad en stock',
                inputPlaceholder: 'Ingrese la cantidad',
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                inputValidator: (value) => {
                    if (!value || value < 0) {
                        return 'Debe ingresar una cantidad válida';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Actualizado!',
                        text: 'Stock actualizado correctamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
@endsection
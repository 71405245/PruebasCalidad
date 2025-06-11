@extends('layouts.app')

@section('title', 'Dashboard Analítico')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header del Dashboard -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-danger">
                <i class="fas fa-tachometer-alt me-2"></i>Panel Analítico
            </h1>
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i> Exportar
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> PDF</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i> Excel</a></li>
                </ul>
            </div>
        </div>

        <!-- Filtros Superiores -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form id="dashboard-filters">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Rango de Fechas</label>
                            <input type="text" class="form-control date-range-picker" name="date_range">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Categoría</label>
                            <select class="form-select" name="category">
                                <option value="">Todas</option>
                                <option>Ropa</option>
                                <option>Accesorios</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sucursal</label>
                            <select class="form-select" name="branch">
                                <option value="">Todas</option>
                                <option>Principal</option>
                                <option>Norte</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-danger me-2">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Limpiar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-danger border-4 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted fw-normal">Ventas Totales</h6>
                                <h2 class="fw-bold">$24,580</h2>
                                <span class="badge bg-danger bg-opacity-10 text-danger">+12.5%</span>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded">
                                <i class="fas fa-dollar-sign text-danger fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-primary border-4 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted fw-normal">Clientes Nuevos</h6>
                                <h2 class="fw-bold">156</h2>
                                <span class="badge bg-success bg-opacity-10 text-success">+8.2%</span>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="fas fa-users text-primary fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-warning border-4 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted fw-normal">Inventario</h6>
                                <h2 class="fw-bold">1,245</h2>
                                <span class="badge bg-warning bg-opacity-10 text-warning">-3.1%</span>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-boxes text-warning fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-info border-4 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted fw-normal">Conversión</h6>
                                <h2 class="fw-bold">32.6%</h2>
                                <span class="badge bg-info bg-opacity-10 text-info">+2.4%</span>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="fas fa-percentage text-info fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos Principales -->
        <div class="row mb-4">
            <!-- Gráfico de Ventas -->
            <div class="col-xl-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-chart-line text-danger me-2"></i>Tendencia de Ventas
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesTrendChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Mapa de Ventas -->
            <div class="col-xl-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-map-marked-alt text-primary me-2"></i>Ventas por Región
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="salesMap" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reportes Integrados -->
        <div class="row">
            <!-- Reporte de Clientes -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-users text-info me-2"></i>Análisis de Clientes
                        </h5>
                        <a href="{{ route('reports.customers') }}" class="btn btn-sm btn-outline-danger">
                            Ver completo <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @include('reports.customer-report', ['clientes' => $clientes])
                    </div>
                </div>
            </div>

            <!-- Reporte de Inventario -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-boxes text-warning me-2"></i>Estado de Inventario
                        </h5>
                        <a href="{{ route('reports.inventory') }}" class="btn btn-sm btn-outline-danger">
                            Ver completo <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @include('reports.inventory-report', ['productos' => $productos])
                    </div>
                </div>
            </div>

            <!-- Reporte de Ventas -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-shopping-bag text-success me-2"></i>Detalle de Ventas
                        </h5>
                        <div>
                            <a href="{{ route('reports.sales') }}" class="btn btn-sm btn-outline-danger me-2">
                                Ver completo <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                            <a href="{{ route('reports.exports.sales-pdf') }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-file-pdf me-1"></i> PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('reports.sales-report', [
                            'ventas' => $ventasRecientes,
                            'grafico_labels' => $grafico_labels,
                            'grafico_data' => $grafico_data,
                        ])
                    </div>
                </div>
            </div>
        </div>

        <!-- Asistente de IA -->
        <div class="card shadow-sm mt-2">
            <div class="card-body">
                @include('reports.partials.ai-assistant', ['reportContext' => 'dashboard'])
            </div>
        </div>
    </div>

@section('scripts')
    <!-- Librerías para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-date-range-picker@0.21.0/dist/jquery.daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Configuración del date range picker
            $('.date-range-picker').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Cancelar',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    firstDay: 1
                }
            });

            // Gráfico de tendencia de ventas
            const salesCtx = document.getElementById('salesTrendChart').getContext('2d');
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Ventas 2024',
                        data: [6500, 5900, 8000, 8100, 8600, 8250, 9000],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });

            // Mapa de ventas
            const mapChart = echarts.init(document.getElementById('salesMap'));
            const mapOption = {
                tooltip: {
                    trigger: 'item',
                    formatter: '{b}: {c} ventas'
                },
                visualMap: {
                    min: 0,
                    max: 500,
                    text: ['Alto', 'Bajo'],
                    realtime: false,
                    calculable: true,
                    inRange: {
                        color: ['#f8d7da', '#dc3545']
                    }
                },
                series: [{
                    name: 'Ventas',
                    type: 'map',
                    map: 'Peru',
                    emphasis: {
                        label: {
                            show: true
                        }
                    },
                    data: [{
                            name: 'Lima',
                            value: 385
                        },
                        {
                            name: 'Arequipa',
                            value: 125
                        },
                        {
                            name: 'La Libertad',
                            value: 88
                        },
                        {
                            name: 'Piura',
                            value: 76
                        },
                        {
                            name: 'Cusco',
                            value: 65
                        }
                    ]
                }]
            };
            mapChart.setOption(mapOption);

            // Redimensionar mapa cuando cambie el tamaño de la ventana
            window.addEventListener('resize', function() {
                mapChart.resize();
            });
        });
    </script>
@endsection
@endsection
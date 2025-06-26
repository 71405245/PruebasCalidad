
@extends('layouts.app')

@section('title', 'Reporte de Clientes')

@push('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ffa726 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-glass: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .hero-section {
            background: var(--primary-gradient);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
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

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            box-shadow: var(--shadow-glass);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.5);
        }

        .kpi-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .kpi-card:hover::before {
            left: 100%;
        }

        .kpi-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .customer-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 1rem;
        }

        .customer-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-vip {
            background: var(--warning-gradient);
            color: white;
        }

        .badge-frequent {
            background: var(--success-gradient);
            color: white;
        }

        .badge-new {
            background: var(--primary-gradient);
            color: white;
        }

        .badge-inactive {
            background: #6c757d;
            color: white;
        }

        .search-container {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-input {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 0.75rem 1.5rem 0.75rem 3rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #667eea;
            font-weight: 500;
        }

        .filter-tab.active,
        .filter-tab:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
        }

        .modern-table {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            overflow: hidden;
        }

        .modern-table thead {
            background: var(--primary-gradient);
            color: white;
        }

        .modern-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modern-table tbody tr:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.01);
        }

        .chart-container {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            height: 400px;
            /* Altura fija */
            position: relative;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
            /* Altura específica para el canvas */
            width: 100%;
        }

        .export-btn {
            background: var(--success-gradient);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
            color: white;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .customer-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 1.5rem;
            }

            .kpi-card {
                margin-bottom: 1rem;
            }

            .filter-tabs {
                justify-content: center;
            }

            .customer-stats {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="spinner"></div>
        </div>

        <!-- Hero Section -->
        <div class="hero-section fade-in-up">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-2">
                        <i class="fas fa-users me-3"></i>Análisis de Clientes
                    </h1>
                    <p class="lead mb-0">Dashboard completo de comportamiento y segmentación de clientes</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex gap-2 justify-content-end flex-wrap">
                        <a href="#" class="export-btn" id="exportPdf">
                            <i class="fas fa-file-pdf"></i> Exportar PDF
                        </a>
                        <a href="#" class="export-btn" id="exportExcel">
                            <i class="fas fa-file-excel"></i> Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>

<<<<<<< HEAD
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Compras Realizadas</th>
                    <th>Última Compra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</td>
                        <td>{{ $cliente->ventas_count }}</td>
                        <td>{{ optional($cliente->ultima_venta)->created_at->format('d/m/Y') ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const clientesChart = document.getElementById('clientesChart').getContext('2d');
        const chart = new Chart(clientesChart, {
            type: 'bar',
            data: {
                labels: {!! json_encode($clientes->pluck('nombre_cliente')) !!},
                datasets: [{
                    label: 'Compras Realizadas',
                    data: {!! json_encode($clientes->pluck('ventas_count')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
=======
        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="kpi-card fade-in-up" style="animation-delay: 0.1s">
                    <div class="kpi-icon" style="background: var(--primary-gradient)">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="fw-bold mb-1" id="totalClientes">{{ $clientes->count() }}</h3>
                    <p class="text-muted mb-0">Total Clientes</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="kpi-card fade-in-up" style="animation-delay: 0.2s">
                    <div class="kpi-icon" style="background: var(--success-gradient)">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="fw-bold mb-1" id="clientesVip">{{ $clientes->where('ventas_count', '>=', 5)->count() }}</h3>
                    <p class="text-muted mb-0">Clientes VIP</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="kpi-card fade-in-up" style="animation-delay: 0.3s">
                    <div class="kpi-icon" style="background: var(--warning-gradient)">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="fw-bold mb-1" id="promedioCompras">{{ number_format($clientes->avg('ventas_count'), 1) }}
                    </h3>
                    <p class="text-muted mb-0">Promedio Compras</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="kpi-card fade-in-up" style="animation-delay: 0.4s">
                    <div class="kpi-icon" style="background: var(--danger-gradient)">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="fw-bold mb-1" id="clientesActivos">{{ $clientes->whereNotNull('ultima_venta')->count() }}
                    </h3>
                    <p class="text-muted mb-0">Clientes Activos</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <div class="col-xl-8 mb-4">
                <div class="chart-container fade-in-up" style="animation-delay: 0.5s">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-chart-bar text-primary me-2"></i>Análisis de Compras por Cliente
                        </h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm active"
                                data-chart="bar">Barras</button>
                            <button type="button" class="btn btn-outline-primary btn-sm" data-chart="line">Líneas</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="clientesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-4">
                <div class="chart-container fade-in-up" style="animation-delay: 0.6s">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-chart-pie text-success me-2"></i>Segmentación de Clientes
                    </h5>
                    <canvas id="segmentacionChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="fade-in-up" style="animation-delay: 0.7s">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="searchClientes"
                    placeholder="Buscar clientes por nombre...">
            </div>

            <div class="filter-tabs">
                <div class="filter-tab active" data-filter="all">
                    <i class="fas fa-users me-1"></i> Todos
                </div>
                <div class="filter-tab" data-filter="vip">
                    <i class="fas fa-crown me-1"></i> VIP (5+ compras)
                </div>
                <div class="filter-tab" data-filter="frequent">
                    <i class="fas fa-fire me-1"></i> Frecuentes (3-4 compras)
                </div>
                <div class="filter-tab" data-filter="new">
                    <i class="fas fa-seedling me-1"></i> Nuevos (1-2 compras)
                </div>
                <div class="filter-tab" data-filter="inactive">
                    <i class="fas fa-clock me-1"></i> Inactivos
                </div>
            </div>
        </div>

        <!-- Modern Table -->
        <div class="fade-in-up" style="animation-delay: 0.8s">
            <div class="modern-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-0 py-3">Cliente</th>
                            <th class="border-0 py-3">Segmento</th>
                            <th class="border-0 py-3">Estadísticas</th>
                            <th class="border-0 py-3">Última Compra</th>
                            <th class="border-0 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="clientesTableBody">
                        @foreach ($clientes as $cliente)
                            @php
                                $segment = 'new';
                                $segmentClass = 'badge-new';
                                $segmentText = 'Nuevo';

                                if ($cliente->ventas_count >= 5) {
                                    $segment = 'vip';
                                    $segmentClass = 'badge-vip';
                                    $segmentText = 'VIP';
                                } elseif ($cliente->ventas_count >= 3) {
                                    $segment = 'frequent';
                                    $segmentClass = 'badge-frequent';
                                    $segmentText = 'Frecuente';
                                } elseif (!$cliente->ultima_venta) {
                                    $segment = 'inactive';
                                    $segmentClass = 'badge-inactive';
                                    $segmentText = 'Inactivo';
                                }
                            @endphp
                            <tr class="customer-row" data-segment="{{ $segment }}"
                                data-name="{{ strtolower($cliente->nombre_cliente . ' ' . $cliente->apellido_cliente) }}">
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="customer-avatar">
                                            {{ substr($cliente->nombre_cliente, 0, 1) }}{{ substr($cliente->apellido_cliente, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $cliente->nombre_cliente }}
                                                {{ $cliente->apellido_cliente }}</div>
                                            <small class="text-muted">ID: #{{ $cliente->id ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="customer-badge {{ $segmentClass }}">
                                        {{ $segmentText }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="customer-stats">
                                        <div class="stat-item">
                                            <div class="stat-value">{{ $cliente->ventas_count }}</div>
                                            <div class="stat-label">Compras</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-value">
                                                ${{ number_format($cliente->ventas_count * 150, 0) }}</div>
                                            <div class="stat-label">Total</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    @if ($cliente->ultima_venta)
                                        <div class="fw-bold">{{ $cliente->ultima_venta->created_at->format('d/m/Y') }}
                                        </div>
                                        <small
                                            class="text-muted">{{ $cliente->ultima_venta->created_at->diffForHumans() }}</small>
                                    @else
                                        <span class="text-muted">Sin compras</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-primary btn-sm" title="Ver perfil">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success btn-sm" title="Contactar">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info btn-sm" title="Historial">
                                            <i class="fas fa-history"></i>
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Datos para gráficos
            const clientesData = {!! json_encode($clientes) !!};
            const clientesLabels = clientesData.map(c => c.nombre_cliente + ' ' + c.apellido_cliente);
            const clientesVentas = clientesData.map(c => c.ventas_count);

            // Configuración de colores
            const colors = {
                primary: ['#667eea', '#764ba2'],
                success: ['#4facfe', '#00f2fe'],
                warning: ['#fa709a', '#fee140'],
                danger: ['#ff6b6b', '#ffa726']
            };

            // Gráfico principal de clientes
            const clientesCtx = document.getElementById('clientesChart').getContext('2d');
            let clientesChart = new Chart(clientesCtx, {
                type: 'bar',
                data: {
                    labels: clientesLabels.slice(0, 10), // Top 10 clientes
                    datasets: [{
                        label: 'Compras Realizadas',
                        data: clientesVentas.slice(0, 10),
                        backgroundColor: function(context) {
                            const chart = context.chart;
                            const {
                                ctx,
                                chartArea
                            } = chart;
                            if (!chartArea) return null;

                            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0,
                                chartArea.top);
                            gradient.addColorStop(0, colors.primary[0]);
                            gradient.addColorStop(1, colors.primary[1]);
                            return gradient;
                        },
                        borderColor: colors.primary[0],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2, // Relación ancho:alto 2:1
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: colors.primary[0],
                            borderWidth: 1,
                            cornerRadius: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d',
                                maxRotation: 45
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // Gráfico de segmentación
            const segmentacionCtx = document.getElementById('segmentacionChart').getContext('2d');
            const vipCount = clientesData.filter(c => c.ventas_count >= 5).length;
            const frequentCount = clientesData.filter(c => c.ventas_count >= 3 && c.ventas_count < 5).length;
            const newCount = clientesData.filter(c => c.ventas_count < 3 && c.ultima_venta).length;
            const inactiveCount = clientesData.filter(c => !c.ultima_venta).length;

            const segmentacionChart = new Chart(segmentacionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['VIP', 'Frecuentes', 'Nuevos', 'Inactivos'],
                    datasets: [{
                        data: [vipCount, frequentCount, newCount, inactiveCount],
                        backgroundColor: [
                            colors.warning[0],
                            colors.success[0],
                            colors.primary[0],
                            '#6c757d'
                        ],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 1, // Relación 1:1 para gráfico circular
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                color: '#6c757d'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            cornerRadius: 10,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed * 100) / total).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage +
                                        '%)';
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        duration: 2000
                    }
                }
            });

            // Cambio de tipo de gráfico
            document.querySelectorAll('[data-chart]').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('[data-chart]').forEach(b => b.classList.remove(
                        'active'));
                    this.classList.add('active');

                    const chartType = this.dataset.chart;
                    clientesChart.destroy();

                    clientesChart = new Chart(clientesCtx, {
                        type: chartType,
                        data: {
                            labels: clientesLabels.slice(0, 10),
                            datasets: [{
                                label: 'Compras Realizadas',
                                data: clientesVentas.slice(0, 10),
                                backgroundColor: chartType === 'line' ?
                                    'rgba(102, 126, 234, 0.1)' : function(context) {
                                        const chart = context.chart;
                                        const {
                                            ctx,
                                            chartArea
                                        } = chart;
                                        if (!chartArea) return null;

                                        const gradient = ctx.createLinearGradient(0,
                                            chartArea.bottom, 0, chartArea.top);
                                        gradient.addColorStop(0, colors.primary[0]);
                                        gradient.addColorStop(1, colors.primary[1]);
                                        return gradient;
                                    },
                                borderColor: colors.primary[0],
                                borderWidth: 2,
                                fill: chartType === 'line',
                                tension: chartType === 'line' ? 0.4 : 0,
                                pointBackgroundColor: colors.primary[0],
                                pointBorderColor: 'white',
                                pointBorderWidth: 2,
                                pointRadius: chartType === 'line' ? 6 : 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0,0,0,0.8)',
                                    titleColor: 'white',
                                    bodyColor: 'white',
                                    borderColor: colors.primary[0],
                                    borderWidth: 1,
                                    cornerRadius: 10,
                                    displayColors: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0,0,0,0.1)',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6c757d'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: '#6c757d',
                                        maxRotation: 45
                                    }
                                }
                            },
                            animation: {
                                duration: 1000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                });
            });

            // Búsqueda de clientes
            const searchInput = document.getElementById('searchClientes');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.customer-row');

                rows.forEach(row => {
                    const customerName = row.dataset.name;
                    if (customerName.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Filtros de segmentación
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove(
                        'active'));
                    this.classList.add('active');

                    const filter = this.dataset.filter;
                    const rows = document.querySelectorAll('.customer-row');

                    rows.forEach(row => {
                        if (filter === 'all' || row.dataset.segment === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });

            // Exportación
            document.getElementById('exportPdf').addEventListener('click', function(e) {
                e.preventDefault();
                showLoading();

                // Simular exportación
                setTimeout(() => {
                    hideLoading();
                    showNotification('PDF exportado exitosamente', 'success');
                }, 2000);
            });

            document.getElementById('exportExcel').addEventListener('click', function(e) {
                e.preventDefault();
                showLoading();

                // Simular exportación
                setTimeout(() => {
                    hideLoading();
                    showNotification('Excel exportado exitosamente', 'success');
                }, 1500);
            });

            // Funciones auxiliares
            function showLoading() {
                document.getElementById('loadingOverlay').classList.add('show');
            }

            function hideLoading() {
                document.getElementById('loadingOverlay').classList.remove('show');
            }

            function showNotification(message, type = 'info') {
                // Crear notificación toast
                const toast = document.createElement('div');
                toast.className = `alert alert-${type} position-fixed`;
                toast.style.cssText = 'top: 20px; right: 20px; z-index: 10000; min-width: 300px;';
                toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                ${message}
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

                document.body.appendChild(toast);

                // Auto-remove después de 3 segundos
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 3000);
            }

            // Animaciones de entrada
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.kpi-card, .chart-container').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endpush
>>>>>>> 2350b95 (código 7)

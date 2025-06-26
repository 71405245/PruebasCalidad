@extends('layouts.app')

@section('title', 'Dashboard Analítico - Sistema de Ventas')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 0;
        margin-bottom: 3rem;
        border-radius: 0 0 50px 50px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: rotate(15deg);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .hero-subtitle {
        font-size: 1.4rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    .export-dropdown {
        background: rgba(255,255,255,0.15);
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }
    
    .export-dropdown:hover {
        background: rgba(255,255,255,0.25);
        border-color: rgba(255,255,255,0.5);
        transform: translateY(-2px);
    }
    
    .kpi-container {
        margin-top: -2rem;
        position: relative;
        z-index: 3;
        margin-bottom: 3rem;
    }
    
    .kpi-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        border: none;
        transition: all 0.4s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-color);
    }
    
    .kpi-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }
    
    .kpi-card.success { --card-color: linear-gradient(45deg, #28a745, #20c997); }
    .kpi-card.primary { --card-color: linear-gradient(45deg, #667eea, #764ba2); }
    .kpi-card.warning { --card-color: linear-gradient(45deg, #ffc107, #fd7e14); }
    .kpi-card.info { --card-color: linear-gradient(45deg, #4facfe, #00f2fe); }
    
    .kpi-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        background: var(--card-color);
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .kpi-icon::after {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 22px;
        background: var(--card-color);
        z-index: -1;
        opacity: 0.2;
        filter: blur(8px);
    }
    
    .kpi-label {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    
    .kpi-value {
        font-size: 2.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    
    .kpi-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: var(--card-color);
        color: white;
        opacity: 0.9;
    }
    
    .chart-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    
    .chart-container:hover {
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .chart-header {
        background: linear-gradient(45deg, #f8f9fa, #ffffff);
        padding: 2rem;
        border-bottom: 2px solid #e9ecef;
    }
    
    .chart-title {
        color: #2c3e50;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.3rem;
    }
    
    .chart-body {
        padding: 2rem;
        position: relative;
    }
    
    .chart-canvas {
        position: relative;
        height: 350px;
    }
    
    .table-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .table-header {
        background: linear-gradient(45deg, #2c3e50, #34495e);
        color: white;
        padding: 2rem;
        display: flex;
        justify-content: between;
        align-items: center;
    }
    
    .table-title {
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.3rem;
    }
    
    .table-modern {
        margin: 0;
        background: white;
    }
    
    .table-modern thead th {
        background: linear-gradient(45deg, #f8f9fa, #ffffff);
        color: #2c3e50;
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .table-modern tbody tr {
        border: none;
        transition: all 0.3s ease;
    }
    
    .table-modern tbody tr:hover {
        background: linear-gradient(45deg, #f8f9ff, #ffffff);
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .table-modern tbody td {
        padding: 1.5rem 1rem;
        border: none;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
    }
    
    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }
    
    .client-info {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .client-dni {
        font-family: 'Courier New', monospace;
        color: #6c757d;
        font-size: 0.9rem;
        background: #f8f9fa;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }
    
    .product-list {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .amount-display {
        font-weight: 700;
        font-size: 1.1rem;
        color: #28a745;
        font-family: 'Courier New', monospace;
    }
    
    .date-display {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .loading-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        border-radius: 8px;
    }
    
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    .refresh-button {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .refresh-button:hover {
        background: linear-gradient(45deg, #5a6fd8, #6a4190);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        color: white;
    }
    
    .filter-tabs {
        background: white;
        border-radius: 15px;
        padding: 0.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        display: inline-flex;
        gap: 0.5rem;
    }
    
    .filter-tab {
        padding: 0.8rem 1.5rem;
        border: none;
        background: transparent;
        border-radius: 10px;
        font-weight: 600;
        color: #6c757d;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .filter-tab.active {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .stats-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 2px solid #e9ecef;
    }
    
    .summary-item {
        text-align: center;
        padding: 1rem;
    }
    
    .summary-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .summary-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .kpi-container {
            margin-top: -1rem;
        }
        
        .kpi-card {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .kpi-value {
            font-size: 2.2rem;
        }
        
        .chart-body {
            padding: 1rem;
        }
        
        .chart-canvas {
            height: 250px;
        }
        
        .table-modern thead th,
        .table-modern tbody td {
            padding: 1rem 0.5rem;
            font-size: 0.9rem;
        }
        
        .product-list {
            max-width: 150px;
        }
    }
    
    .fade-in {
        animation: fadeIn 0.6s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .slide-in {
        animation: slideIn 0.8s ease forwards;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .chart-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 350px;
        color: #6c757d;
        flex-direction: column;
        gap: 1rem;
    }
    
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="hero-title">
                        <i class="fas fa-tachometer-alt me-3"></i>
                        Dashboard Analítico
                    </h1>
                    <p class="hero-subtitle">
                        Panel de control inteligente para el análisis de ventas y rendimiento
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="dropdown">
                        <button class="btn export-dropdown dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-2"></i>Exportar Reportes
                        </button>
                        <ul class="dropdown-menu shadow-lg border-0" style="border-radius: 15px;">
                            <li>
                                <a class="dropdown-item py-3 px-4" href="#" id="exportPdfBtn">
                                    <i class="fas fa-file-pdf text-danger me-3"></i>
                                    <span class="fw-semibold">Exportar a PDF</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-3 px-4" href="#" id="exportExcelBtn">
                                    <i class="fas fa-file-excel text-success me-3"></i>
                                    <span class="fw-semibold">Exportar a Excel</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-3 px-4" href="#" id="refreshDataBtn">
                                    <i class="fas fa-sync-alt text-primary me-3"></i>
                                    <span class="fw-semibold">Actualizar Datos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <!-- Filtros de Tiempo -->
    <div class="text-center mb-4">
        <div class="filter-tabs">
            <button class="filter-tab active" data-period="today">Hoy</button>
            <button class="filter-tab" data-period="week">Esta Semana</button>
            <button class="filter-tab" data-period="month">Este Mes</button>
            <button class="filter-tab" data-period="year">Este Año</button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-container">
        <div class="row g-4">
            <div class="col-xl-3 col-md-6">
                <div class="kpi-card success fade-in">
                    <div class="kpi-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="kpi-label">Ventas Totales</div>
                    <div class="kpi-value" id="ventasTotales">{{ $clientesActivos }}</div>
                    <div class="kpi-badge">
                        <i class="fas fa-arrow-up"></i>
                        +12.5%
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="kpi-card primary fade-in" style="animation-delay: 0.1s;">
                    <div class="kpi-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="kpi-label">Ventas Este Mes</div>
                    <div class="kpi-value" id="ventasMes">{{ $clientesMesActual }}</div>
                    <div class="kpi-badge">
                        <i class="fas fa-arrow-up"></i>
                        +{{ $tasaCrecimiento }}%
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="kpi-card warning fade-in" style="animation-delay: 0.2s;">
                    <div class="kpi-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="kpi-label">Ventas Mes Pasado</div>
                    <div class="kpi-value" id="ventasMesPasado">{{ $clientesMesPasado }}</div>
                    <div class="kpi-badge">
                        <i class="fas fa-minus"></i>
                        Comparativo
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="kpi-card info fade-in" style="animation-delay: 0.3s;">
                    <div class="kpi-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="kpi-label">Clientes Únicos</div>
                    <div class="kpi-value" id="clientesUnicos">{{ $clientesActivos }}</div>
                    <div class="kpi-badge">
                        <i class="fas fa-user-plus"></i>
                        Activos
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen Estadístico -->
    <div class="stats-summary slide-in">
        <div class="row">
            <div class="col-md-3">
                <div class="summary-item">
                    <div class="summary-value">S/ {{ number_format(array_sum(array_column($clientesRecientes->toArray(), 'total')), 2) }}</div>
                    <div class="summary-label">Ingresos Totales</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-item">
                    <div class="summary-value">{{ count($clientesRecientes) }}</div>
                    <div class="summary-label">Transacciones</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-item">
                    <div class="summary-value">S/ {{ $clientesRecientes->count() > 0 ? number_format(array_sum(array_column($clientesRecientes->toArray(), 'total')) / $clientesRecientes->count(), 2) : '0.00' }}</div>
                    <div class="summary-label">Ticket Promedio</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-item">
                    <div class="summary-value">{{ array_sum(array_values($sucursales)) }}</div>
                    <div class="summary-label">Productos Vendidos</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Principales -->
    <div class="row mb-4">
        <!-- Gráfico de Ventas por Sucursal -->
        <div class="col-xl-8">
            <div class="chart-container slide-in">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-chart-bar text-primary"></i>
                        Análisis de Ventas por Sucursal
                    </h3>
                </div>
                <div class="chart-body">
                    <div class="chart-loading" id="chartLoading1" style="display: none;">
                        <div class="loading-spinner"></div>
                        <p>Cargando datos del gráfico...</p>
                    </div>
                    <div class="chart-canvas">
                        <canvas id="clientesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Distribución -->
        <div class="col-xl-4">
            <div class="chart-container slide-in" style="animation-delay: 0.2s;">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-chart-pie text-success"></i>
                        Distribución de Ventas
                    </h3>
                </div>
                <div class="chart-body">
                    <div class="chart-loading" id="chartLoading2" style="display: none;">
                        <div class="loading-spinner"></div>
                        <p>Cargando distribución...</p>
                    </div>
                    <div class="chart-canvas">
                        <canvas id="planesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reportes Integrados -->
    <div class="row">
        <!-- Reporte de Ventas Recientes -->
        <div class="col-lg-6 mb-4">
            <div class="table-container slide-in" style="animation-delay: 0.1s;">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="fas fa-receipt"></i>
                        Ventas Recientes
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>Cliente</th>
                                <th><i class="fas fa-id-card me-2"></i>DNI</th>
                                <th><i class="fas fa-box me-2"></i>Productos</th>
                                <th><i class="fas fa-dollar-sign me-2"></i>Total</th>
                                <th><i class="fas fa-calendar me-2"></i>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientesRecientes as $venta)
                                <tr>
                                    <td>
                                        <div class="client-info">{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</div>
                                    </td>
                                    <td>
                                        <span class="client-dni">{{ $venta->dni ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <div class="product-list" title="@foreach($venta->productos as $producto){{ $producto->nombre }} ({{ $producto->pivot->cantidad }}), @endforeach">
                                            @foreach($venta->productos as $producto)
                                                {{ $producto->nombre }} ({{ $producto->pivot->cantidad }})@if(!$loop->last), @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <span class="amount-display">S/ {{ number_format($venta->total, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="date-display">{{ $venta->created_at->format('d/m/Y H:i') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No hay ventas recientes para mostrar</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Reporte de Movimiento -->
        <div class="col-lg-6 mb-4">
            <div class="chart-container slide-in" style="animation-delay: 0.2s;">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-chart-area text-warning"></i>
                        Tendencia de Ventas
                    </h3>
                </div>
                <div class="chart-body">
                    <div class="chart-loading" id="chartLoading3" style="display: none;">
                        <div class="loading-spinner"></div>
                        <p>Analizando tendencias...</p>
                    </div>
                    <div class="chart-canvas" style="height: 250px;">
                        <canvas id="movimientoClientesChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Tabla de Historial -->
            <div class="table-container mt-3">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="fas fa-history"></i>
                        Historial de Movimientos
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                <th><i class="fas fa-user me-2"></i>Cliente</th>
                                <th><i class="fas fa-dollar-sign me-2"></i>Total</th>
                                <th><i class="fas fa-calendar me-2"></i>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($movimientoClientes as $venta)
                                <tr>
                                    <td>
                                        <span class="client-dni">#{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td>
                                        <div class="client-info">{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</div>
                                    </td>
                                    <td>
                                        <span class="amount-display">S/ {{ number_format($venta->total, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="date-display">{{ $venta->created_at->format('d/m/Y H:i') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No hay movimientos para mostrar</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para exportar PDF -->
<form id="pdfDashboardForm" method="POST" action="{{ route('dashboard.export.pdf') }}" style="display: none;">
    @csrf
    <input type="hidden" name="grafico_clientes_base64" id="grafico_clientes_base64">
    <input type="hidden" name="grafico_planes_base64" id="grafico_planes_base64">
    <input type="hidden" name="grafico_movimiento_base64" id="grafico_movimiento_base64">
</form>
@endsection

@push('scripts')
<!-- Librerías para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuración global de Chart.js
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.color = '#6c757d';
    
    // Datos para gráficos desde el controlador
    const sucursalesData = {!! json_encode($sucursales) !!};
    const sucursalesLabels = Object.keys(sucursalesData);
    const sucursalesVentas = Object.values(sucursalesData).map(item => typeof item === 'object' ? item.activos : item);

    // Función para mostrar loading
    function showLoading(chartId, loadingId) {
        document.getElementById(loadingId).style.display = 'flex';
        document.getElementById(chartId).style.display = 'none';
    }
    
    function hideLoading(chartId, loadingId) {
        document.getElementById(loadingId).style.display = 'none';
        document.getElementById(chartId).style.display = 'block';
    }

    // Gráfico de ventas por sucursal
    setTimeout(() => {
        const clientesCtx = document.getElementById('clientesChart').getContext('2d');
        const clientesChart = new Chart(clientesCtx, {
            type: 'bar',
            data: {
                labels: sucursalesLabels,
                datasets: [{
                    label: 'Ventas',
                    data: sucursalesVentas,
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(118, 75, 162, 0.8)',
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderColor: [
                        'rgba(102, 126, 234, 1)',
                        'rgba(118, 75, 162, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
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
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(102, 126, 234, 1)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 600
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                weight: 500
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
        
        window.clientesChart = clientesChart;
    }, 500);

    // Gráfico de distribución de ventas
    setTimeout(() => {
        const planesCtx = document.getElementById('planesChart').getContext('2d');
        const planesChart = new Chart(planesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Básico', 'Premium', 'Gold'],
                datasets: [{
                    data: [
                        {{ $distribucionPlanes['Basico'] ?? 0 }},
                        {{ $distribucionPlanes['Premium'] ?? 0 }},
                        {{ $distribucionPlanes['Gold'] ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(108, 117, 125, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(102, 126, 234, 0.8)'
                    ],
                    borderColor: [
                        'rgba(108, 117, 125, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(102, 126, 234, 1)'
                    ],
                    borderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                weight: 600
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(102, 126, 234, 1)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
        
        window.planesChart = planesChart;
    }, 800);

    // Gráfico de movimiento de ventas
    setTimeout(() => {
        const movimientoCtx = document.getElementById('movimientoClientesChart').getContext('2d');
        const movimientoChart = new Chart(movimientoCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($graficoMovimientoLabels ?? []) !!},
                datasets: [{
                    label: 'Ventas',
                    data: {!! json_encode($graficoMovimientoAltas ?? []) !!},
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(102, 126, 234, 1)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 500
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                weight: 500
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
        
        window.movimientoChart = movimientoChart;
    }, 1200);

    // Filtros de tiempo
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Simular actualización de datos
            updateDashboardData(this.dataset.period);
        });
    });
    
    function updateDashboardData(period) {
        // Mostrar loading en KPIs
        document.querySelectorAll('.kpi-value').forEach(el => {
            el.style.opacity = '0.5';
        });
        
        setTimeout(() => {
            document.querySelectorAll('.kpi-value').forEach(el => {
                el.style.opacity = '1';
            });
            
            // Aquí harías la llamada AJAX real para actualizar los datos
            showNotification(`Datos actualizados para: ${period}`, 'success');
        }, 1000);
    }

    // Exportar a PDF
    document.getElementById('exportPdfBtn').addEventListener('click', function(e) {
        e.preventDefault();
        
        const button = this;
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generando PDF...';
        
        setTimeout(() => {
            // Capturar los gráficos como imágenes
            if (window.clientesChart) {
                document.getElementById('grafico_clientes_base64').value = 
                    document.getElementById('clientesChart').toDataURL('image/png');
            }
            if (window.planesChart) {
                document.getElementById('grafico_planes_base64').value = 
                    document.getElementById('planesChart').toDataURL('image/png');
            }
            if (window.movimientoChart) {
                document.getElementById('grafico_movimiento_base64').value = 
                    document.getElementById('movimientoClientesChart').toDataURL('image/png');
            }

            // Enviar el formulario
            document.getElementById('pdfDashboardForm').submit();
            
            button.innerHTML = originalText;
            showNotification('PDF generado exitosamente', 'success');
        }, 2000);
    });
    
    // Exportar a Excel
    document.getElementById('exportExcelBtn').addEventListener('click', function(e) {
        e.preventDefault();
        showNotification('Funcionalidad de Excel en desarrollo', 'info');
    });
    
    // Actualizar datos
    document.getElementById('refreshDataBtn').addEventListener('click', function(e) {
        e.preventDefault();
        
        const button = this;
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Actualizando...';
        
        setTimeout(() => {
            button.innerHTML = originalText;
            showNotification('Datos actualizados exitosamente', 'success');
            
            // Simular actualización de gráficos
            if (window.clientesChart) {
                window.clientesChart.update('active');
            }
            if (window.planesChart) {
                window.planesChart.update('active');
            }
            if (window.movimientoChart) {
                window.movimientoChart.update('active');
            }
        }, 2000);
    });
    
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
    
    document.querySelectorAll('.kpi-card, .chart-container, .table-container').forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'all 0.6s ease';
        observer.observe(item);
    });
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 2rem; right: 2rem; z-index: 9999; min-width: 300px; border-radius: 15px;';
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-triangle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}
</script>
@endpush

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\EmpleadoCapacitacionController;

// Pestaña de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (si las necesitas)
Auth::routes();

// Rutas para Productos
Route::resource('productos', ProductoController::class);

Route::resource('productos', ProductoController::class)->except(['show']);
Route::prefix('productos')->group(function () {
    Route::get('export', [ProductoController::class, 'export'])->name('productos.export');
    Route::post('import', [ProductoController::class, 'import'])->name('productos.import');
});

// Rutas para Ventas
Route::resource('ventas', VentaController::class);
Route::prefix('ventas')->group(function () {
    Route::get('{id}/voucher', [VentaController::class, 'generateVoucher'])->name('ventas.voucher');
    Route::get('reporte/diario', [VentaController::class, 'dailyReport'])->name('ventas.reporte.diario');
    Route::get('reporte/mensual', [VentaController::class, 'monthlyReport'])->name('ventas.reporte.mensual');
});

// Rutas para Categorías (si las necesitas)
Route::resource('categorias', CategoriaController::class)->except(['show']);

// Rutas para Marcas (si las necesitas)
Route::resource('marcas', MarcaController::class)->except(['show']);

// Ruta para el dashboard (si usas autenticación)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas adicionales de API (si necesitas)
Route::prefix('api')->group(function () {
    Route::get('productos/search', [ProductoController::class, 'search'])->name('api.productos.search');
    Route::get('productos/{id}/stock', [ProductoController::class, 'checkStock'])->name('api.productos.stock');
});

// Rutas para administración
Route::prefix('admin')->group(function () {
    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::resource('marcas', MarcaController::class)->except(['show']);
});

// Rutas públicas
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/marcas/{marca}', [MarcaController::class, 'show'])->name('marcas.show');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// ==================== AUTENTICACIÓN ====================
Auth::routes();

// Autenticación con Google
Route::prefix('auth')->group(function () {
    Route::get('/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

Route::prefix('reportes')->group(function () {
    Route::get('/ventas', [ReportController::class, 'salesReport'])->name('reportes.ventas');
    Route::get('/inventario', [ReportController::class, 'inventoryReport'])->name('reportes.inventario');
    Route::get('/clientes', [ReportController::class, 'customerReport'])->name('reportes.clientes');
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('reportes.dashboard');

    Route::get('/ventas', [ReportController::class, 'salesReport'])->name('reportes.ventas');
    Route::post('/ventas/pdf', [ReportController::class, 'salesReportPdf'])->name('reportes.ventas.pdf');
    Route::get('/ventas/excel', [ReportController::class, 'salesReportExcel'])->name('reportes.ventas.excel');

    Route::get('/inventario', [ReportController::class, 'inventoryReport'])->name('reportes.inventario');
    Route::get('/clientes', [ReportController::class, 'customerReport'])->name('reportes.clientes');
});
Route::middleware(['auth'])->group(function () {
    // Otras rutas...

    // Asistente IA
    Route::post('/ai/query', [AIController::class, 'handleQuery'])->name('ai.assistant.query');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    // Ruta de perfil (para el error profile.edit)
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('auth')->group(function () {
    Route::resource('ventas', VentaController::class);
    Route::get('ventas/{id}/voucher', [VentaController::class, 'generateVoucher'])->name('ventas.voucher');
    Route::get('ventas/reporte/diario', [VentaController::class, 'dailyReport'])->name('ventas.reporte.diario');
    Route::get('ventas/reporte/mensual', [VentaController::class, 'monthlyReport'])->name('ventas.reporte.mensual');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('reportes')->group(function () {
        Route::get('/ventas', [ReportController::class, 'salesReport'])->name('reportes.ventas');
        Route::post('/ventas/pdf', [ReportController::class, 'salesReportPdf'])->name('reportes.ventas.pdf');
        Route::get('/ventas/excel', [ReportController::class, 'salesReportExcel'])->name('reportes.ventas.excel');
        Route::get('/inventario', [ReportController::class, 'inventoryReport'])->name('reportes.inventario');
        Route::get('/clientes', [ReportController::class, 'customerReport'])->name('reportes.clientes');
        Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('reportes.dashboard');
    });
});


});

Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/export-pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
    // Reportes
    Route::prefix('reports')->group(function () {
        Route::get('sales', [ReportController::class, 'salesReport'])->name('reports.sales');
        Route::get('inventory', [ReportController::class, 'inventoryReport'])->name('reports.inventory');
        Route::get('customers', [ReportController::class, 'customerReport'])->name('reports.customers');
        Route::get('sales/export/pdf', [ReportController::class, 'exportSalesPdf'])->name('reports.exports.sales-pdf');
<<<<<<< HEAD
<<<<<<< HEAD
});
=======
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
>>>>>>> 2350b95 (código 7)
});

Route::middleware(['auth'])->group(function () {
    // Capacitaciones
    // Opción 1: Usar Route::resource (recomendado para CRUD completo)
    Route::resource('capacitaciones', \App\Http\Controllers\CapacitacionController::class);

    // O Opción 2: Definir manualmente la ruta create
    Route::get('/capacitaciones/create', [\App\Http\Controllers\CapacitacionController::class, 'create'])
        ->name('capacitaciones.create');
    Route::get('capacitaciones/{capacitacione}/edit', [CapacitacionController::class, 'edit'])
        ->name('capacitaciones.edit');

    Route::get('empleados/{empleado}/capacitaciones', [EmpleadoCapacitacionController::class, 'index'])
        ->name('empleados.capacitaciones');
    Route::post('empleados/{empleado}/capacitaciones', [EmpleadoCapacitacionController::class, 'store']);

    // Progreso de capacitaciones
    Route::put('capacitaciones/{capacitacion}/progreso', [EmpleadoCapacitacionController::class, 'updateProgreso'])
        ->name('capacitaciones.progreso');
=======
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
>>>>>>> 2350b95 (código 7)
});

Route::middleware(['auth'])->group(function () {
    // Capacitaciones
    // Opción 1: Usar Route::resource (recomendado para CRUD completo)
    Route::resource('capacitaciones', \App\Http\Controllers\CapacitacionController::class);

    // O Opción 2: Definir manualmente la ruta create
    Route::get('/capacitaciones/create', [\App\Http\Controllers\CapacitacionController::class, 'create'])
        ->name('capacitaciones.create');
    Route::get('capacitaciones/{capacitacione}/edit', [CapacitacionController::class, 'edit'])
        ->name('capacitaciones.edit');

    Route::get('empleados/{empleado}/capacitaciones', [EmpleadoCapacitacionController::class, 'index'])
        ->name('empleados.capacitaciones');
    Route::post('empleados/{empleado}/capacitaciones', [EmpleadoCapacitacionController::class, 'store']);

    // Progreso de capacitaciones
    Route::put('capacitaciones/{capacitacion}/progreso', [EmpleadoCapacitacionController::class, 'updateProgreso'])
        ->name('capacitaciones.progreso');
});

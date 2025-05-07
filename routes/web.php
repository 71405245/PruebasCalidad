<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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
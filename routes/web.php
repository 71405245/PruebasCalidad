
<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

//Pestaña de inicio GOOD
Route::get('/', function () {
    return view('welcome');
});

Route::resource('productos', ProductoController::class);
Route::resource('ventas', VentaController::class); // Genera las rutas CRUD para las ventas
Route::get('ventas/{id}/voucher', [VentaController::class, 'generateVoucher'])->name('ventas.voucher');
//Editar y eliminar ventas
Route::get('ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');
//Editar  y eliminars prodcutos
Route::get('productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

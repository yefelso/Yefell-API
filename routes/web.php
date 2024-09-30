<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UsuarioController; // Asegúrate de que el namespace sea correcto
use App\Http\Controllers\Web\ProductoController; // Asegúrate de que el namespace sea correcto
use App\Http\Controllers\Api\CarritoController;
use App\Http\Controllers\Api\CarritoProductoController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\ProductoCategoriaController;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\CategoriaController;
use Illuminate\Http\Request;

// Ruta de la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación de usuario (por ejemplo, usando Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas web
Route::prefix('web')->group(function () {
    // Rutas de usuarios (requiere autenticación)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->middleware('auth:sanctum'); // Acceso autenticado
    Route::post('/usuarios', [UsuarioController::class, 'store'])->middleware('auth:sanctum'); // Acceso autenticado
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->middleware('auth:sanctum'); // Acceso autenticado
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->middleware('auth:sanctum'); // Acceso autenticado
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->middleware('auth:sanctum'); // Acceso autenticado

    // Rutas de productos (no requieren autenticación)
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('producto.show');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');
    

    // Rutas de carritos (requieren autenticación)
    Route::get('/carritos', [CarritoController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/carritos', [CarritoController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/carritos/{id}', [CarritoController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/carritos/{id}', [CarritoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/carritos/{id}', [CarritoController::class, 'destroy'])->middleware('auth:sanctum');

    // Rutas de productos en el carrito (requieren autenticación)
    Route::get('/carritos/{carrito_id}/productos', [CarritoProductoController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/carrito_productos', [CarritoProductoController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/carrito_productos/{id}', [CarritoProductoController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/carrito_productos/{id}', [CarritoProductoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/carrito_productos/{id}', [CarritoProductoController::class, 'destroy'])->middleware('auth:sanctum');

    // Rutas de pedidos (requieren autenticación)
    Route::get('/pedidos', [PedidoController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/pedidos', [PedidoController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->middleware('auth:sanctum');

    // Rutas de producto-categoría (requieren autenticación)
    Route::get('/producto-categorias', [ProductoCategoriaController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/producto-categorias', [ProductoCategoriaController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/producto-categorias/{id}', [ProductoCategoriaController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/producto-categorias/{id}', [ProductoCategoriaController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/producto-categorias/{id}', [ProductoCategoriaController::class, 'destroy'])->middleware('auth:sanctum');

    // Rutas de pagos (requieren autenticación)
    Route::get('/pagos', [PagoController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/pagos', [PagoController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/pagos/{id}', [PagoController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/pagos/{id}', [PagoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/pagos/{id}', [PagoController::class, 'destroy'])->middleware('auth:sanctum');

    // Rutas de categorías (requieren autenticación)
    Route::get('/categorias', [CategoriaController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/categorias', [CategoriaController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->middleware('auth:sanctum');
});

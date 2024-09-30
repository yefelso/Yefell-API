<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\CarritoController;


// Ruta de autenticación de usuario (por ejemplo, usando Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/', function () {
    return view('welcome');
});

// Rutas de usuarios (no requieren autenticación)
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

// Rutas de productos (no requieren autenticación)
Route::get('/productos', [ProductoController::class, 'index']);      // Mostrar todos los productos
Route::post('/productos', [ProductoController::class, 'store']);    // Registrar un nuevo producto
Route::get('/productos/{id}', [ProductoController::class, 'show']);  // Mostrar un producto específico
Route::put('/productos/{id}', [ProductoController::class, 'update']); // Actualizar un producto
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']); // Eliminar un producto

// Rutas de carritos (no requieren autenticación)
Route::get('/carritos', [CarritoController::class, 'index']);          // Mostrar todos los carritos
Route::post('/carritos', [CarritoController::class, 'store']);        // Crear un nuevo carrito
Route::get('/carritos/{id}', [CarritoController::class, 'show']);     // Mostrar un carrito específico
Route::put('/carritos/{id}', [CarritoController::class, 'update']);   // Actualizar un carrito
Route::delete('/carritos/{id}', [CarritoController::class, 'destroy']); // Eliminar un carrito

// Rutas de productos en el carrito
Route::get('/carritos/{carrito_id}/productos', [CarritoProductoController::class, 'index']);          // Mostrar productos en el carrito
Route::post('/carrito_productos', [CarritoProductoController::class, 'store']);                     // Agregar producto al carrito
Route::get('/carrito_productos/{id}', [CarritoProductoController::class, 'show']);                   // Mostrar un producto específico en el carrito
Route::put('/carrito_productos/{id}', [CarritoProductoController::class, 'update']);                 // Actualizar un producto en el carrito
Route::delete('/carrito_productos/{id}', [CarritoProductoController::class, 'destroy']);             // Eliminar un producto del carrito

// Rutas de pedidos
Route::get('/pedidos', [PedidoController::class, 'index']);                // Mostrar todos los pedidos
Route::post('/pedidos', [PedidoController::class, 'store']);              // Crear un nuevo pedido
Route::get('/pedidos/{id}', [PedidoController::class, 'show']);            // Mostrar un pedido específico
Route::put('/pedidos/{id}', [PedidoController::class, 'update']);          // Actualizar un pedido específico
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy']);      // Eliminar un pedido

// Rutas de producto-categoría
Route::get('/producto-categorias', [ProductoCategoriaController::class, 'index']);           // Mostrar todas las relaciones
Route::post('/producto-categorias', [ProductoCategoriaController::class, 'store']);         // Crear una nueva relación
Route::get('/producto-categorias/{id}', [ProductoCategoriaController::class, 'show']);     // Mostrar una relación específica
Route::put('/producto-categorias/{id}', [ProductoCategoriaController::class, 'update']);   // Actualizar una relación específica
Route::delete('/producto-categorias/{id}', [ProductoCategoriaController::class, 'destroy']); // Eliminar una relación

// Rutas de pagos
Route::get('/pagos', [PagoController::class, 'index']);           // Mostrar todos los pagos
Route::post('/pagos', [PagoController::class, 'store']);         // Crear un nuevo pago
Route::get('/pagos/{id}', [PagoController::class, 'show']);     // Mostrar un pago específico
Route::put('/pagos/{id}', [PagoController::class, 'update']);   // Actualizar un pago específico
Route::delete('/pagos/{id}', [PagoController::class, 'destroy']); // Eliminar un pago

// Rutas de categorías
Route::get('/categorias', [CategoriaController::class, 'index']);         // Mostrar todas las categorías
Route::post('/categorias', [CategoriaController::class, 'store']);       // Crear una nueva categoría
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);    // Mostrar una categoría específica
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);  // Actualizar una categoría específica
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']); // Eliminar una categoría

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoProductoController extends Controller
{
    /**
     * Mostrar todos los productos en un carrito.
     *
     * @param int $carrito_id
     * @return \Illuminate\Http\Response
     */
    public function index($carrito_id)
    {
        $productos = CarritoProducto::where('carrito_id', $carrito_id)->get();
        return response()->json($productos);
    }

    /**
     * Agregar un producto al carrito.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'carrito_id' => 'required|exists:carritos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $carritoProducto = CarritoProducto::create($request->all());
        return response()->json($carritoProducto, 201);
    }

    /**
     * Mostrar un producto específico en el carrito.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carritoProducto = CarritoProducto::findOrFail($id);
        return response()->json($carritoProducto);
    }

    /**
     * Actualizar un producto en el carrito.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $carritoProducto = CarritoProducto::findOrFail($id);
        $carritoProducto->update($request->all());
        return response()->json($carritoProducto);
    }

    /**
     * Eliminar un producto del carrito.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carritoProducto = CarritoProducto::findOrFail($id);
        $carritoProducto->delete();
        return response()->json(null, 204);
    }
}

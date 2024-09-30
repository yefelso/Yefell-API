<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoProductoController extends Controller
{
    /**
     * Mostrar todos los productos en un carrito.
     *
     * @param int $carrito_id
     * @return \Illuminate\View\View
     */
    public function index($carrito_id)
    {
        $productos = CarritoProducto::where('carrito_id', $carrito_id)->get();
        // Retorna una vista y pasa los productos como datos
        return view('carritos.productos.index', compact('productos', 'carrito_id'));
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
        
        // Redirige de vuelta a la vista del carrito con un mensaje de éxito
        return redirect()->route('carritos.productos.index', $carritoProducto->carrito_id)
                         ->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Mostrar un producto específico en el carrito.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $carritoProducto = CarritoProducto::findOrFail($id);
        return view('carritos.productos.show', compact('carritoProducto'));
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

        // Redirige de vuelta a la vista del carrito con un mensaje de éxito
        return redirect()->route('carritos.productos.index', $carritoProducto->carrito_id)
                         ->with('success', 'Producto actualizado en el carrito.');
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
        
        // Redirige de vuelta a la vista del carrito con un mensaje de éxito
        return redirect()->route('carritos.productos.index', $carritoProducto->carrito_id)
                         ->with('success', 'Producto eliminado del carrito.');
    }
}

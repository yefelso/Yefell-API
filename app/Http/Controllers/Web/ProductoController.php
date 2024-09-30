<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Mostrar todos los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index', compact('productos'));
    }

    /**
     * Crear un nuevo producto.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|string',
        ]);

        $producto = Producto::create($request->all());
        return redirect()->route('producto.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Mostrar un producto específico.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.show', compact('producto'));
    }

    /**
     * Actualizar un producto específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'imagen' => 'nullable|string',
        ]);

        $producto->update($request->all());
        return redirect()->route('producto.index')->with('success', 'Producto actualizado con éxito.');
    }

    /**
     * Eliminar un producto.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado con éxito.');
    }
}

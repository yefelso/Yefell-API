<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductoCategoria;
use Illuminate\Http\Request;

class ProductoCategoriaController extends Controller
{
    /**
     * Mostrar todas las relaciones entre productos y categorías.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productoCategorias = ProductoCategoria::with(['producto', 'categoria'])->get();
        return response()->json($productoCategorias);
    }

    /**
     * Crear una nueva relación entre producto y categoría.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $productoCategoria = ProductoCategoria::create($request->all());
        return response()->json($productoCategoria, 201);
    }

    /**
     * Mostrar una relación específica entre producto y categoría.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productoCategoria = ProductoCategoria::with(['producto', 'categoria'])->findOrFail($id);
        return response()->json($productoCategoria);
    }

    /**
     * Actualizar una relación específica entre producto y categoría.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'exists:productos,id',
            'categoria_id' => 'exists:categorias,id',
        ]);

        $productoCategoria = ProductoCategoria::findOrFail($id);
        $productoCategoria->update($request->all());
        return response()->json($productoCategoria);
    }

    /**
     * Eliminar una relación entre producto y categoría.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productoCategoria = ProductoCategoria::findOrFail($id);
        $productoCategoria->delete();
        return response()->json(null, 204);
    }
}

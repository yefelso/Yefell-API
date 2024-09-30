<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Mostrar todas las categorías.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::with('productos')->get();
        return response()->json($categorias);
    }

    /**
     * Crear una nueva categoría.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria = Categoria::create($request->all());
        return response()->json($categoria, 201);
    }

    /**
     * Mostrar una categoría específica.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::with('productos')->findOrFail($id);
        return response()->json($categoria);
    }

    /**
     * Actualizar una categoría específica.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'string',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return response()->json($categoria);
    }

    /**
     * Eliminar una categoría.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return response()->json(null, 204);
    }
}

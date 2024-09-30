<?php

namespace App\Http\Controllers\Web;

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
        return view('categorias.index', compact('categorias'));
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
        return redirect()->route('categorias.index')->with('success', 'Categoría creada con éxito.');
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
        return view('categorias.show', compact('categoria'));
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
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada con éxito.');
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
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada con éxito.');
    }
}

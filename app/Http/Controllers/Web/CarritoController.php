<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Muestra una lista de todos los carritos.
     */
    public function index()
    {
        $carritos = Carrito::with('usuario', 'productos')->get();
        return view('carritos.index', compact('carritos'));
    }

    /**
     * Muestra el formulario para crear un nuevo carrito.
     */
    public function create()
    {
        return view('carritos.create');
    }

    /**
     * Almacena un nuevo carrito en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'total' => 'required|numeric',
        ]);

        $carrito = Carrito::create($validatedData);
        return redirect()->route('carritos.index')->with('success', 'Carrito creado exitosamente.');
    }

    /**
     * Muestra un carrito específico.
     */
    public function show($id)
    {
        $carrito = Carrito::with('usuario', 'productos')->findOrFail($id);
        return view('carritos.show', compact('carrito'));
    }

    /**
     * Muestra el formulario para editar un carrito.
     */
    public function edit($id)
    {
        $carrito = Carrito::findOrFail($id);
        return view('carritos.edit', compact('carrito'));
    }

    /**
     * Actualiza un carrito existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $carrito = Carrito::findOrFail($id);
        
        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:usuarios,id',
            'total' => 'sometimes|numeric',
        ]);

        $carrito->update($validatedData);
        return redirect()->route('carritos.index')->with('success', 'Carrito actualizado exitosamente.');
    }

    /**
     * Elimina un carrito específico de la base de datos.
     */
    public function destroy($id)
    {
        Carrito::destroy($id);
        return redirect()->route('carritos.index')->with('success', 'Carrito eliminado exitosamente.');
    }
}

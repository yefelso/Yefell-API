<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json($carritos);
    }

    /**
     * Crea un nuevo carrito.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'total' => 'required|numeric',
        ]);

        $carrito = Carrito::create($validatedData);
        return response()->json($carrito, 201);
    }

    /**
     * Muestra un carrito específico.
     */
    public function show($id)
    {
        $carrito = Carrito::with('usuario', 'productos')->findOrFail($id);
        return response()->json($carrito);
    }

    /**
     * Actualiza un carrito existente.
     */
    public function update(Request $request, $id)
    {
        $carrito = Carrito::findOrFail($id);
        
        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:usuarios,id',
            'total' => 'sometimes|numeric',
        ]);

        $carrito->update($validatedData);
        return response()->json($carrito);
    }

    /**
     * Elimina un carrito específico.
     */
    public function destroy($id)
    {
        Carrito::destroy($id);
        return response()->json(null, 204);
    }
}

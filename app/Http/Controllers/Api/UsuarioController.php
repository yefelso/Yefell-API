<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios); // Respuesta en formato JSON
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        // Crea el usuario y hashea la contraseña
        $validatedData['password'] = bcrypt($validatedData['password']);
        $usuario = Usuario::create($validatedData);
        
        return response()->json($usuario, 201); // Respuesta en formato JSON con código 201
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario); // Respuesta en formato JSON
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return response()->json($usuario); // Respuesta en formato JSON
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(null, 204); // Respuesta en formato JSON con código 204
    }
}

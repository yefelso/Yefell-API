<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Mostrar todos los usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Crear un nuevo usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
        
        return redirect()->route('usuario.index')->with('success', 'Usuario creado con éxito.');
    }

    /**
     * Mostrar un usuario específico.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.show', compact('usuario'));
    }

    /**
     * Actualizar un usuario específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:usuarios,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|string',
        ]);

        // Hashear la contraseña solo si se proporciona una nueva
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $usuario->update($validatedData);
        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Eliminar un usuario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado con éxito.');
    }
}

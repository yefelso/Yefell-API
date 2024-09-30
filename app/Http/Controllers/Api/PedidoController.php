<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Mostrar todos los pedidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::with('usuario')->get(); // Incluye el usuario en la consulta
        return response()->json($pedidos);
    }

    /**
     * Crear un nuevo pedido.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
            'fecha_pedido' => 'required|date',
        ]);

        $pedido = Pedido::create($request->all());
        return response()->json($pedido, 201);
    }

    /**
     * Mostrar un pedido específico.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::with('usuario', 'productos')->findOrFail($id);
        return response()->json($pedido);
    }

    /**
     * Actualizar un pedido específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'total' => 'numeric',
            'status' => 'string',
            'fecha_pedido' => 'date',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return response()->json($pedido);
    }

    /**
     * Eliminar un pedido.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
        return response()->json(null, 204);
    }
}

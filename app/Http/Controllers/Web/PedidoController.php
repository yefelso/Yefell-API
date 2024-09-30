<?php

namespace App\Http\Controllers\Web;

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
        $pedidos = Pedido::with('usuario')->get();
        return view('pedidos.index', compact('pedidos'));
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
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado con éxito.');
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
        return view('pedidos.show', compact('pedido'));
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
            'total' => 'sometimes|numeric',
            'status' => 'sometimes|string',
            'fecha_pedido' => 'sometimes|date',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado con éxito.');
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
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado con éxito.');
    }
}

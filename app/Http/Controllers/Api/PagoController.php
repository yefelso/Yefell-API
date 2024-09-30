<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Mostrar todos los pagos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::with(['usuario', 'pedido'])->get();
        return response()->json($pagos);
    }

    /**
     * Crear un nuevo pago.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'pedido_id' => 'required|exists:pedidos,id',
            'monto' => 'required|numeric',
            'metodo_pago' => 'required|string',
            'fecha_pago' => 'required|date',
        ]);

        $pago = Pago::create($request->all());
        return response()->json($pago, 201);
    }

    /**
     * Mostrar un pago específico.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = Pago::with(['usuario', 'pedido'])->findOrFail($id);
        return response()->json($pago);
    }

    /**
     * Actualizar un pago específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'numeric',
            'metodo_pago' => 'string',
            'fecha_pago' => 'date',
        ]);

        $pago = Pago::findOrFail($id);
        $pago->update($request->all());
        return response()->json($pago);
    }

    /**
     * Eliminar un pago.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();
        return response()->json(null, 204);
    }
}

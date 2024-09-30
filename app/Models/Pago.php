<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'user_id',     // ID del usuario que realiza el pago
        'pedido_id',   // ID del pedido asociado
        'monto',       // Monto del pago
        'metodo_pago', // Método de pago utilizado
        'fecha_pago'   // Fecha en la que se realizó el pago
    ];

    /**
     * Relación con el modelo Usuario
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    /**
     * Relación con el modelo Pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}

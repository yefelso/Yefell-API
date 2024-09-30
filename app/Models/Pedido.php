<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'user_id',   // ID del usuario que realiza el pedido
        'total',     // Total del pedido
        'status',    // Estado del pedido
        'fecha_pedido' // Fecha en la que se realiza el pedido
    ];

    /**
     * Relación con el modelo Usuario
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    /**
     * Relación con la tabla Producto (a través de la tabla pivote)
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_productos')
                    ->withPivot('cantidad'); // Incluye cantidad en la relación
    }
}

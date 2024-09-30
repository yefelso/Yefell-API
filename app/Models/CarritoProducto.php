<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    use HasFactory;

    protected $table = 'carrito_productos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'carrito_id',   // ID del carrito
        'producto_id',  // ID del producto
        'cantidad',     // Cantidad del producto en el carrito
    ];

    /**
     * Relación con el modelo Carrito
     */
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }

    /**
     * Relación con el modelo Producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

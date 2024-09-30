<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carritos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'user_id', // ID del usuario que posee el carrito
        'total',   // Total del carrito
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
        return $this->belongsToMany(Producto::class, 'carrito_productos');
    }
}

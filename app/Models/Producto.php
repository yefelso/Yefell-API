<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre',        // Nombre del producto
        'descripcion',   // Descripción del producto
        'precio',        // Precio del producto
        'stock',         // Stock disponible del producto
        'imagen',        // Imagen del producto
    ];

    /**
     * Relación con la tabla Carrito (si aplica)
     */
    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'carrito_productos');
    }

    /**
     * Relación con la tabla Pedidos (si aplica)
     */
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_productos');
    }
}

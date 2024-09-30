<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;

    protected $table = 'producto_categorias'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'producto_id',    // ID del producto
        'categoria_id'    // ID de la categoría
    ];

    /**
     * Relación con el modelo Producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    /**
     * Relación con el modelo Categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}

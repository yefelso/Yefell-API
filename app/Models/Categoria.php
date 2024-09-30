<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre',        // Nombre de la categoría
        'descripcion'    // Descripción de la categoría
    ];

    /**
     * Relación con el modelo Producto
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_categorias', 'categoria_id', 'producto_id');
    }
}

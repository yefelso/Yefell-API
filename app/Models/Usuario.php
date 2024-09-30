<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',     // Nombre del usuario
        'email',    // Email del usuario
        'password', // Contraseña
        'role',     // Rol del usuario
    ];

    /**
     * Relación con la tabla Carritos
     */
    public function carritos()
    {
        return $this->hasMany(Carrito::class);
    }

    /**
     * Relación con la tabla Pedidos
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Relación con la tabla Pagos
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}

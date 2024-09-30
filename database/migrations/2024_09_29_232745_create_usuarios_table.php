<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Campo de ID automático.
            $table->string('name'); // Nombre del usuario.
            $table->string('email')->unique(); // Email único.
            $table->string('password'); // Contraseña encriptada.
            $table->enum('role', ['admin', 'customer'])->default('customer'); // Rol del usuario.
            $table->timestamps(); // Campos created_at y updated_at automáticos.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}

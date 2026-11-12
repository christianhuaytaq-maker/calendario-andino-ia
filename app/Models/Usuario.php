<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Le decimos a Laravel el nombre exacto de tu tabla
    protected $table = 'usuarios';

    // Permitimos que Laravel guarde datos en estas columnas
    protected $fillable = [
        'nombre', 'apellido', 'dni', 'email', 'telefono',
        'password', 'rol', 'estado'
    ];
}

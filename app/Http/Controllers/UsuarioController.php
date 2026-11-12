<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        // Contamos cuántos usuarios hay en tu tabla
        $cantidad = Usuario::count();

        return "¡Conexión exitosa! Hay " . $cantidad . " usuarios registrados en la base de datos.";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConexionController extends Controller
{
    /**
     * Muestra el estado de conexión con la base de datos
     * y verifica si el usuario tiene sesión activa.
     */
    public function index()
    {
        $mensaje = '';
        $estado = false;

        try {
            // Verificar conexión a la base de datos
            DB::connection()->getPdo();
            $estado = true;
            $mensaje = "✅ Conexión establecida correctamente con la base de datos.";
        } catch (\Exception $e) {
            $mensaje = "❌ Error al conectar con la base de datos: " . $e->getMessage();
        }

        // Verificar sesión
        $usuario = Session::get('usuario') ?? null;

        return view('conexion', [
            'estado' => $estado,
            'mensaje' => $mensaje,
            'usuario' => $usuario
        ]);
    }
}
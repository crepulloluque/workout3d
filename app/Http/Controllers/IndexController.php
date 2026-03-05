<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Progreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        // Obtener primeros 4 productos para recomendados
        $productos = Producto::orderBy('id', 'asc')->limit(4)->get();

        // Datos usuario si está logueado (para prefill calculadora)
        $datos = null;
        $progress_json = '[]';
        $rutinas = collect(); // Inicializar como colección vacía
        
        if (Session::has('usuario_id')) {
            $usuario_id = Session::get('usuario_id');
            
            // Datos básicos
            $usuario = \App\Models\Usuario::find($usuario_id);
            if ($usuario) {
                $datos = (object)[
                    'edad' => $usuario->edad,
                    'peso' => $usuario->peso,
                    'altura' => $usuario->altura,
                ];
            }

            // Últimos 7 registros de progreso para gráfico
            $progresos = Progreso::where('usuario_id', $usuario_id)
                ->orderBy('fecha', 'desc')
                ->limit(7)
                ->get(['fecha', 'peso'])
                ->reverse();

            $progress_json = json_encode($progresos);

            // Rutinas del usuario (ordenadas por fecha de creación descendente)
            $rutinas = \App\Models\Rutina::where('usuario_id', $usuario_id)
                ->orderBy('fecha_creacion', 'desc')
                ->get();
        }

        // Manejar mensajes de toast desde session
        $toast_msg = session('toast_msg', '');
        $toast_type = session('toast_type', 'info');

        return view('index', compact('productos', 'datos', 'progress_json', 'rutinas', 'toast_msg', 'toast_type'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Progreso;

class ProgresoController extends Controller
{
    /**
     * Muestra la página de progreso con historial.
     */
    public function index()
    {
        // ✅ Verificar sesión ANTES de mostrar
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth')
                ->with('mensaje_login', '🔐 Inicia sesión para ver tu progreso.');
        }

        $usuario_id = Session::get('usuario_id');
        
        // Obtener todos los progresos del usuario
        $progresos = Progreso::where('usuario_id', $usuario_id)
            ->orderBy('fecha', 'desc')
            ->get();

        // Obtener últimos 7 para gráfico
        $progress_json = Progreso::where('usuario_id', $usuario_id)
            ->orderBy('fecha', 'desc')
            ->limit(7)
            ->get(['fecha', 'peso'])
            ->reverse()
            ->values();

        return view('progreso', compact('progresos', 'progress_json'));
    }

    /**
     * Guarda un nuevo registro de progreso.
     */
    public function store(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth')
                ->with('mensaje_login', '🔐 Inicia sesión para guardar tu progreso.');
        }

        $usuario_id = Session::get('usuario_id');

        Progreso::create([
            'usuario_id' => $usuario_id,
            'fecha' => $request->input('fecha', now()),
            'peso' => $request->input('peso'),
            'grasa' => $request->input('grasa'),
            'musculo' => $request->input('musculo'),
            'imc' => $request->input('imc'),
        ]);

        return redirect()->route('progreso')->with(['toast_msg' => '✅ Progreso registrado correctamente', 'toast_type' => 'success']);
    }

    /**
     * Elimina un registro de progreso.
     */
    public function eliminar($id)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth')
                ->with('mensaje_login', '🔐 Inicia sesión para gestionar tu progreso.');
        }

        $usuario_id = Session::get('usuario_id');

        Progreso::where('id', $id)
            ->where('usuario_id', $usuario_id)
            ->delete();

        return redirect()->route('progreso')->with(['toast_msg' => '🗑️ Registro eliminado', 'toast_type' => 'success']);
    }
}
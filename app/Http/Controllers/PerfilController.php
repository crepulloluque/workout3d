<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller
{
    /**
     * Muestra la página de perfil del usuario.
     */
    public function index()
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');
        
        $usuario = DB::table('usuarios')
            ->where('id', $usuario_id)
            ->first();

        $progreso = DB::table('progreso')
            ->where('usuario_id', $usuario_id)
            ->orderBy('fecha', 'desc')
            ->first();

        return view('perfil', compact('usuario', 'progreso'));
    }

    /**
     * Actualiza los datos del perfil del usuario.
     */
    public function update(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');

        $usuarioActual = DB::table('usuarios')->where('id', $usuario_id)->first();

        DB::table('usuarios')->where('id', $usuario_id)->update([
            'usuario' => $request->input('usuario', $usuarioActual->usuario),
            'email' => $request->filled('email') ? $request->input('email') : $usuarioActual->email,
            'edad' => $request->input('edad', $usuarioActual->edad),
            'peso' => $request->input('peso', $usuarioActual->peso),
            'altura' => $request->input('altura', $usuarioActual->altura),
            'updated_at' => now(),
        ]);

        return redirect()->route('index')->with('success', 'Perfil actualizado correctamente.');
    }
}
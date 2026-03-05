<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MisComprasController extends Controller
{
    /**
     * Muestra todas las compras del usuario logueado.
     */
    public function index()
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');

        $compras = DB::table('compras')
            ->where('usuario_id', $usuario_id)
            ->orderBy('fecha_compra', 'desc')
            ->get();

        $detalles = [];
        foreach ($compras as $compra) {
            $detalles[$compra->id] = DB::table('compra_detalles')
                ->join('productos', 'compra_detalles.producto_id', '=', 'productos.id')
                ->where('compra_detalles.compra_id', $compra->id)
                ->select('productos.nombre as producto_nombre', 'productos.imagen_url', 
                         'compra_detalles.cantidad', 'compra_detalles.precio_unitario', 
                         'compra_detalles.subtotal')
                ->get();
        }

        return view('mis_compras', compact('compras', 'detalles'));
    }
}
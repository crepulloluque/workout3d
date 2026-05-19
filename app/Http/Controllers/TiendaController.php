<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TiendaController extends Controller
{
    /**
     * Muestra todos los productos con opción de filtrar por categoría.
     */
    public function index(Request $request)
    {
        $categoria = $request->get('categoria', '');
        
        if ($categoria && in_array($categoria, ['Proteína','Creatina','Vitaminas','Accesorios'])) {
            $productos = DB::table('productos')->where('categoria', $categoria)->get();
        } else {
            $productos = DB::table('productos')->orderBy('id', 'asc')->get();
        }

        $toast_msg = '';
        $toast_type = 'info';

        if (request()->has('msg')) {
            switch (request('msg')) {
                case 'carrito_vacio':
                    $toast_msg = '🛒 Tu carrito está vacío.';
                    $toast_type = 'info';
                    break;
                case 'producto_agregado':
                    $toast_msg = '✅ Producto añadido al carrito.';
                    $toast_type = 'success';
                    break;
                case 'producto_eliminado':
                    $toast_msg = '🗑️ Producto eliminado del carrito.';
                    $toast_type = 'success';
                    break;
            }
        }

        return view('tienda', compact('productos', 'toast_msg', 'toast_type', 'categoria'));
    }

    /**
     * Agrega un producto al carrito (sesión).
     */
    public function agregarAlCarrito(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth')
                ->with('mensaje_login', '🔐 Inicia sesión para añadir productos al carrito.');
        }

        $id = (int)$request->input('producto_id');
        
        $producto = DB::table('productos')
            ->select('id', 'nombre', 'precio', 'imagen_url')
            ->where('id', $id)
            ->first();

        if ($producto) {
            $carrito = Session::get('carrito', []);
            
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad']++;
            } else {
                $carrito[$id] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'imagen' => $producto->imagen_url,
                    'cantidad' => 1
                ];
            }
            
            Session::put('carrito', $carrito);
        }

        return redirect()->route('tienda', ['msg' => 'producto_agregado']);
    }

    /**
     * Elimina un producto del carrito.
     */
    public function eliminarDelCarrito(Request $request, $id)
    {
        if (!$request->isMethod('post')) {
            abort(405);
        }

        $carrito = Session::get('carrito', []);
        
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            Session::put('carrito', $carrito);
        }

        return redirect()->route('tienda', ['msg' => 'producto_eliminado']);
    }

    /**
     * Vacía el carrito completo.
     */
    public function vaciarCarrito(Request $request)
    {
        if (!$request->isMethod('post')) {
            abort(405);
        }

        Session::forget('carrito');
        return redirect()->route('tienda', ['msg' => 'carrito_vacio']);
    }

    /**
     * Muestra el carrito de compras.
     */
    public function verCarrito()
    {
        $carrito = Session::get('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('carrito', compact('carrito', 'total'));
    }
}
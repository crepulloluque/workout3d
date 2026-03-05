<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CompraController extends Controller
{
    /**
     * Muestra la página de checkout.
     */
    public function checkout()
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        if (empty(Session::get('carrito'))) {
            return redirect()->route('tienda');
        }

        return view('checkout');
    }

    /**
     * Procesa la compra final.
     */
    public function procesar(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('tienda')->with('mensaje_compra', '⚠️ Tu carrito está vacío.');
        }

        // Validar campos
        $validated = $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'pais' => 'required|string',
            'provincia' => 'required|string',
            'codigo_postal' => 'required|string',
            'tipo_entrega' => 'required|in:recogida,domicilio,express',
            'metodo_pago' => 'required|in:tarjeta,bizum,paypal',
        ]);

        // Calcular total
        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        // Insertar compra
        $compra_id = DB::table('compras')->insertGetId([
            'usuario_id' => $usuario_id,
            'nombre' => $validated['nombre'],
            'apellidos' => $validated['apellidos'],
            'telefono' => $validated['telefono'],
            'direccion_envio' => $validated['direccion'],
            'pais' => $validated['pais'],
            'provincia' => $validated['provincia'],
            'codigo_postal' => $validated['codigo_postal'],
            'tipo_entrega' => $validated['tipo_entrega'],
            'metodo_pago' => $validated['metodo_pago'],
            'total' => $total,
            'fecha_compra' => now(),
        ]);

        // Insertar detalles de compra
        foreach ($carrito as $id => $producto) {
            DB::table('compra_detalles')->insert([
                'compra_id' => $compra_id,
                'producto_id' => $id,
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio'],
                'subtotal' => $producto['precio'] * $producto['cantidad'],
            ]);
        }

        // Vaciar carrito
        Session::forget('carrito');

        return redirect()->route('mis_compras')
            ->with('mensaje_compra', '✅ ¡Compra realizada con éxito! Tu pedido #' . $compra_id . ' será procesado pronto.');
    }
}
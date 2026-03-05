<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    // Middleware: Verificar que es admin
    private function verificarAdmin()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Acceso denegado');
        }
        return null;
    }

    // Login view
    public function loginForm()
    {
        if (Session::has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Login POST
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        $admin = DB::table('administradores')
            ->where('usuario', $request->usuario)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_usuario', $admin->usuario);
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenido, ' . $admin->usuario);
        }

        return redirect()->route('admin.login')->with('error', 'Credenciales incorrectas');
    }

    // Logout
    public function logout()
    {
        Session::forget(['admin_id', 'admin_usuario']);
        return redirect()->route('admin.login')->with('success', 'Sesión cerrada');
    }

    // Dashboard
    public function dashboard()
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        $stats = [
            'usuarios' => DB::table('usuarios')->count(),
            'ejercicios' => DB::table('ejercicios')->count(),
            'productos' => DB::table('productos')->count(),
            'rutinas' => DB::table('rutinas')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // ===== EJERCICIOS =====
    public function ejercicios()
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        $ejercicios = DB::table('ejercicios as e')
            ->join('musculos as m', 'e.musculo_id', '=', 'm.id')
            ->select('e.*', 'm.nombre as musculo_nombre')
            ->orderBy('e.id', 'desc')
            ->get();

        $musculos = DB::table('musculos')->get();

        return view('admin.ejercicios', compact('ejercicios', 'musculos'));
    }

    public function crearEjercicio(Request $request)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('ejercicios')->insert([
            'musculo_id' => $request->musculo_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'video_url' => $request->video_url,
            'dificultad' => $request->dificultad,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.ejercicios')->with('success', 'Ejercicio creado');
    }

    public function editarEjercicio(Request $request, $id)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('ejercicios')->where('id', $id)->update([
            'musculo_id' => $request->musculo_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'video_url' => $request->video_url,
            'dificultad' => $request->dificultad,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.ejercicios')->with('success', 'Ejercicio actualizado');
    }

    public function eliminarEjercicio($id)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('ejercicios')->where('id', $id)->delete();

        return redirect()->route('admin.ejercicios')->with('success', 'Ejercicio eliminado');
    }

    // ===== USUARIOS =====
    public function usuarios()
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        $usuarios = DB::table('usuarios')->orderBy('id', 'desc')->get();

        return view('admin.usuarios', compact('usuarios'));
    }

    public function eliminarUsuario($id)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('usuarios')->where('id', $id)->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado');
    }

    // ===== PRODUCTOS =====
    public function productos()
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        $productos = DB::table('productos')->orderBy('id', 'desc')->get();

        return view('admin.productos', compact('productos'));
    }

    public function crearProducto(Request $request)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen_url' => $request->imagen_url,
            'categoria' => $request->categoria,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.productos')->with('success', 'Producto creado');
    }

    public function editarProducto(Request $request, $id)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('productos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen_url' => $request->imagen_url,
            'categoria' => $request->categoria,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.productos')->with('success', 'Producto actualizado');
    }

    public function eliminarProducto($id)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('productos')->where('id', $id)->delete();

        return redirect()->route('admin.productos')->with('success', 'Producto eliminado');
    }

    // ===== RUTINAS =====
    public function rutinas()
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        $rutinas = DB::table('rutinas as r')
            ->join('usuarios as u', 'r.usuario_id', '=', 'u.id')
            ->select('r.*', 'u.usuario as usuario_nombre')
            ->orderBy('r.id', 'desc')
            ->get();

        return view('admin.rutinas', compact('rutinas'));
    }

    public function eliminarRutina($id)
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        DB::table('rutinas')->where('id', $id)->delete();

        return redirect()->route('admin.rutinas')->with('success', 'Rutina eliminada');
    }

    public function pedidos()
    {
        if ($redirect = $this->verificarAdmin()) return $redirect;

        $query = DB::table('compras as c')
            ->leftJoin('usuarios as u', 'c.usuario_id', '=', 'u.id')
            ->select('c.*', 'u.usuario as usuario_nombre');

        if (Schema::hasColumn('compras', 'producto_id')) {
            $query->leftJoin('productos as p', 'c.producto_id', '=', 'p.id')
                  ->addSelect('p.nombre as producto_nombre');
        } else {
            if (Schema::hasColumn('compras', 'producto')) {
                $query->addSelect(DB::raw('c.producto as producto_nombre'));
            } elseif (Schema::hasColumn('compras', 'producto_nombre')) {
                $query->addSelect(DB::raw('c.producto_nombre as producto_nombre'));
            } else {
                $query->addSelect(DB::raw('NULL as producto_nombre'));
            }
        }

        $pedidos = $query->orderBy('c.fecha_compra', 'desc')->get();

        return view('admin.pedidos', compact('pedidos'));
    }
}

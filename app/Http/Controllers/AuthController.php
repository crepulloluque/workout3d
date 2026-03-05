<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Muestra la vista de autenticación (login / registro)
     */
    public function index()
    {
        return view('auth');
    }

    /**
     * Maneja el inicio de sesión
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->with('mensaje_login', '❌ Email o contraseña inválido.');
        }

        $usuario = Usuario::where('email', $request->input('email'))->first();

        if (!$usuario || !Hash::check($request->input('password'), $usuario->password)) {
            return back()->with('mensaje_login', '❌ Email o contraseña inválido.');
        }

        Session::put('usuario_id', $usuario->id);
        Session::put('usuario', $usuario->usuario);

        return redirect()->route('index')->with('mensaje_login', '✅ Sesión iniciada correctamente.');
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout()
    {
        Session::flush();

        return redirect()->route('index')
            ->with([
                'toast_msg' => '👋 Sesión cerrada correctamente',
                'toast_type' => 'success',
                'clear_cart' => true // Flag para limpiar carrito
            ]);
    }

    /**
     * Redirigir a Google OAuth
     */
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback de Google OAuth
     */
    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        }
        catch (\Exception $e) {
            return redirect()->route('auth')->with('mensaje_login', '❌ No se pudo iniciar sesión con Google.');
        }

        $usuario = Usuario::where('email', $googleUser->getEmail())->first();

        // Si no existe, crear (registro automático)
        if (!$usuario) {
            $usuario = Usuario::create([
                'usuario' => $googleUser->getName() ?: explode('@', $googleUser->getEmail())[0],
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(uniqid('google_', true)),
            ]);
        }

        Session::put('usuario_id', $usuario->id);
        Session::put('usuario', $usuario->usuario);

        return redirect()->route('index')->with('toast_msg', '✅ Sesión iniciada con Google.')->with('toast_type', 'success');
    }

    // ===== GITHUB OAUTH =====
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            // Buscar o crear usuario
            $usuario = DB::table('usuarios')
                ->where('email', $githubUser->email)
                ->first();

            if (!$usuario) {
                DB::table('usuarios')->insert([
                    'usuario' => $githubUser->nickname ?? $githubUser->name,
                    'email' => $githubUser->email,
                    'password' => bcrypt(Str::random(16)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $usuario = DB::table('usuarios')
                    ->where('email', $githubUser->email)
                    ->first();
            }

            session([
                'usuario_id' => $usuario->id,
                'usuario' => $usuario->usuario,
                'email' => $usuario->email,
            ]);

            return redirect()->route('index')->with([
                'toast_msg' => '✅ Sesión iniciada con GitHub correctamente.',
                'toast_type' => 'success'
            ]);

        }
        catch (\Exception $e) {
            return redirect()->route('auth')->with([
                'toast_msg' => '❌ Error al iniciar sesión con GitHub: ' . $e->getMessage(),
                'toast_type' => 'error'
            ]);
        }
    }

    /**
     * Maneja el registro de nuevos usuarios
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',
            'edad' => 'nullable|integer|min:10|max:120',
            'peso' => 'nullable|numeric|min:30|max:300',
            'altura' => 'nullable|numeric|min:100|max:250',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('mensaje_registro', '❌ Error en el registro. Revisa los datos.');
        }

        $usuario = Usuario::create([
            'usuario' => $request->usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'edad' => $request->edad,
            'peso' => $request->peso,
            'altura' => $request->altura,
        ]);

        Session::put('usuario_id', $usuario->id);
        Session::put('usuario', $usuario->usuario);

        return redirect()->route('index')->with('toast_msg', '✅ Cuenta creada con éxito. ¡Bienvenido!');
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\BicepsController;
use App\Http\Controllers\PechoController;
use App\Http\Controllers\AbdomenController;
use App\Http\Controllers\EspadaController;
use App\Http\Controllers\TricepsController;
use App\Http\Controllers\PiernasController;
use App\Http\Controllers\HombrosController;
use App\Http\Controllers\MisComprasController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;

// Página principal
Route::get('/', [IndexController::class, 'index'])->name('index');

// Autenticación
Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:3,1')->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Verificación de email
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

// OAuth Google
Route::get('/auth/google/redirect', [AuthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('google.callback');

// OAuth GitHub
Route::get('/auth/github/redirect', [AuthController::class, 'githubRedirect'])->name('github.redirect');
Route::get('/auth/github/callback', [AuthController::class, 'githubCallback'])->name('github.callback');

// Tienda
Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda');
Route::post('/tienda/agregar', [TiendaController::class, 'agregarAlCarrito'])->name('tienda.agregar');
Route::get('/tienda/eliminar/{id}', [TiendaController::class, 'eliminarDelCarrito'])->name('tienda.eliminar');
Route::get('/tienda/vaciar', [TiendaController::class, 'vaciarCarrito'])->name('tienda.vaciar');

// Recursos
Route::get('/recursos', [RecursosController::class, 'index'])->name('recursos');

// Progreso
Route::get('/progreso', [ProgresoController::class, 'index'])->name('progreso');
Route::post('/progreso', [ProgresoController::class, 'store'])->name('progreso.store');
Route::delete('/progreso/{id}', [ProgresoController::class, 'eliminar'])->name('progreso.eliminar');

// Perfil
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

// Músculos
Route::get('/biceps', [BicepsController::class, 'index'])->name('biceps');
Route::get('/pecho', [PechoController::class, 'index'])->name('pecho');
Route::get('/abdomen', [AbdomenController::class, 'index'])->name('abdomen');
Route::get('/espalda', [EspadaController::class, 'index'])->name('espalda');
Route::get('/triceps', [TricepsController::class, 'index'])->name('triceps');
Route::get('/piernas', [PiernasController::class, 'index'])->name('piernas');
Route::get('/hombros', [HombrosController::class, 'index'])->name('hombros');

// Compras
Route::get('/checkout', [CompraController::class, 'checkout'])->name('checkout');
Route::post('/procesar_compra', [CompraController::class, 'procesar'])->name('procesar_compra');
Route::get('/mis_compras', [MisComprasController::class, 'index'])->name('mis_compras');

// Rutinas
Route::get('/crear_rutina', [RutinaController::class, 'crear'])->name('crear_rutina');
Route::post('/crear_rutina', [RutinaController::class, 'guardar'])->name('crear_rutina.guardar');
Route::get('/editar_rutina', [RutinaController::class, 'editar'])->name('editar_rutina');
Route::post('/editar_rutina/guardar', [RutinaController::class, 'guardarEditar'])->name('editar_rutina.guardar');
Route::delete('/rutina/{id}', [RutinaController::class, 'eliminar'])->name('rutina.eliminar');
Route::get('/rutina/{id}/iniciar', [RutinaController::class, 'iniciar'])->name('rutina.iniciar');
Route::get('/rutina/{id}/pdf', [RutinaController::class, 'exportPdf'])->name('rutina.pdf');
Route::post('/rutina/finalizar', [RutinaController::class, 'finalizar'])->name('rutina.finalizar');
Route::post('/rutina/guardar-orden', [RutinaController::class, 'guardarOrden'])->name('rutina.guardar_orden');

// ===== RUTAS DE ADMINISTRACIÓN =====
Route::prefix('admin')->name('admin.')->group(function () {
    // Login admin
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    // Dashboard y gestión (requieren autenticación)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Ejercicios
    Route::get('/ejercicios', [AdminController::class, 'ejercicios'])->name('ejercicios');
    Route::post('/ejercicios/crear', [AdminController::class, 'crearEjercicio'])->name('ejercicios.crear');
    Route::post('/ejercicios/{id}/editar', [AdminController::class, 'editarEjercicio'])->name('ejercicios.editar');
    Route::delete('/ejercicios/{id}', [AdminController::class, 'eliminarEjercicio'])->name('ejercicios.eliminar');

    // Usuarios
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
    Route::delete('/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])->name('usuarios.eliminar');

    // Productos
    Route::get('/productos', [AdminController::class, 'productos'])->name('productos');
    Route::post('/productos/crear', [AdminController::class, 'crearProducto'])->name('productos.crear');
    Route::post('/productos/{id}/editar', [AdminController::class, 'editarProducto'])->name('productos.editar');
    Route::delete('/productos/{id}', [AdminController::class, 'eliminarProducto'])->name('productos.eliminar');

    // Rutinas
    Route::get('/rutinas', [AdminController::class, 'rutinas'])->name('rutinas');
    Route::delete('/rutinas/{id}', [AdminController::class, 'eliminarRutina'])->name('rutinas.eliminar');

    // Pedidos
    Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('pedidos');
});
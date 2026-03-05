@extends('layouts.master')

@section('title', 'Login / Registro - Workout 3D')

@section('content')
<div class="auth-container">
    <div class="auth-box">
        <header class="auth-header">
            <h1>Workout <span style="color:var(--accent)">3D</span></h1>
            <p style="color:var(--muted); margin-top:10px;">Tu evolución comienza aquí.</p>
        </header>

        @if(session('mensaje_login') || session('mensaje_registro'))
            <div style="padding:12px; border-radius:8px; background:rgba(0,180,216,0.1); border:1px solid var(--accent); color:var(--accent); margin-bottom:20px;">
                {{ session('mensaje_login') ?? session('mensaje_registro') }}
            </div>
        @endif

        <div class="auth-tabs">
            <button id="tab-login" class="tab-btn active" onclick="showForm('login')">Entrar</button>
            <button id="tab-registro" class="tab-btn" onclick="showForm('registro')">Registrarse</button>
        </div>

        {{-- LOGIN --}}
        <form id="form-login" method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="email_login">Correo Electrónico</label>
                <input id="email_login" type="email" name="email" required placeholder="tu@email.com">
            </div>

            <div class="form-group">
                <label for="password_login">Contraseña</label>
                <input id="password_login" type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:20px;">⚡ Iniciar Sesión</button>
        </form>

        {{-- REGISTRO --}}
        <form id="form-registro" method="POST" action="{{ route('register') }}" class="auth-form" style="display:none;">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="usuario_registro">Nombre de Usuario</label>
                    <input id="usuario_registro" type="text" name="usuario" required placeholder="Ej: Spartan7">
                </div>

                <div class="form-group">
                    <label for="email_registro">Email</label>
                    <input id="email_registro" type="email" name="email" required placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label for="password_registro">Contraseña</label>
                    <input id="password_registro" type="password" name="password" required placeholder="Mín. 6 caracteres">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repite tu clave">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px; margin-top:20px;">
                <div class="form-group">
                    <label for="edad_registro">Edad</label>
                    <input id="edad_registro" type="number" name="edad" min="10" max="120" placeholder="Años">
                </div>
                <div class="form-group">
                    <label for="peso_registro">Peso (kg)</label>
                    <input id="peso_registro" type="number" name="peso" step="0.1" min="30" max="300" placeholder="kg">
                </div>
                <div class="form-group">
                    <label for="altura_registro">Altura (cm)</label>
                    <input id="altura_registro" type="number" name="altura" step="0.1" min="100" max="250" placeholder="cm">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:30px;">🔥 Crear Cuenta</button>
        </form>

        <div style="margin:25px 0; text-align:center; color:var(--muted); position:relative;">
            <span style="background:var(--card); padding:0 10px; position:relative; z-index:1;">O accede con</span>
            <div style="position:absolute; top:50%; left:0; right:0; height:1px; background:rgba(255,255,255,0.1);"></div>
        </div>

        <div style="display:flex; gap:10px;">
            <a href="{{ route('google.redirect') }}" class="btn" style="width:100%; background:#4285F4; color:#fff; text-align:center; text-decoration:none;">
                Google
            </a>
            <a href="{{ route('github.redirect') }}" class="btn" style="width:100%; background:#333; color:#fff; text-align:center; text-decoration:none;">
                GitHub
            </a>
        </div>
    </div>
</div>

<script>
    function showForm(mode) {
        const loginForm = document.getElementById('form-login');
        const registerForm = document.getElementById('form-registro');
        const loginTab = document.getElementById('tab-login');
        const registerTab = document.getElementById('tab-registro');

        if (mode === 'login') {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
        } else {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            loginTab.classList.remove('active');
            registerTab.classList.add('active');
        }
    }
</script>
@endsection

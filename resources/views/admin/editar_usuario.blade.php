@extends('admin.layout')

@section('title', 'Editar Usuario')

@section('content')
    <h1>✏️ Editar Usuario</h1>

    <form method="POST" action="{{ route('admin.usuarios.actualizar', $usuario->id) }}" style="max-width:600px; background:var(--card); padding:20px; border-radius:12px;">
        @csrf
        @method('PUT')

        <label style="display:block;margin-top:10px;color:var(--muted);">Nombre de Usuario</label>
        <input type="text" name="usuario" value="{{ $usuario->usuario }}" required style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Email</label>
        <input type="email" name="email" value="{{ $usuario->email }}" required style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Contraseña (dejar en blanco para no cambiar)</label>
        <input type="password" name="password" style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Edad</label>
        <input type="number" name="edad" value="{{ $usuario->edad }}" min="10" max="120" style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Peso (kg)</label>
        <input type="number" name="peso" value="{{ $usuario->peso }}" step="0.1" min="30" max="150" style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Altura (cm)</label>
        <input type="number" name="altura" value="{{ $usuario->altura }}" step="0.1" min="100" max="250" style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <button type="submit" class="btn" style="margin-top:10px;">💾 Guardar Cambios</button>
        <a href="{{ route('admin.usuarios') }}" class="btn" style="background:gray;margin-left:10px;text-decoration:none;display:inline-block;padding:8px 12px;border-radius:6px;">Cancelar</a>
    </form>
@endsection

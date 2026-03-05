@extends('admin.layout')

@section('title', 'Crear Producto')

@section('content')
    <h1>➕ Crear Producto</h1>

    <form method="POST" action="{{ route('admin.productos.guardar') }}" style="max-width:600px; background:var(--card); padding:20px; border-radius:12px;">
        @csrf

        <label style="display:block;margin-top:10px;color:var(--muted);">Nombre</label>
        <input type="text" name="nombre" required style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Descripción</label>
        <textarea name="descripcion" rows="4" style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;"></textarea>

        <label style="display:block;margin-top:10px;color:var(--muted);">Precio (€)</label>
        <input type="number" name="precio" step="0.01" required style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">URL Imagen</label>
        <input type="url" name="imagen_url" required style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">

        <label style="display:block;margin-top:10px;color:var(--muted);">Categoría</label>
        <select name="categoria" required style="width:100%;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:var(--text);margin-bottom:15px;">
            <option value="Proteína">Proteína</option>
            <option value="Creatina">Creatina</option>
            <option value="Vitaminas">Vitaminas</option>
            <option value="Accesorios">Accesorios</option>
        </select>

        <button type="submit" class="btn" style="margin-top:10px;">✅ Crear Producto</button>
        <a href="{{ route('admin.productos') }}" class="btn" style="background:gray;margin-left:10px;text-decoration:none;display:inline-block;padding:8px 12px;border-radius:6px;">Cancelar</a>
    </form>
@endsection

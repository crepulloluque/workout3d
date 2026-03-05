@extends('layouts.master')

@section('title', 'Perfil de Atleta - Workout 3D')

@section('content')
    <div class="perfil-main">
        <div class="perfil-container glass-panel">
            <h2 class="font-heading">👤 Perfil de <span class="text-accent">{{ $usuario->usuario }}</span></h2>

            @if (session('msg'))
                <div class="glass-panel animate-fadeIn" style="padding:15px; margin-bottom: 25px; border-left:4px solid var(--success); color:var(--success); font-weight:700;">
                    {{ session('msg') }}
                </div>
            @endif

            <form method="POST" action="{{ route('perfil.update') }}" class="animate-fadeIn">
                @csrf
                <div class="form-group">
                    <label for="usuario">Identidad de Guerrero</label>
                    <input type="text" id="usuario" name="usuario" value="{{ $usuario->usuario ?? '' }}" required placeholder="Tu nombre de usuario">
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico (Privado)</label>
                    <input type="email" id="email" value="{{ $usuario->email ?? '' }}" readonly disabled>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                    <div class="form-group">
                        <label for="edad">Edad (Años)</label>
                        <input type="number" id="edad" name="edad" value="{{ $usuario->edad ?? '' }}" min="10" max="120" placeholder="Años">
                    </div>

                    <div class="form-group">
                        <label for="peso">Masa Corporal (kg)</label>
                        <input type="number" id="peso" name="peso" value="{{ $usuario->peso ?? '' }}" step="0.1" placeholder="kg">
                    </div>
                </div>

                <div class="form-group">
                    <label for="altura">Estatura Directa (cm)</label>
                    <input type="number" id="altura" name="altura" value="{{ $usuario->altura ?? '' }}" step="0.1" placeholder="cm">
                </div>

                <button type="submit" class="btn btn-primary">⚡ Actualizar Biometría</button>
            </form>

            @if ($progreso ?? false)
                <div class="perfil-info animate-fadeInUp">
                    <h3 class="font-heading">📈 Estado Físico Actual</h3>
                    <table>
                        <tr><th>Última Medición</th><td>{{ \Illuminate\Support\Carbon::parse($progreso->fecha)->format('d M, Y') }}</td></tr>
                        <tr><th>Peso</th><td>{{ $progreso->peso }} kg</td></tr>
                        <tr><th>Grasa Corporal</th><td>{{ $progreso->grasa }}%</td></tr>
                        <tr><th>Masa Muscular</th><td>{{ $progreso->musculo }}%</td></tr>
                        <tr><th>Índice Masa (IMC)</th><td>{{ $progreso->imc }}</td></tr>
                    </table>
                </div>
            @endif

            <div style="text-align:center; margin-top:40px;">
                <a href="{{ route('index') }}" class="volver-perfil">← Regresar al Portal Central</a>
            </div>
        </div>
    </div>
@endsection



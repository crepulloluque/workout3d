@extends('layouts.master')

@section('title', 'Crear Rutina - Workout 3D')

@section('content')
<div style="max-width:1200px; margin:40px auto; padding:30px; background:rgba(255,255,255,0.02); border-radius:16px; border:1px solid rgba(255,255,255,0.05); box-shadow:0 20px 60px rgba(0,0,0,0.6); animation:fadeInUp 0.8s ease-out;">
    <header style="text-align:center; margin-bottom:40px;">
        <h1 style="font-family:'Oswald',sans-serif; color:var(--accent); font-size:2.8rem; margin-bottom:10px; animation:fadeInUp 0.8s ease-out;">💪 {{ $nombre }}</h1>
        @if($descripcion)
            <p style="color:var(--muted); font-size:1.05rem; font-style:italic; animation:fadeInUp 0.8s ease-out 0.1s both;">"{{ $descripcion }}"</p>
        @endif
        <p style="color:var(--muted); font-size:0.9rem; margin-top:15px; animation:fadeInUp 0.8s ease-out 0.2s both;">Selecciona un día, elige tus ejercicios y configura series/repeticiones</p>
    </header>

    <form method="POST" action="{{ route('crear_rutina.guardar') }}" style="animation:fadeInUp 0.8s ease-out 0.2s both;">
        @csrf
        <input type="hidden" name="nombre" value="{{ $nombre }}">
        <input type="hidden" name="descripcion" value="{{ $descripcion }}">

        <!-- Selector de días -->
        <div style="display:flex; gap:10px; margin-bottom:30px; flex-wrap:wrap; justify-content:center; background:rgba(255,255,255,0.01); padding:20px; border-radius:12px; border:1px solid rgba(255,255,255,0.02);">
            <label style="width:100%; color:var(--muted); font-size:0.9rem; text-align:center; margin-bottom:15px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">📅 SELECCIONA UN DÍA</label>
            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                <button type="button" class="btn-dia" data-dia="{{ $dia }}" style="padding:10px 18px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:10px; color:#fff; cursor:pointer; transition:all 0.3s ease; font-weight:600; font-size:0.95rem;">
                    {{ $dia }}
                </button>
            @endforeach
        </div>

        <!-- Contenedor de ejercicios por día -->
        <div id="contenedorDias">
            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                <div class="dia-container" id="dia-{{ $dia }}" style="display:none; background:rgba(255,255,255,0.01); padding:25px; border-radius:12px; border:1px solid rgba(255,255,255,0.05); animation:fadeInUp 0.5s ease-out;">
                    <div style="margin-bottom:25px; padding:15px; background:rgba(0,190,240,0.05); border-radius:10px; border-left:4px solid var(--accent);">
                        <label style="display:flex; align-items:center; gap:10px; color:var(--accent); font-weight:700; cursor:pointer;">
                            <input type="checkbox" name="descanso[]" value="{{ $dia }}" onchange="toggleDescanso('{{ $dia }}', this.checked)" style="width:20px; height:20px; cursor:pointer;">
                            ☕ Marcar como día de descanso (no aparecerá en la rutina)
                        </label>
                    </div>

                    <div class="ejercicios-container" id="ejercicios-{{ $dia }}">
                        @foreach($musculos as $musculo)
                            <h3 style="color:var(--accent); margin-top:25px; margin-bottom:15px; font-size:1.2rem; border-bottom:2px solid rgba(0,190,240,0.2); padding-bottom:10px;">💪 {{ $musculo->nombre }}</h3>
                            @forelse($musculo->ejercicios as $ej)
                                <div style="background:rgba(255,255,255,0.03); padding:15px; border-radius:8px; margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; border:1px solid rgba(255,255,255,0.05); transition:all 0.3s ease;">
                                    <label style="display:flex; align-items:center; gap:12px; flex:1; cursor:pointer;">
                                        <input type="checkbox" name="ejercicios[{{ $dia }}][]" value="{{ $ej->id }}" style="width:18px; height:18px; cursor:pointer;">
                                        <span style="color:#fff; font-weight:500;">{{ $ej->nombre }}</span>
                                    </label>
                                    <div style="display:flex; gap:10px; align-items:center;">
                                        <input type="number" name="series[{{ $dia }}][{{ $ej->id }}]" value="3" min="1" max="10" placeholder="Series" style="width:70px; padding:8px; border-radius:6px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; text-align:center; font-weight:600;">
                                        <span style="color:var(--accent); font-weight:700;">×</span>
                                        <input type="number" name="repeticiones[{{ $dia }}][{{ $ej->id }}]" value="10" min="1" max="50" placeholder="Reps" style="width:70px; padding:8px; border-radius:6px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; text-align:center; font-weight:600;">
                                    </div>
                                </div>
                            @empty
                                <p style="color:var(--muted); font-style:italic; padding:10px;">No hay ejercicios disponibles para este grupo muscular</p>
                            @endforelse
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div style="display:flex; gap:15px; margin-top:40px;">
            <button type="submit" class="btn" style="flex:1; padding:15px; background:linear-gradient(90deg, var(--accent), #1CAAD9); border:none; border-radius:10px; font-weight:700; cursor:pointer; font-size:1rem; transition:all 0.3s ease; box-shadow:0 8px 20px rgba(0,190,240,0.2);">✅ Crear Rutina</button>
            <a href="{{ route('index') }}" class="btn" style="flex:1; padding:15px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.2); border-radius:10px; text-align:center; text-decoration:none; font-weight:700; font-size:1rem; transition:all 0.3s ease;">← Cancelar</a>
        </div>
    </form>
</div>

<script>
    let diaActual = 'Lunes';

    document.addEventListener('DOMContentLoaded', () => {
        const botonesDia = document.querySelectorAll('.btn-dia');
        
        botonesDia.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.dia-container').forEach(el => el.style.display = 'none');
                botonesDia.forEach(b => {
                    b.style.background = 'rgba(255,255,255,0.05)';
                    b.style.color = '#fff';
                });
                
                const dia = this.getAttribute('data-dia');
                document.getElementById('dia-' + dia).style.display = 'block';
                this.style.background = 'linear-gradient(90deg, var(--accent), #1CAAD9)';
                this.style.color = '#000';
                
                diaActual = dia;
            });
        });

        // Activar primer día
        botonesDia[0].click();
    });

    function toggleDescanso(dia, esDescanso) {
        const container = document.getElementById('ejercicios-' + dia);
        if (esDescanso) {
            container.style.opacity = '0.4';
            container.style.pointerEvents = 'none';
            container.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        } else {
            container.style.opacity = '1';
            container.style.pointerEvents = 'auto';
        }
    }
</script>
@endsection

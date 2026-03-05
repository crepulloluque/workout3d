@extends('layouts.master')

@section('title', 'Ejercicios Espalda - Workout 3D')

@section('content')
    <section class="musculos-page">
        <header class="musculos-header">
            <h1>Ejercicios para Espalda</h1>
            <p class="musculos-subtitle">Aprende cómo entrenar espalda con estos ejercicios.</p>
        </header>

        <div class="musculos-container">
            <div class="embed-3d">
                <model-viewer 
                id="modelo" 
                src="{{ asset('model/espalda/espalda.glb') }}"
                alt="Modelo interactivo del cuerpo humano"
                camera-controls 
                auto-rotate 
                exposure="1.2" 
                shadow-intensity="1.5" 
                loading="lazy"
                ar 
                ar-modes="webxr scene-viewer quick-look">
                <div slot="poster" class="poster">Portal Dimensional Cargando...</div>
              </model-viewer>
            </div>

            <div class="musculos-search">
                <input id="buscadorEjercicios" class="glass-input" type="text" placeholder="🔎 Buscar ejercicio...">
            </div>

            @php $i = (($pagina - 1) * 4) + 1; @endphp
            @foreach ($ejercicios as $e)
                <article class="exercise card" data-nombre="{{ strtolower($e->nombre) }}">
                    <h2>{{ $i++ }}. {{ $e->nombre }}</h2>
                    <div class="video-container">
                        <iframe src="{{ $e->video_url }}" allowfullscreen></iframe>
                    </div>
                    <p>{{ $e->descripcion }}</p>
                </article>
            @endforeach

            <div class="pagination">
                @if($pagina > 1)
                    <a class="page-link" href="{{ route('espalda', ['pagina' => $pagina - 1]) }}">&laquo;</a>
                @else
                    <span class="disabled">&laquo;</span>
                @endif

                @for($p = 1; $p <= $totalPaginas; $p++)
                    <a class="page-link {{ $p == $pagina ? 'active' : '' }}" href="{{ route('espalda', ['pagina' => $p]) }}">{{ $p }}</a>
                @endfor

                @if($pagina < $totalPaginas)
                    <a class="page-link" href="{{ route('espalda', ['pagina' => $pagina + 1]) }}">&raquo;</a>
                @else
                    <span class="disabled">&raquo;</span>
                @endif
            </div>

            <div class="musculos-footer">
                <a href="{{ route('index') }}" class="volver">⬅️ Volver a la página principal</a>
            </div>
        </div>
    </section>

    <script>
        (function () {
            const input = document.getElementById('buscadorEjercicios');
            if (!input) return;
            const cards = Array.from(document.querySelectorAll('.exercise'));
            input.addEventListener('input', () => {
                const q = input.value.trim().toLowerCase();
                cards.forEach(card => {
                    const name = card.getAttribute('data-nombre') || '';
                    card.style.display = name.includes(q) ? '' : 'none';
                });
            });
        })();
    </script>
@endsection

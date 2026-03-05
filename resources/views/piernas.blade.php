@extends('layouts.master')

@section('title', 'Ejercicios Piernas - Workout 3D')

@section('content')
    <section class="musculos-page">
        <header class="musculos-header">
            <h1>Ejercicios para Piernas</h1>
            <p class="musculos-subtitle">Aprende cómo entrenar piernas con estos ejercicios.</p>
        </header>

        <div class="musculos-container">
            <div class="embed-3d">
                <iframe 
                    title="Piernas" 
                    allowfullscreen 
                    mozallowfullscreen="true" 
                    webkitallowfullscreen="true" 
                    allow="autoplay; fullscreen; xr-spatial-tracking"
                    src="https://sketchfab.com/models/91cbf0093e094a0e9df0d73636dfface/embed">
                </iframe>
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
                    <a class="page-link" href="{{ route('piernas', ['pagina' => $pagina - 1]) }}">&laquo;</a>
                @else
                    <span class="disabled">&laquo;</span>
                @endif

                @for($p = 1; $p <= $totalPaginas; $p++)
                    <a class="page-link {{ $p == $pagina ? 'active' : '' }}" href="{{ route('piernas', ['pagina' => $p]) }}">{{ $p }}</a>
                @endfor

                @if($pagina < $totalPaginas)
                    <a class="page-link" href="{{ route('piernas', ['pagina' => $pagina + 1]) }}">&raquo;</a>
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


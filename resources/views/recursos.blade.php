@extends('layouts.master')

@section('title', 'Recursos de Fitness - Workout 3D')

@section('content')
<div style="max-width:1100px; margin:40px auto; padding:20px;">
    <header style="text-align:center; margin-bottom:40px; animation:fadeInUp 0.8s ease-out;">
        <h1 style="font-family:'Oswald',sans-serif; color:var(--accent); font-size:2.5rem; margin-bottom:15px;">📚 Recursos de Fitness</h1>
        <p style="color:var(--muted); font-size:1.1rem; line-height:1.6;">Aprende, mejora y transforma tu entrenamiento con estos recursos seleccionados.</p>
    </header>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:25px;">
        <!-- Card 1 -->
        <div class="card" style="padding:25px; animation:fadeInUp 0.8s ease-out 0.1s both; transition:all 0.3s ease;">
            <h2 style="color:var(--accent); font-size:1.5rem; margin-bottom:15px;">🎥 Videos Educativos</h2>
            <p style="color:var(--muted); line-height:1.6; margin-bottom:20px;">
                Tutoriales de ejercicios con explicación técnica y corrección postural para maximizar resultados.
            </p>
            <a href="https://www.youtube.com/results?search_query=ejercicios+fitness" target="_blank" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Ver Videos →</a>
        </div>

        <!-- Card 2 -->
        <div class="card" style="padding:25px; animation:fadeInUp 0.8s ease-out 0.2s both; transition:all 0.3s ease;">
            <h2 style="color:var(--accent); font-size:1.5rem; margin-bottom:15px;">📖 Artículos Científicos</h2>
            <p style="color:var(--muted); line-height:1.6; margin-bottom:20px;">
                Estudios sobre hipertrofia, nutrición deportiva y fisiología del ejercicio.
            </p>
            <a href="https://www.ncbi.nlm.nih.gov/pmc/" target="_blank" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Leer Artículos →</a>
        </div>

        <!-- Card 3 -->
        <div class="card" style="padding:25px; animation:fadeInUp 0.8s ease-out 0.3s both; transition:all 0.3s ease;">
            <h2 style="color:var(--accent); font-size:1.5rem; margin-bottom:15px;">🍎 Nutrición Deportiva</h2>
            <p style="color:var(--muted); line-height:1.6; margin-bottom:20px;">
                Guías de macronutrientes, timing de nutrientes y suplementación efectiva.
            </p>
            <a href="https://www.nutrition.gov/" target="_blank" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Ver Guías →</a>
        </div>

        <!-- Card 4 -->
        <div class="card" style="padding:25px; animation:fadeInUp 0.8s ease-out 0.4s both; transition:all 0.3s ease;">
            <h2 style="color:var(--accent); font-size:1.5rem; margin-bottom:15px;">📊 Calculadoras</h2>
            <p style="color:var(--muted); line-height:1.6; margin-bottom:20px;">
                Calcula tu TMB, macros diarios, 1RM y porcentaje de grasa corporal.
            </p>
            <a href="{{ route('index') }}#calculadora" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Calcular →</a>
        </div>

        <!-- Card 5 -->
        <div class="card" style="padding:25px; animation:fadeInUp 0.8s ease-out 0.5s both; transition:all 0.3s ease;">
            <h2 style="color:var(--accent); font-size:1.5rem; margin-bottom:15px;">🏋️ Rutinas Profesionales</h2>
            <p style="color:var(--muted); line-height:1.6; margin-bottom:20px;">
                Programas de entrenamiento de hipertrofia, fuerza y resistencia.
            </p>
            <a href="{{ route('index') }}#rutinas" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Ver Rutinas →</a>
        </div>

        <!-- Card 6 -->
        <div class="card" style="padding:25px; animation:fadeInUp 0.8s ease-out 0.6s both; transition:all 0.3s ease;">
            <h2 style="color:var(--accent); font-size:1.5rem; margin-bottom:15px;">🎧 Podcasts de Fitness</h2>
            <p style="color:var(--muted); line-height:1.6; margin-bottom:20px;">
                Escucha a expertos hablando sobre entrenamiento, recuperación y mindset.
            </p>
            <a href="https://open.spotify.com/search/fitness%20podcast" target="_blank" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Escuchar →</a>
        </div>
    </div>

    <div style="text-align:center; margin-top:50px; animation:fadeInUp 0.8s ease-out 0.7s both;">
        <a href="{{ route('index') }}" style="display:inline-block; text-decoration:none; padding:14px 32px; background:linear-gradient(90deg, rgba(0,190,240,0.2), rgba(0,190,240,0.05)); border:2px solid var(--accent); border-radius:12px; color:var(--accent); font-weight:700; font-size:1rem; transition:all 0.3s ease; cursor:pointer;">
            ⬅️ Volver al Inicio
        </a>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,180,216,0.3);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,180,216,0.4);
    }
</style>
@endsection
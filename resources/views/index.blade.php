@extends('layouts.master')

@section('title', 'Workout 3D - Explora el Fitness en 3D')

@section('content')
  <div class="home">
    <div class="home-grid">
      <!-- ===== COLUMNA PRINCIPAL ===== -->
      <div class="home-main">
        <section class="hero-arc" aria-labelledby="titulo-hero">
          <div class="hero-copy">
            <p class="hero-kicker">Entrena con precision visual</p>
            <h1 id="titulo-hero" class="hero-title">🏋️ Anatomia 3D, <span>progreso real</span></h1>
            <p class="hero-sub">Explora la musculatura en 3D, guarda tus rutinas y mide tu avance con una estetica limpia y futurista.</p>

            <div class="hero-actions">
              <a class="btn btn-primary" href="#musculos">Explorar musculos</a>
              <button class="btn btn-secondary" type="button" id="btnRutinasHero">💪 Mis rutinas</button>
            </div>

            <div class="hero-stats">
              <div class="stat-pill">
                <span class="stat-value">+120</span>
                <span class="stat-label">Ejercicios</span>
              </div>
              <div class="stat-pill">
                <span class="stat-value">3D</span>
                <span class="stat-label">Interactivo</span>
              </div>
              <div class="stat-pill">
                <span class="stat-value">24/7</span>
                <span class="stat-label">Acceso</span>
              </div>
            </div>
          </div>

          <div class="hero-media">
            <div class="model-frame">
              <div class="model-header">
                <span class="model-dot"></span>
                <span class="model-dot"></span>
                <span class="model-dot"></span>
                <span class="model-title">Modelo humano</span>
              </div>
              <model-viewer 
                id="modelo" 
                src="{{ asset('model/cuerpo/scene.gltf') }}"
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
              <div class="model-footer">Arrastra para rotar · Scroll para zoom</div>
            </div>
          </div>
        </section>

        <section id="musculos" class="muscle-section">
          <div class="section-head">
            <h2 class="section-title">Seleccion rapida por musculo</h2>
            <p class="section-description">Accede directo a ejercicios filtrados por grupo muscular.</p>
          </div>
          <div class="muscle-links">
            <a class="btn btn-primary" href="{{ route('biceps') }}">💪 Bíceps</a>
            <a class="btn btn-primary" href="{{ route('pecho') }}">🏹 Pecho</a>
            <a class="btn btn-primary" href="{{ route('abdomen') }}">🎯 Abdomen</a>
            <a class="btn btn-primary" href="{{ route('espalda') }}">🔙 Espalda</a>
            <a class="btn btn-primary" href="{{ route('triceps') }}">🔄 Tríceps</a>
            <a class="btn btn-primary" href="{{ route('piernas') }}">🦵 Piernas</a>
            <a class="btn btn-primary" href="{{ route('hombros') }}">⬆️ Hombros</a>
          </div>
        </section>

        <section class="productos-recomendados">
          <div class="section-head">
            <h2 class="section-title">🛒 Suplementacion elite</h2>
            <p class="section-description">Seleccion curada para rendimiento, energia y recuperacion.</p>
          </div>

          <div class="productos-grid">
            @forelse($productos ?? [] as $p)
              <div class="producto card animate-fadeInUp">
                <img src="{{ asset($p->imagen_url) }}" alt="{{ $p->nombre }}">
                <div class="producto-body">
                  <h3 class="font-heading">{{ $p->nombre }}</h3>
                  <p class="text-muted">{{ Str::limit($p->descripcion, 60) }}</p>
                  <div class="precio">{{ number_format($p->precio, 2) }} €</div>
                </div>
                
                <a href="{{ route('tienda', ['id' => $p->id]) }}" class="btn btn-secondary" style="width:100%;">Ver Detalles</a>
              </div>
            @empty
              <p class="text-muted" style="grid-column:1/-1; text-align:center;">Nuevos productos en camino...</p>
            @endforelse
          </div>
        </section>
      </div>

      <!-- ===== COLUMNA SECUNDARIA ===== -->
      <aside class="home-rail">
        <div class="card calculadora">
          <div class="card-title">Calcular IMC</div>
          
          <div class="input-group">
            <label for="sexo">Sexo</label>
            <select id="sexo">
              <option value="hombre">Hombre</option>
              <option value="mujer">Mujer</option>
            </select>
          </div>

          <div class="input-group">
            <label for="edad">Edad</label>
            <input id="edad" type="number" value="{{ $datos->edad ?? '' }}" placeholder="Años">
          </div>

          <div class="input-group">
            <label for="peso">Peso (kg)</label>
            <input id="peso" type="number" step="0.1" value="{{ $datos->peso ?? '' }}" placeholder="kg">
          </div>

          <div class="input-group">
            <label for="altura">Altura (cm)</label>
            <input id="altura" type="number" value="{{ $datos->altura ?? '' }}" placeholder="cm">
          </div>

          <button id="calcularGrasa" type="button" class="btn btn-primary" style="width:100%;">⚙️ Calcular Grasa</button>
          <div id="resultadoGrasa" class="resultado animate-fadeIn" style="display:none; margin-top:15px;"></div>

          <hr style="margin:25px 0; border:none; border-top:1px solid var(--glass-border);">

          <div class="card-title">🔍 Riesgo Metabolico</div>
          <div class="input-group">
            <label for="cintura">Cintura (cm)</label>
            <input id="cintura" type="number" placeholder="cm">
          </div>
          <div class="input-group">
            <label for="presion">Sistolica (mmHg)</label>
            <input id="presion" type="number" placeholder="mmHg">
          </div>
          <div class="input-group">
            <label for="glucosa">Glucosa (mg/dL)</label>
            <input id="glucosa" type="number" placeholder="mg/dL">
          </div>
          <button id="calcularRiesgo" type="button" class="btn btn-secondary" style="width:100%;">🔍 Analizar Riesgo</button>
          <div id="resultadoRiesgo" class="resultado animate-fadeIn" style="display:none; margin-top:15px;"></div>
        </div>

        <div class="card">
          <div class="card-title">📈 Evolucion reciente</div>
          <canvas id="progressChart" style="margin-top:20px;"></canvas>
          <div style="margin-top:25px; text-align:center;">
            <a href="{{ route('progreso') }}" class="btn btn-ghost">Ver Historial →</a>
          </div>
        </div>
      </aside>
    </div>
  </div>

  <!-- Modal rutinas -->
  <x-modal-rutinas :rutinas="$rutinas ?? []" />
@endsection


@push('scripts')
  <script>
    window.mostrarToastLogin = function() {
      if (typeof showToast === 'function') {
        showToast('🔒 Debes iniciar sesión para acceder a la tienda.', 'error');
      }
    };

    document.addEventListener('DOMContentLoaded', () => {
      const btnRutinasHero = document.getElementById('btnRutinasHero');
      const modalRutinas = document.getElementById('modalRutinas');
      if (btnRutinasHero && modalRutinas) {
        btnRutinasHero.addEventListener('click', () => modalRutinas.classList.add('abierto'));
      }

      try {
        const raw = @json($progress_json ?? []);
        if (Array.isArray(raw) && raw.length > 0) {
          const labels = raw.map(r => r.fecha.slice(0, 10));
          const data = raw.map(r => r.peso);
          const ctx = document.getElementById('progressChart').getContext('2d');
          new Chart(ctx, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [{
                label: 'Peso (kg)',
                data: data,
                fill: true,
                fillColor: 'rgba(0,180,216,0.1)',
                borderColor: 'var(--accent)',
                backgroundColor: 'rgba(0,180,216,0.1)',
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: 'var(--accent)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
              }]
            },
            options: {
              responsive: true,
              plugins: { legend: { display: true, labels: { color: '#9aa7b0' } } },
              scales: {
                x: { ticks: { color: '#9aa7b0' }, grid: { drawBorder: false, color: 'rgba(255,255,255,0.05)' } },
                y: { ticks: { color: '#9aa7b0' }, grid: { drawBorder: false, color: 'rgba(255,255,255,0.05)' } }
              }
            }
          });
        } else {
          const canvas = document.getElementById('progressChart');
          const ctx = canvas.getContext('2d');
          ctx.font = '14px "Segoe UI", Arial';
          ctx.fillStyle = '#9aa7b0';
          ctx.textAlign = 'center';
          ctx.fillText('No hay datos de progreso guardados', canvas.width / 2, canvas.height / 2);
        }
      } catch (err) {
        console.error(err);
      }
    });
  </script>
@endpush

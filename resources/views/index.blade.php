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

        <section class="feature-section" aria-labelledby="titulo-features">
          <div class="section-head">
            <h2 id="titulo-features" class="section-title">Una plataforma fitness moderna de verdad</h2>
            <p class="section-description">Todo conectado en una sola experiencia: anatomia 3D, rutinas, progreso y suplementacion.</p>
          </div>

          <div class="feature-grid">
            <article class="feature-card card animate-fadeInUp">
              <div class="feature-icon">🧠</div>
              <h3>Modelos 3D interactivos</h3>
              <p>Visualiza musculos en detalle para entrenar con precision tecnica y mejor ejecucion.</p>
            </article>
            <article class="feature-card card animate-fadeInUp">
              <div class="feature-icon">📆</div>
              <h3>Rutinas personalizadas</h3>
              <p>Crea, ajusta y organiza entrenamientos por dias con una experiencia simple y potente.</p>
            </article>
            <article class="feature-card card animate-fadeInUp">
              <div class="feature-icon">📊</div>
              <h3>Seguimiento inteligente</h3>
              <p>Mide peso, grasa y evolucion con graficos para mantener constancia y enfoque.</p>
            </article>
            <article class="feature-card card animate-fadeInUp">
              <div class="feature-icon">🛒</div>
              <h3>Tienda fitness integrada</h3>
              <p>Accede a suplementos seleccionados para rendimiento, recuperacion y energia.</p>
            </article>
          </div>
        </section>

        <section class="benefits-section" aria-labelledby="titulo-benefits">
          <div class="section-head">
            <h2 id="titulo-benefits" class="section-title">Beneficios para tu progreso diario</h2>
          </div>

          <div class="benefits-grid">
            <article class="benefit-card card">
              <h3>Entrena con enfoque</h3>
              <p>Reduce improvisacion con una estructura clara de ejercicios, dias y metricas.</p>
            </article>
            <article class="benefit-card card">
              <h3>Sube tu motivacion</h3>
              <p>Visualiza avances reales y convierte cada semana en una mejora medible.</p>
            </article>
            <article class="benefit-card card">
              <h3>Decisiones basadas en datos</h3>
              <p>Combina rutina, historial y analisis para entrenar con criterio profesional.</p>
            </article>
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

        <section class="testimonials-section" aria-labelledby="titulo-testimonios">
          <div class="section-head">
            <h2 id="titulo-testimonios" class="section-title">Lo que opinan nuestros usuarios</h2>
            <p class="section-description">Historias breves de una comunidad que entrena con metodo.</p>
          </div>

          <div class="testimonials-grid">
            <article class="testimonial-card card">
              <p>"El modelo 3D me ayudo a entender mejor cada ejercicio. Entreno con mas seguridad y tecnica."</p>
              <div class="testimonial-user">Laura M. · Nivel Intermedio</div>
            </article>
            <article class="testimonial-card card">
              <p>"La combinacion de rutinas y progreso me dio orden. Ahora si noto resultados semana a semana."</p>
              <div class="testimonial-user">Sergio R. · Fuerza y volumen</div>
            </article>
            <article class="testimonial-card card">
              <p>"La plataforma se siente premium y super clara. Todo esta donde tiene que estar."</p>
              <div class="testimonial-user">Andrea P. · Fitness general</div>
            </article>
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

    <section class="final-cta" aria-labelledby="titulo-final-cta">
      <div class="final-cta-content">
        <p class="hero-kicker">Workout 3D Experience</p>
        <h2 id="titulo-final-cta">Listo para entrenar con una experiencia premium</h2>
        <p>Empieza hoy, crea tu rutina y lleva tu progreso al siguiente nivel con una plataforma pensada para resultados reales.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="{{ session()->has('usuario') ? route('crear_rutina') : route('auth') }}">Comenzar ahora</a>
          <a class="btn btn-secondary" href="{{ route('recursos') }}">Ver recursos</a>
        </div>
      </div>
    </section>
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

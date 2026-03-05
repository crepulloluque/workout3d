@extends('layouts.master')

@section('title', 'Entrenar: ' . $rutina->nombre . ' - Workout 3D')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/entrenar.css') }}">
@endpush

@section('content')
    <div class="main">
        <div class="entrenar-container glass-panel">
            <header class="entrenar-header animate-fadeIn">
                <h1 class="font-heading">🏋️ {{ $rutina->nombre }}</h1>
                <p>{{ $rutina->descripcion }}</p>
                
                <div class="modo-toggle">
                    <button id="btnModoEntrenar" class="modo-btn active" onclick="cambiarModo('entrenar')">Modo Entrenamiento</button>
                    <button id="btnModoReordenar" class="modo-btn" onclick="cambiarModo('reordenar')">Reordenar Ejercicios</button>
                </div>
            </header>

            <!-- Selector de día -->
            <div class="dias-selector animate-fadeIn">
                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                    @if(isset($ejercicios_por_dia[$dia]))
                        <button type="button" class="dia-btn-entrenar {{ $loop->first ? 'active' : '' }}" 
                                data-dia="{{ $dia }}" onclick="cambiarDia('{{ $dia }}')">
                            {{ $dia }}
                        </button>
                    @endif
                @endforeach
            </div>

            <!-- Configuración de descanso -->
            <div class="config-descanso modo-entrenar-only animate-fadeIn">
                <label for="tiempoDescanso">⏱️ Descanso entre series:</label>
                <select id="tiempoDescanso">
                    <option value="30">30s</option>
                    <option value="45">45s</option>
                    <option value="60" selected>1 min</option>
                    <option value="90">1.5 min</option>
                    <option value="120">2 min</option>
                    <option value="150">2.5 min</option>
                    <option value="180">3 min</option>
                    <option value="240">4 min</option>
                    <option value="300">5 min</option>
                </select>
            </div>

            <!-- Contenedor de ejercicios por día -->
            <div id="ejerciciosEntrenamiento" class="animate-fadeInUp">
                @foreach($ejercicios_por_dia as $dia => $ejercicios)
                    <div class="dia-ejercicios" id="dia-{{ $dia }}" style="{{ $loop->first ? '' : 'display:none;' }}">
                        <h2 class="font-heading" style="text-align:center; margin-bottom:30px; color:var(--accent);">{{ $dia }}</h2>
                        
                        <div class="ejercicios-lista-reordenable" id="lista-{{ $dia }}" data-dia="{{ $dia }}">
                            @foreach($ejercicios as $ej)
                                <div class="ejercicio-card glass-panel" data-ejercicio-id="{{ $ej->ejercicio_id }}" data-orden="{{ $ej->orden }}">
                                    <!-- Botones de reorden -->
                                    <div class="reorden-btns" style="display:none; gap:10px; margin-bottom:15px;">
                                        <button class="modo-btn" style="padding:5px 15px;" onclick="moverEjercicio('{{ $dia }}', this, -1)">▲ Subir</button>
                                        <button class="modo-btn" style="padding:5px 15px;" onclick="moverEjercicio('{{ $dia }}', this, 1)">▼ Bajar</button>
                                    </div>

                                    <div class="ejercicio-info">
                                        <h3 class="font-heading">{{ $ej->nombre }}</h3>
                                        <p class="text-muted" style="margin-bottom:15px;">{{ $ej->descripcion }}</p>
                                        <div class="ejercicio-meta">
                                            <span class="badge-accent">{{ $ej->total_series }} series</span>
                                            <span class="badge-success">{{ $ej->dificultad }}</span>
                                        </div>

                                        <!-- Historial -->
                                        @if($ej->series_detalle->where('peso_kg', '!=', null)->count() > 0)
                                            <div class="historial-previo" style="margin-top:20px; padding:15px; background:rgba(255,255,255,0.02); border-radius:12px;">
                                                <strong style="display:block; margin-bottom:10px; font-size:0.8rem; text-transform:uppercase; color:var(--muted);">Último entrenamiento</strong>
                                                <div style="display:flex; flex-wrap:wrap; gap:15px;">
                                                    @foreach($ej->series_detalle as $serie)
                                                        @if($serie->peso_kg)
                                                            @php
                                                                $peso_formateado = fmod($serie->peso_kg, 1) == 0 
                                                                    ? number_format($serie->peso_kg, 0) 
                                                                    : rtrim(number_format($serie->peso_kg, 2), '0');
                                                            @endphp
                                                            <div class="serie-previa" style="font-size:0.9rem;">
                                                                S{{ $serie->numero_serie }}: <span class="text-accent" style="font-weight:700;">{{ $peso_formateado }}kg × {{ $serie->repeticiones }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Series Tracking -->
                                    <div class="ejercicio-progreso modo-entrenar-only" style="margin-top:25px;">
                                        <h4 class="font-heading" style="font-size:1rem; margin-bottom:15px; color:var(--white);">Ejecución de Series</h4>
                                        <div class="series-tracking">
                                            @foreach($ej->series_detalle as $serie)
                                                <div class="serie-row">
                                                    <span class="serie-numero" style="font-family:var(--font-heading);">S{{ $serie->numero_serie }}</span>
                                                    <div class="serie-inputs">
                                                        <label>
                                                            <input type="number" class="peso-input" 
                                                                   placeholder="kg" 
                                                                   value="{{ $serie->peso_kg ?? '' }}"
                                                                   step="0.5" min="0" max="500"
                                                                   data-ejercicio="{{ $ej->ejercicio_id }}" 
                                                                   data-serie="{{ $serie->numero_serie }}">
                                                        </label>
                                                        <label>
                                                            <input type="number" class="reps-input" 
                                                                   value="{{ $serie->repeticiones }}" 
                                                                   min="1" max="50"
                                                                   data-ejercicio="{{ $ej->ejercicio_id }}" 
                                                                   data-serie="{{ $serie->numero_serie }}">
                                                        </label>
                                                        <button class="serie-check-btn" 
                                                                onclick="marcarSerieCompleta(this, {{ $ej->ejercicio_id }}, {{ $serie->numero_serie }})"
                                                                title="Completada">
                                                            ✓
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if($ej->video_url)
                                        <button class="modo-btn modo-entrenar-only" style="margin-top:20px; align-self:flex-start;" onclick="mostrarVideo('{{ $ej->video_url }}', '{{ $ej->nombre }}')">
                                            📹 Tutorial de Técnica
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Guardar orden -->
                        <div style="text-align:center;">
                            <button class="btn btn-primary modo-reordenar-only" style="display:none; margin-top:30px;" onclick="guardarOrden('{{ $dia }}')">
                                💾 Registrar Nuevo Orden
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botón finalizar -->
            <form method="POST" action="{{ route('rutina.finalizar') }}" id="formFinalizar" class="modo-entrenar-only">
                @csrf
                <input type="hidden" name="rutina_id" value="{{ $rutina->id }}">
                <input type="hidden" name="dia_semana" id="diaActual" value="">
                <input type="hidden" name="duracion_minutos" id="duracionMinutos" value="0">
                <input type="hidden" name="datos_ejercicios" id="datosEjercicios" value="">
                
                <button type="submit" class="btn-finalizar">🏁 Finalizar Sesión</button>
            </form>

            <div style="text-align:center; margin-top:40px;">
                <a href="{{ route('index') }}" class="modo-btn">← Abortar y Volver</a>
            </div>
        </div>
    </div>

    <!-- Modal de video -->
    <div id="modalVideo" class="modal-video" style="display:none;" onclick="cerrarVideo()">
        <div class="modal-video-content glass-panel" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="cerrarVideo()">&times;</span>
            <h3 id="videoTitulo" class="font-heading" style="margin-bottom:20px; color:var(--accent);"></h3>
            <div class="video-wrapper">
                <iframe id="videoFrame" src="" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let diaSeleccionado = '{{ array_key_first($ejercicios_por_dia) }}';
        let seriesCompletadas = {};
        let modoActual = 'entrenar';
        let timerDescanso = null;
        let tiempoDescansoActual = 0;
        let timerDisplay = null;

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('diaActual').value = diaSeleccionado;
        });

        function cambiarDia(dia) {
            document.querySelectorAll('.dia-ejercicios').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.dia-btn-entrenar').forEach(btn => btn.classList.remove('active'));
            
            document.getElementById('dia-' + dia).style.display = 'block';
            document.querySelector(`[data-dia="${dia}"]`).classList.add('active');
            
            diaSeleccionado = dia;
            document.getElementById('diaActual').value = dia;
        }

        function marcarSerieCompleta(btn, ejercicioId, serieNum) {
            const row = btn.closest('.serie-row');
            const pesoInput = row.querySelector('.peso-input');
            const repsInput = row.querySelector('.reps-input');
            
            const peso = parseFloat(pesoInput.value) || 0;
            const reps = parseInt(repsInput.value) || 0;

            if (peso === 0 && !btn.classList.contains('completada')) {
                if (window.showToast) window.showToast('⚠️ Indica el peso utilizado', 'warning');
                else alert('⚠️ Indica el peso utilizado');
                pesoInput.focus();
                return;
            }

            if (!seriesCompletadas[ejercicioId]) {
                seriesCompletadas[ejercicioId] = {};
            }
            
            btn.classList.toggle('completada');
            row.classList.toggle('completada');

            if (!btn.classList.contains('completada')) {
                delete seriesCompletadas[ejercicioId][serieNum];
                return;
            }

            seriesCompletadas[ejercicioId][serieNum] = {
                peso: peso,
                reps: reps,
                completada: true
            };

            iniciarTimerDescanso();
        }

        function iniciarTimerDescanso() {
            if (timerDescanso) clearInterval(timerDescanso);
            if (timerDisplay) timerDisplay.remove();

            tiempoDescansoActual = parseInt(document.getElementById('tiempoDescanso').value);

            timerDisplay = document.createElement('div');
            timerDisplay.id = 'timerDescansoDisplay';
            timerDisplay.innerHTML = `
                <div class="timer-circle">
                    <svg class="timer-ring" width="180" height="180">
                        <circle class="timer-ring-bg" stroke="rgba(255,255,255,0.05)" stroke-width="8" fill="transparent" r="80" cx="90" cy="90"/>
                        <circle class="timer-ring-progress" stroke-width="8" fill="transparent" r="80" cx="90" cy="90" 
                                stroke-dasharray="502" stroke-dashoffset="0" transform="rotate(-90 90 90)"/>
                    </svg>
                    <div class="timer-text">
                        <div class="timer-numero">${formatearTiempo(tiempoDescansoActual)}</div>
                        <div class="timer-label">Recuperación</div>
                    </div>
                </div>
                <div class="timer-controls">
                    <button onclick="ajustarTiempo(-15)" class="timer-btn timer-btn-minus">-15s</button>
                    <button onclick="saltarDescanso()" class="timer-btn timer-btn-skip">Siguiente</button>
                    <button onclick="ajustarTiempo(15)" class="timer-btn timer-btn-plus">+15s</button>
                </div>
            `;
            
            document.body.appendChild(timerDisplay);

            const tiempoTotal = tiempoDescansoActual;
            const circumference = 2 * Math.PI * 80;

            timerDescanso = setInterval(() => {
                tiempoDescansoActual--;
                actualizarDisplayDescanso(tiempoTotal, circumference);

                if (tiempoDescansoActual <= 0) {
                    finalizarDescanso();
                }
            }, 1000);
        }

        function actualizarDisplayDescanso(tiempoTotal, circumference) {
            if (!timerDisplay) return;
            const displayTiempo = timerDisplay.querySelector('.timer-numero');
            const progress = timerDisplay.querySelector('.timer-ring-progress');
            
            displayTiempo.textContent = formatearTiempo(tiempoDescansoActual);
            const offset = circumference - (tiempoDescansoActual / tiempoTotal) * circumference;
            progress.style.strokeDashoffset = offset;
        }

        function ajustarTiempo(segundos) {
            tiempoDescansoActual += segundos;
            if (tiempoDescansoActual < 0) tiempoDescansoActual = 0;
            actualizarDisplayDescanso(parseInt(document.getElementById('tiempoDescanso').value), 2 * Math.PI * 80);
        }

        function saltarDescanso() { finalizarDescanso(); }

        function finalizarDescanso() {
            clearInterval(timerDescanso);
            if (timerDisplay) {
                timerDisplay.querySelector('.timer-circle').innerHTML = `
                    <div style="font-size:4rem;">🔥</div>
                    <div class="timer-label">¡DALE!</div>
                `;
                setTimeout(() => {
                    if (timerDisplay) timerDisplay.remove();
                    timerDisplay = null;
                }, 1500);
            }
        }

        function formatearTiempo(segundos) {
            const mins = Math.floor(segundos / 60);
            const secs = segundos % 60;
            return mins > 0 ? `${mins}:${String(secs).padStart(2, '0')}` : `${secs}s`;
        }

        function mostrarVideo(url, titulo) {
            document.getElementById('videoTitulo').textContent = titulo;
            document.getElementById('videoFrame').src = url;
            document.getElementById('modalVideo').style.display = 'flex';
        }

        function cerrarVideo() {
            document.getElementById('modalVideo').style.display = 'none';
            document.getElementById('videoFrame').src = '';
        }

        document.getElementById('formFinalizar').addEventListener('submit', function(e) {
            document.getElementById('datosEjercicios').value = JSON.stringify(seriesCompletadas);
        });

        function cambiarModo(modo) {
            modoActual = modo;
            document.getElementById('btnModoEntrenar').classList.toggle('active', modo === 'entrenar');
            document.getElementById('btnModoReordenar').classList.toggle('active', modo === 'reordenar');

            const isEntrenar = modo === 'entrenar';
            document.querySelectorAll('.modo-entrenar-only').forEach(el => el.style.display = isEntrenar ? '' : 'none');
            document.querySelectorAll('.modo-reordenar-only').forEach(el => el.style.display = isEntrenar ? 'none' : '');
            document.querySelectorAll('.reorden-btns').forEach(el => el.style.display = isEntrenar ? 'none' : 'flex');
        }

        function moverEjercicio(dia, btnElement, direccion) {
            const lista = document.getElementById('lista-' + dia);
            const card = btnElement.closest('.ejercicio-card');
            const cards = Array.from(lista.children);
            const index = cards.indexOf(card);
            const newIndex = index + direccion;
            
            if (newIndex >= 0 && newIndex < cards.length) {
                if (direccion === -1) lista.insertBefore(card, cards[newIndex]);
                else lista.insertBefore(card, cards[newIndex].nextSibling);
            }
        }

        function guardarOrden(dia) {
            const nuevoOrden = Array.from(document.getElementById('lista-' + dia).children).map((card, idx) => ({
                ejercicio_id: card.dataset.ejercicioId,
                orden: idx + 1
            }));

            fetch('{{ route("rutina.guardar_orden") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ rutina_id: {{ $rutina->id }}, dia_semana: dia, orden: nuevoOrden })
            })
            .then(res => res.json())
            .then(() => { if (window.showToast) window.showToast('✅ Orden actualizado', 'success'); else alert('✅ Orden actualizado'); })
            .catch(() => { if (window.showToast) window.showToast('❌ Error al guardar orden', 'error'); else alert('❌ Error'); });
        }
    </script>
    @endpush
@endsection

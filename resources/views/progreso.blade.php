@extends('layouts.master')

@section('title', 'Mi Progreso - Workout 3D')

@section('content')
<section class="progreso-page">
    <div class="progreso-container">
        <header class="progreso-hero">
            <span class="progreso-kicker">Seguimiento</span>
            <h1>📊 Mi Progreso</h1>
            <p>Registra tus medidas, revisa tu historial y sigue la evolucion en un solo lugar.</p>
            <div class="progreso-hero-actions">
                <a class="btn btn-secondary" href="{{ route('index') }}">Volver al inicio</a>
            </div>
        </header>

        <div class="progreso-grid">
            <section class="progreso-card">
                <div class="card-title">➕ Registrar nuevo</div>
                <form method="POST" action="{{ route('progreso.store') }}" class="progreso-form">
                    @csrf
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" name="fecha" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="number" name="peso" step="0.1" required placeholder="75.5">
                    </div>
                    <div class="form-group">
                        <label>Grasa (%)</label>
                        <input type="number" name="grasa" step="0.1" placeholder="15.2">
                    </div>
                    <div class="form-group">
                        <label>Musculo (kg)</label>
                        <input type="number" name="musculo" step="0.1" placeholder="35.0">
                    </div>
                    <button type="submit" class="btn btn-primary full">💾 Guardar</button>
                </form>
            </section>

            <section class="progreso-card progreso-chart">
                <div class="card-title">📈 Evolucion</div>
                <div class="chart-wrap">
                    <canvas id="progressChart"></canvas>
                </div>
            </section>
        </div>

        <section class="progreso-card progreso-table">
            <div class="card-title">📋 Historial</div>

            @if(isset($progresos) && count($progresos) > 0)
                <div class="tabla-progreso-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Peso</th>
                                <th>Grasa</th>
                                <th>Musculo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($progresos as $p)
                                <tr>
                                    <td>{{ $p->fecha }}</td>
                                    <td>{{ $p->peso }} kg</td>
                                    <td>{{ $p->grasa ?? '—' }} %</td>
                                    <td>{{ $p->musculo ?? '—' }} kg</td>
                                    <td>
                                        <form method="POST" action="{{ route('progreso.eliminar', $p->id) }}" onsubmit="return confirm('¿Eliminar?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-eliminar">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="progreso-empty">No hay registros aun.</p>
            @endif
        </section>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        try {
            const raw = @json($progress_json ?? []);
            if (Array.isArray(raw) && raw.length > 0) {
                const labels = raw.map(r => r.fecha.slice(0, 10));
                const data = raw.map(r => r.peso);
                const ctx = document.getElementById('progressChart').getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 260);
                gradient.addColorStop(0, 'rgba(0,190,240,0.35)');
                gradient.addColorStop(1, 'rgba(0,190,240,0.02)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Peso (kg)',
                            data: data,
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: 'rgba(0,190,240,0.9)',
                            borderWidth: 2,
                            tension: 0.35,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#0b151d',
                            pointBorderColor: 'rgba(0,190,240,0.9)',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(7,16,23,0.95)',
                                borderColor: 'rgba(0,190,240,0.5)',
                                borderWidth: 1,
                                titleColor: '#ffffff',
                                bodyColor: '#d7e4ea',
                                padding: 12,
                                displayColors: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: { color: '#9aa7b0' },
                                grid: { color: 'rgba(255,255,255,0.05)' }
                            },
                            y: {
                                ticks: { color: '#9aa7b0' },
                                grid: { color: 'rgba(255,255,255,0.05)' }
                            }
                        }
                    }
                });
            }
        } catch (err) {
            console.error(err);
        }
    });
</script>
@endpush
@endsection



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Workout 3D</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>🔧 Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="active">📊 Dashboard</a>
                <a href="{{ route('admin.ejercicios') }}">💪 Ejercicios</a>
                <a href="{{ route('admin.usuarios') }}">👥 Usuarios</a>
                <a href="{{ route('admin.productos') }}">🛒 Productos</a>
                <a href="{{ route('admin.pedidos') }}">📦 Pedidos</a>
                <a href="{{ route('admin.rutinas') }}">📋 Rutinas</a>
                <a href="{{ route('admin.logout') }}" class="logout">🚪 Salir</a>
            </nav>
        </aside>

        <main class="admin-content">
            <header class="admin-page-header">
                <div>
                    <h1>Dashboard</h1>
                    <p class="admin-subtitle">Resumen rapido del estado de la plataforma.</p>
                </div>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>{{ $stats['usuarios'] }}</h3>
                    <p>Usuarios Registrados</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['ejercicios'] }}</h3>
                    <p>Ejercicios</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['productos'] }}</h3>
                    <p>Productos</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $stats['rutinas'] }}</h3>
                    <p>Rutinas Creadas</p>
                </div>
            </div>

            <h2 class="admin-section-title">📊 Estadisticas generales</h2>
            <div class="panel-card">
                <canvas id="adminStatsChart" height="120"></canvas>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.getElementById('adminStatsChart');
                if (!ctx) return;

                const data = {
                    labels: ['Usuarios', 'Ejercicios', 'Productos', 'Rutinas'],
                    datasets: [{
                        label: 'Totales',
                        data: [
                            {{ $stats['usuarios'] }},
                            {{ $stats['ejercicios'] }},
                            {{ $stats['productos'] }},
                            {{ $stats['rutinas'] }}
                        ],
                        backgroundColor: ['#00b4d8','#2ec286','#f4a261','#e63946'],
                        borderRadius: 8
                    }]
                };

                new Chart(ctx, {
                    type: 'bar',
                    data,
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { ticks: { color: '#9aa7b0' } },
                            y: { ticks: { color: '#9aa7b0' } }
                        }
                    }
                });
            });
        </script>
    </div>
</body>
</html>

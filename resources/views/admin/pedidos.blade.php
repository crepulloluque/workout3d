<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>🔧 Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('admin.ejercicios') }}">💪 Ejercicios</a>
                <a href="{{ route('admin.usuarios') }}">👥 Usuarios</a>
                <a href="{{ route('admin.productos') }}">🛒 Productos</a>
                <a href="{{ route('admin.pedidos') }}" class="active">📦 Pedidos</a>
                <a href="{{ route('admin.rutinas') }}">📋 Rutinas</a>
                <a href="{{ route('admin.logout') }}" class="logout">🚪 Salir</a>
            </nav>
        </aside>

        <main class="admin-content">
            <header class="admin-page-header">
                <div>
                    <h1>Gestion de pedidos</h1>
                    <p class="admin-subtitle">Monitorea compras, usuarios y totales en tiempo real.</p>
                </div>
                <div class="admin-header-actions">
                    <span class="chip">Total: {{ $pedidos->count() }}</span>
                </div>
            </header>

            <section class="table-card">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $p)
                            <tr>
                                <td>#{{ $p->id }}</td>
                                <td>{{ $p->usuario_nombre ?? '—' }}</td>
                                <td>{{ $p->producto_nombre ?? '—' }}</td>
                                <td>{{ $p->cantidad ?? 1 }}</td>
                                <td><span class="price">{{ number_format($p->precio_total ?? 0, 2) }} €</span></td>
                                <td>{{ $p->fecha_compra ?? $p->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">No hay pedidos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>

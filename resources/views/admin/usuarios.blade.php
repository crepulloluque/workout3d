<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>🔧 Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('admin.ejercicios') }}">💪 Ejercicios</a>
                <a href="{{ route('admin.usuarios') }}" class="active">👥 Usuarios</a>
                <a href="{{ route('admin.productos') }}">🛒 Productos</a>
                <a href="{{ route('admin.rutinas') }}">📋 Rutinas</a>
                <a href="{{ route('admin.logout') }}" class="logout">🚪 Salir</a>
            </nav>
        </aside>

        <main class="admin-content">
            <header class="admin-page-header">
                <div>
                    <h1>Gestion de usuarios</h1>
                    <p class="admin-subtitle">Administra cuentas y datos de los usuarios.</p>
                </div>
            </header>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <section class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Edad</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->usuario }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->edad ?? '-' }}</td>
                            <td>{{ $u->peso ?? '-' }}</td>
                            <td>{{ $u->altura ?? '-' }}</td>
                            <td>{{ $u->created_at }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.usuarios.eliminar', $u->id) }}" style="display:inline" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(this, 'usuario')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </section>
        </main>
    </div>

    <!-- Modal confirmación -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <h3>⚠️ Confirmar Eliminación</h3>
            <p id="confirmMessage">¿Estás seguro de que deseas eliminar este elemento?</p>
            <div class="confirm-actions">
                <button class="btn btn-confirm" onclick="ejecutarEliminacion()">Eliminar</button>
                <button class="btn btn-cancel" onclick="cancelarEliminacion()">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        let formToSubmit = null;

        function confirmarEliminacion(btn, tipo) {
            formToSubmit = btn.closest('.form-delete');
            document.getElementById('confirmMessage').textContent = `¿Estás seguro de que deseas eliminar este ${tipo}?`;
            document.getElementById('confirmOverlay').style.display = 'flex';
        }

        function ejecutarEliminacion() {
            if (formToSubmit) formToSubmit.submit();
        }

        function cancelarEliminacion() {
            document.getElementById('confirmOverlay').style.display = 'none';
            formToSubmit = null;
        }
    </script>
</body>
</html>

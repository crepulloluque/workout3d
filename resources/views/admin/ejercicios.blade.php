<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>🔧 Admin Panel</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('admin.ejercicios') }}" class="active">💪 Ejercicios</a>
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
                    <h1>Gestion de ejercicios</h1>
                    <p class="admin-subtitle">Crea, revisa y elimina ejercicios del catalogo.</p>
                </div>
            </header>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <div class="admin-toolbar">
                <button class="btn" onclick="document.getElementById('formCrear').style.display='block'">➕ Nuevo ejercicio</button>
            </div>

            <!-- Formulario crear -->
            <div id="formCrear" class="form-panel" style="display:none;">
                <h3>Crear Ejercicio</h3>
                <form method="POST" action="{{ route('admin.ejercicios.crear') }}">
                    @csrf
                    <label>Músculo:</label>
                    <select name="musculo_id" required>
                        @foreach($musculos as $m)
                            <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                        @endforeach
                    </select>

                    <label>Nombre:</label>
                    <input type="text" name="nombre" required>

                    <label>Descripción:</label>
                    <textarea name="descripcion" rows="3"></textarea>

                    <label>Video URL:</label>
                    <input type="url" name="video_url">

                    <label>Dificultad:</label>
                    <select name="dificultad">
                        <option value="Principiante">Principiante</option>
                        <option value="Intermedio">Intermedio</option>
                        <option value="Avanzado">Avanzado</option>
                    </select>

                    <button type="submit" class="btn">Guardar</button>
                    <button type="button" class="btn secondary" onclick="document.getElementById('formCrear').style.display='none'">Cancelar</button>
                </form>
            </div>

            <!-- Lista de ejercicios -->
            <section class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Músculo</th>
                        <th>Dificultad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ejercicios as $e)
                        <tr>
                            <td>{{ $e->id }}</td>
                            <td>{{ $e->nombre }}</td>
                            <td>{{ $e->musculo_nombre }}</td>
                            <td>{{ $e->dificultad }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.ejercicios.eliminar', $e->id) }}" style="display:inline" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(this, 'ejercicio')">Eliminar</button>
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

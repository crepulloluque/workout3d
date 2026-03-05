<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Admin Panel</title>
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
                <a href="{{ route('admin.productos') }}" class="active">🛒 Productos</a>
                <a href="{{ route('admin.rutinas') }}">📋 Rutinas</a>
                <a href="{{ route('admin.logout') }}" class="logout">🚪 Salir</a>
            </nav>
        </aside>

        <main class="admin-content">
            <header class="admin-page-header">
                <div>
                    <h1>Gestion de productos</h1>
                    <p class="admin-subtitle">Controla inventario, precios y categorias.</p>
                </div>
            </header>

            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <div class="admin-toolbar">
                <button class="btn" onclick="document.getElementById('formCrear').style.display='block'">➕ Nuevo producto</button>
            </div>

            <!-- Formulario crear -->
            <div id="formCrear" class="form-panel" style="display:none;">
                <h3>Crear Producto</h3>
                <form method="POST" action="{{ route('admin.productos.crear') }}">
                    @csrf
                    <label>Nombre:</label>
                    <input type="text" name="nombre" required>

                    <label>Descripción:</label>
                    <textarea name="descripcion" rows="3"></textarea>

                    <label>Precio (€):</label>
                    <input type="number" name="precio" step="0.01" required>

                    <label>Imagen URL:</label>
                    <input type="url" name="imagen_url">

                    <label>Categoría:</label>
                    <input type="text" name="categoria">

                    <button type="submit" class="btn">Guardar</button>
                    <button type="button" class="btn secondary" onclick="document.getElementById('formCrear').style.display='none'">Cancelar</button>
                </form>
            </div>

            <!-- Lista de productos -->
            <section class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nombre }}</td>
                            <td>{{ number_format($p->precio, 2) }} €</td>
                            <td>{{ $p->categoria }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.productos.eliminar', $p->id) }}" style="display:inline" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(this, 'producto')">Eliminar</button>
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

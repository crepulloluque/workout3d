<div id="modalRutinas" role="dialog" aria-modal="true" aria-hidden="true" class="modal-rutinas-overlay">
    <div class="modal-rutinas-content">
        <span class="modal-close" id="modalClose">&times;</span>
        
        <h2 class="modal-rutinas-title">💪 Panel de Entrenamiento</h2>

        @if(session()->has('usuario_id'))
            <!-- SECCIÓN 1: Rutinas existentes -->
            <div class="rutinas-section">
                <div class="section-header">
                    <h3>📋 Mis Rutinas</h3>
                    <span class="rutinas-count">{{ count($rutinas) }} total</span>
                </div>
                
                @forelse($rutinas as $r)
                    <div class="rutina-card">
                        <div class="rutina-info">
                            <h4>{{ $r->nombre }}</h4>
                            <p class="rutina-desc">{{ $r->descripcion ?: 'Sin descripción' }}</p>
                            <span class="rutina-date">📅 Creada: {{ \Carbon\Carbon::parse($r->fecha_creacion)->format('d/m/Y') }}</span>
                        </div>
                        <div class="rutina-actions">
                            <form method="GET" action="{{ route('rutina.iniciar', $r->id) }}" style="display:inline;">
                                <button type="submit" class="btn-action btn-iniciar" title="Iniciar rutina">▶️ Iniciar</button>
                            </form>
                            <form method="GET" action="{{ route('editar_rutina') }}" style="display:inline;">
                                <input type="hidden" name="rutina_id" value="{{ $r->id }}">
                                <input type="hidden" name="nombre" value="{{ $r->nombre }}">
                                <input type="hidden" name="descripcion" value="{{ $r->descripcion }}">
                                <button type="submit" class="btn-action btn-editar" title="Editar rutina">✏️</button>
                            </form>
                            <form method="GET" action="{{ route('rutina.pdf', $r->id) }}" style="display:inline;">
                                <button type="submit" class="btn-action btn-pdf" title="Exportar a PDF">📄</button>
                            </form>
                            <form method="POST" action="{{ route('rutina.eliminar', $r->id) }}" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar la rutina \'{{ $r->nombre }}\'?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-eliminar" title="Eliminar rutina">🗑️</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="rutinas-empty">
                        <div class="empty-icon">📭</div>
                        <p>No tienes rutinas creadas aún.</p>
                        <small>¡Crea tu primera rutina abajo!</small>
                    </div>
                @endforelse
            </div>

            <div class="modal-divider"></div>

            <!-- SECCIÓN 2: Crear nueva rutina -->
            <div class="rutinas-section">
                <div class="section-header">
                    <h3>➕ Crear Nueva Rutina</h3>
                </div>
                
                <form class="form-rutina" method="GET" action="{{ route('crear_rutina') }}">
                    <div class="form-group">
                        <label for="nombreRutinaModal">Nombre de la Rutina</label>
                        <input id="nombreRutinaModal" name="nombre" type="text" placeholder="Ej: Full Body 3 días" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcionRutinaModal">Descripción (opcional)</label>
                        <textarea id="descripcionRutinaModal" name="descripcion" rows="3" placeholder="Describe tu rutina, objetivos, días de entrenamiento..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-crear">✅ Crear Rutina</button>
                </form>
            </div>

        @else
            <!-- Si NO hay usuario logueado -->
            <div class="login-required">
                <div class="login-icon">🔒</div>
                <h3>Necesitas iniciar sesión</h3>
                <p>Para crear y gestionar tus rutinas personalizadas, debes tener una cuenta activa en Workout 3D.</p>
                <div class="login-actions">
                    <a href="{{ route('auth') }}" class="btn-login">🔐 Iniciar Sesión</a>
                    <a href="{{ route('auth') }}" class="btn-register">📝 Registrarse</a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .modal-rutinas-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 2000;
        backdrop-filter: blur(8px);
    }

    .modal-rutinas-overlay.abierto {
        display: flex;
    }

    .modal-rutinas-content {
        width: 90%;
        max-width: 900px;
        max-height: 85vh;
        overflow-y: auto;
        background: linear-gradient(180deg, #0f1416, #0b0e10);
        border-radius: 20px;
        padding: 35px;
        border: 1px solid rgba(0, 180, 216, 0.15);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.9);
        animation: slideInUp 0.4s ease-out;
        position: relative;
    }

    .modal-close {
        position: absolute;
        right: 20px;
        top: 15px;
        cursor: pointer;
        font-size: 32px;
        color: var(--muted);
        transition: all 0.3s ease;
        z-index: 10;
    }

    .modal-close:hover {
        color: var(--danger);
        transform: rotate(90deg);
    }

    .modal-rutinas-title {
        color: var(--accent);
        font-size: 2rem;
        margin-bottom: 30px;
        font-family: 'Oswald', sans-serif;
        text-align: center;
        animation: fadeInUp 0.5s ease-out;
    }

    .rutinas-section {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .rutinas-section:nth-child(2) {
        animation-delay: 0.1s;
    }

    .rutinas-section:nth-child(4) {
        animation-delay: 0.2s;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(0, 180, 216, 0.3);
    }

    .section-header h3 {
        color: var(--accent);
        font-size: 1.4rem;
        margin: 0;
        font-family: 'Oswald', sans-serif;
    }

    .rutinas-count {
        background: rgba(0, 180, 216, 0.15);
        color: var(--accent);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .rutina-card {
        background: rgba(255, 255, 255, 0.02);
        padding: 20px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .rutina-card:hover {
        background: rgba(0, 180, 216, 0.05);
        border-color: rgba(0, 180, 216, 0.25);
        transform: translateX(4px);
    }

    .rutina-info {
        flex: 1;
    }

    .rutina-info h4 {
        color: #fff;
        font-size: 1.15rem;
        margin: 0 0 10px 0;
        font-family: 'Oswald', sans-serif;
    }

    .rutina-desc {
        color: var(--muted);
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0 0 10px 0;
    }

    .rutina-date {
        display: block;
        font-size: 0.8rem;
        color: var(--muted);
    }

    .rutina-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-action {
        flex: 1;
        min-width: 100px;
        padding: 10px 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-iniciar {
        background: linear-gradient(90deg, #2ec286, #5ce0a8);
        color: #000;
    }

    .btn-iniciar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(46, 194, 134, 0.4);
    }

    .btn-editar {
        background: var(--accent);
        color: #000;
    }

    .btn-editar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 180, 216, 0.4);
    }

    .btn-pdf {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .btn-pdf:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        border-color: var(--accent);
    }

    .btn-eliminar {
        background: #E63946;
        color: #fff;
    }

    .btn-eliminar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(230, 57, 70, 0.4);
    }

    .rutinas-empty {
        text-align: center;
        padding: 40px 20px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 12px;
        animation: fadeInUp 0.6s ease-out;
    }

    .empty-icon {
        font-size: 3.5rem;
        margin-bottom: 15px;
        animation: float 3s ease-in-out infinite;
    }

    .rutinas-empty p {
        color: var(--muted);
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .rutinas-empty small {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .modal-divider {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin: 30px 0;
    }

    .form-rutina {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        color: var(--muted);
        font-weight: 700;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-family: inherit;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: var(--accent);
        box-shadow: 0 0 15px rgba(0, 180, 216, 0.3);
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .btn-crear {
        width: 100%;
        padding: 14px;
        font-weight: 700;
        background: linear-gradient(90deg, var(--accent), #1CAAD9);
        color: #000;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.05rem;
        font-family: 'Oswald', sans-serif;
    }

    .btn-crear:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 180, 216, 0.4);
    }

    .login-required {
        text-align: center;
        padding: 60px 30px;
        animation: fadeInUp 0.6s ease-out;
    }

    .login-icon {
        font-size: 5rem;
        margin-bottom: 25px;
        animation: float 3s ease-in-out infinite;
    }

    .login-required h3 {
        color: var(--accent);
        font-size: 1.6rem;
        margin-bottom: 18px;
        font-family: 'Oswald', sans-serif;
    }

    .login-required p {
        color: var(--muted);
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 30px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .login-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-login,
    .btn-register {
        display: inline-block;
        padding: 14px 28px;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        font-family: 'Oswald', sans-serif;
    }

    .btn-login {
        background: linear-gradient(90deg, var(--accent), #1CAAD9);
        color: #000;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 180, 216, 0.4);
    }

    .btn-register {
        background: rgba(255, 255, 255, 0.1);
        color: var(--white);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-register:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--accent);
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .modal-rutinas-content {
            width: 95%;
            padding: 25px;
        }

        .modal-rutinas-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .rutina-card {
            flex-direction: column;
        }

        .rutina-actions {
            width: 100%;
            gap: 8px;
        }

        .btn-action {
            flex: 1;
            min-width: 60px;
        }

        .login-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn-login,
        .btn-register {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .modal-rutinas-content {
            width: 100%;
            max-height: 90vh;
            border-radius: 16px;
            padding: 20px;
        }

        .modal-close {
            right: 15px;
            top: 10px;
            font-size: 28px;
        }

        .modal-rutinas-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .section-header h3 {
            font-size: 1.1rem;
        }

        .rutinas-count {
            font-size: 0.75rem;
            padding: 6px 12px;
        }

        .rutina-card {
            padding: 15px;
            gap: 12px;
        }

        .rutina-info h4 {
            font-size: 1rem;
        }

        .rutina-actions {
            gap: 6px;
        }

        .btn-action {
            padding: 8px 10px;
            font-size: 0.85rem;
        }

        .form-rutina {
            gap: 15px;
        }

        .form-group label {
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px 12px;
            font-size: 16px;
        }

        .btn-crear {
            padding: 12px;
            font-size: 0.95rem;
        }

        .login-icon {
            font-size: 4rem;
        }

        .login-required h3 {
            font-size: 1.3rem;
        }

        .login-required p {
            font-size: 0.95rem;
        }
    }
</style>

<script>
    // ✅ Validación frontend con nombres existentes
    const rutinasExistentes = @json($rutinas->pluck('nombre')->toArray());

    // Cerrar modal
    const modalRutinas = document.getElementById('modalRutinas');
    const modalClose = document.getElementById('modalClose');
    
    modalClose?.addEventListener('click', function() {
        modalRutinas?.classList.remove('abierto');
    });

    // Cerrar al hacer clic fuera del modal
    modalRutinas?.addEventListener('click', function(event) {
        if (event.target === this) {
            this.classList.remove('abierto');
        }
    });

    // Validación del formulario
    document.getElementById('nombreRutinaModal')?.closest('form').addEventListener('submit', function(event) {
        const nombre = document.getElementById('nombreRutinaModal').value.trim();
        
        if (!nombre) {
            if (typeof showToast === 'function') {
                showToast('⚠️ El nombre de la rutina es obligatorio', 'error');
            } else {
                alert('El nombre de la rutina es obligatorio');
            }
            event.preventDefault();
            return false;
        }

        // Verificar si ya existe
        if (rutinasExistentes.includes(nombre)) {
            if (typeof showToast === 'function') {
                showToast('⚠️ Ya tienes una rutina con el nombre "' + nombre + '"', 'error');
            } else {
                alert('Ya tienes una rutina con ese nombre. Por favor, elige otro.');
            }
            event.preventDefault();
            return false;
        }

        return true;
    });
</script>


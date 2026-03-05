<!-- ===== NAVBAR ===== -->
<nav class="navbar" role="navigation" aria-label="Barra principal">
  <div class="navbar-inner">
    <div class="brand">
      <a href="{{ route('index') }}" class="brand-link">
          <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
          <span class="brand-title">Workout<span class="brand-accent">3D</span></span>
      </a>
    </div>

    <div class="nav-links" role="menubar" aria-label="Enlaces principales">
      <a href="{{ route('index') }}" class="{{ Route::is('index') ? 'active' : '' }}" role="menuitem">Inicio</a>
      <a href="{{ route('recursos') }}" class="{{ Route::is('recursos') ? 'active' : '' }}" role="menuitem">Recursos</a>
      <a href="{{ session()->has('usuario') ? route('progreso') : route('auth') }}" class="{{ Route::is('progreso') ? 'active' : '' }}" role="menuitem">Progreso</a>
      <a href="{{ route('tienda') }}" class="{{ Route::is('tienda') ? 'active' : '' }}" role="menuitem">Tienda</a>
    </div>

    <div class="nav-right">
      @if(session()->has('usuario'))
        <span class="user-greeting">Hola, <span class="user-name">{{ session('usuario') }}</span></span>
        <a class="btn btn-secondary btn-sm" href="{{ route('perfil') }}" aria-label="Perfil">Perfil</a>
        <a class="btn btn-ghost btn-sm" href="{{ route('logout') }}" aria-label="Cerrar sesión">Salir</a>
      @else
        <a class="btn btn-primary" href="{{ route('auth') }}" aria-label="Iniciar sesión">Iniciar sesión</a>
      @endif
    </div>
  </div>
</nav>


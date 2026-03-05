<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Workout 3D')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600&family=Oswald:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Model-viewer y Chart.js -->
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    <!-- CSS GLOBALES -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- CSS específicos por ruta -->
    @if(request()->is('auth*'))
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @elseif(request()->is('tienda*'))
        <link rel="stylesheet" href="{{ asset('css/tienda.css') }}">
    @elseif(request()->is('checkout*'))
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @elseif(request()->is('mis_compras*'))
        <link rel="stylesheet" href="{{ asset('css/mis_compras.css') }}">
    @elseif(request()->is('progreso*'))
        <link rel="stylesheet" href="{{ asset('css/progreso.css') }}">
    @elseif(request()->is('perfil*'))
        <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    @elseif(request()->is('biceps*') || request()->is('pecho*') || request()->is('abdomen*') || request()->is('espalda*') || request()->is('triceps*') || request()->is('piernas*') || request()->is('hombros*'))
        <link rel="stylesheet" href="{{ asset('css/musculos.css') }}">
    @elseif(request()->is('crear_rutina*'))
        <link rel="stylesheet" href="{{ asset('css/crear_rutina.css') }}">
    @elseif(request()->is('editar_rutina*'))
        <link rel="stylesheet" href="{{ asset('css/editar_rutina.css') }}">
    @endif

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    @if(
        !request()->is('auth*') &&
        !request()->is('perfil*') &&
        !request()->is('progreso*') &&
        !request()->is('recursos*') &&
        !request()->is('biceps*') &&
        !request()->is('pecho*') &&
        !request()->is('abdomen*') &&
        !request()->is('espalda*') &&
        !request()->is('triceps*') &&
        !request()->is('piernas*') &&
        !request()->is('hombros*') &&
        !request()->is('tienda*') &&
        !request()->is('mis_compras*') &&
        !request()->is('crear_rutina*') &&
        !request()->is('editar_rutina*') &&
        !request()->is('checkout*') &&
        !request()->is('rutina/*/iniciar')
    )
        @include('layouts.navbar')
    @endif

    <!-- ===== TOASTS ===== -->
    <div class="toasts" id="toasts" aria-live="polite" aria-atomic="true"></div>

    @if(!empty($toast_msg ?? ''))
        <script>
            window._INITIAL_TOAST = { text: @json($toast_msg), type: @json($toast_type ?? 'info') };
            
            @if(session('clear_cart'))
                window._CLEAR_CART = true;
            @endif
        </script>
    @endif

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="main @if(request()->is('auth*')) auth-main @endif" role="main">
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    @if(
        !request()->is('auth*') &&
        !request()->is('perfil*') &&
        !request()->is('progreso*') &&
        !request()->is('recursos*') &&
        !request()->is('biceps*') &&
        !request()->is('pecho*') &&
        !request()->is('abdomen*') &&
        !request()->is('espalda*') &&
        !request()->is('triceps*') &&
        !request()->is('piernas*') &&
        !request()->is('hombros*') &&
        !request()->is('tienda*') &&
        !request()->is('mis_compras*') &&
        !request()->is('crear_rutina*') &&
        !request()->is('editar_rutina*') &&
        !request()->is('checkout*') &&
        !request()->is('rutina/*/iniciar')
    )
        @include('layouts.footer')
    @endif

    <!-- Scripts globales desde public/js/ -->
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}" defer></script>

    <!-- Scripts específicos por ruta -->
    @if(request()->is('auth*'))
        <script src="{{ asset('js/auth.js') }}" defer></script>
    @elseif(request()->is('tienda*') || request()->is('checkout*'))
        <script src="{{ asset('js/procesar_compra.js') }}" defer></script>
    @endif

    @stack('scripts')

    <div aria-hidden="true"></div>
</body>
</html>


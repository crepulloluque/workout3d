@extends('layouts.master')

@section('title', 'Mis Compras - Workout 3D')

@section('content')
    <section class="compras-container">
        <header class="compras-header">
            <span class="eyebrow">Historial</span>
            <h1>Mis compras</h1>
            <p class="text-muted">Resumen de tus pedidos recientes y detalles de cada compra.</p>
        </header>

        @if (session('mensaje_compra'))
            <div class="compras-alert">
                {{ session('mensaje_compra') }}
            </div>
        @endif

        @if ($compras->isEmpty())
            <div class="compras-empty">
                <div class="icon">🛍️</div>
                <p class="text-muted">No has realizado ninguna compra todavía.</p>
                <a href="{{ route('tienda') }}" class="btn btn-ghost">Explorar tienda</a>
            </div>
        @else
            @foreach ($compras as $compra)
                <article class="compra-card">
                    <div class="compra-header">
                        <div>
                            <h2 class="compra-id">Compra #{{ $compra->id }}</h2>
                            <div class="compra-fecha">📅 {{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="compra-fecha">🚚 {{ $compra->direccion_envio }}, {{ $compra->codigo_postal }} ({{ $compra->provincia }}, {{ $compra->pais }})</div>
                    </div>

                    <div class="compra-productos">
                        @foreach ($detalles[$compra->id] as $p)
                            <div class="compra-producto-item">
                                <img src="{{ $p->imagen_url }}" alt="{{ $p->producto_nombre }}">
                                <div class="compra-producto-info">
                                    <h4>{{ $p->producto_nombre }}</h4>
                                    <p>Cantidad: {{ $p->cantidad }} &bull; {{ number_format($p->precio_unitario, 2) }} €</p>
                                    <p>Subtotal: {{ number_format($p->subtotal, 2) }} €</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="compra-footer">
                        <span class="compra-total-label">Total</span>
                        <span class="compra-total-val">{{ number_format($compra->total, 2) }} €</span>
                    </div>
                </article>
            @endforeach
        @endif

        <div class="btn-volver-container">
            <a href="{{ route('tienda') }}" class="btn btn-ghost">← Volver a la tienda</a>
        </div>
    </section>
@endsection

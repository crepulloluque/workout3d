@extends('layouts.master')

@section('title', 'Suplementos Élite - Workout 3D')

@section('content')
    @php
        $carritoCount = collect(session('carrito', []))->sum('cantidad');
    @endphp

    <section class="tienda-page">
        <div class="tienda-hero">
            <div class="tienda-hero-inner">
                <div class="hero-copy">
                    <span class="eyebrow">Arsenal de suplementos</span>
                    <h1 class="hero-title">Suplementos elite para <span>resultados reales</span></h1>
                    <p class="hero-subtitle">Selección de alto rendimiento para acelerar tu progreso con calidad verificada.</p>
                    <div class="hero-actions">
                        <a href="#catalogo" class="btn btn-primary">Explorar catalogo</a>
                        <a href="{{ route('index') }}" class="btn btn-ghost">Volver al inicio</a>
                    </div>
                </div>
                <div class="hero-panel glass-panel">
                    <div class="hero-stat">
                        <span class="label">Productos activos</span>
                        <span class="value">{{ $productos->count() }}</span>
                    </div>
                    <div class="hero-stat">
                        <span class="label">Carrito</span>
                        <span class="value">{{ $carritoCount }} item(s)</span>
                    </div>
                    <div class="hero-note">Entrega rapida, empaques seguros y recomendaciones expertas.</div>
                </div>
            </div>
        </div>

        @if (session('mensaje_compra'))
            <div class="tienda-alert">
                {{ session('mensaje_compra') }}
            </div>
        @endif

        <div class="tienda-body">
            <div class="tienda-filtros" aria-label="Filtros de categoria">
                <a href="{{ route('tienda') }}" class="btn {{ !request('categoria') ? 'btn-primary' : 'btn-ghost' }}">Todo</a>
                @foreach(['Proteína', 'Creatina', 'Vitaminas', 'Accesorios'] as $cat)
                    <a href="{{ route('tienda', ['categoria' => $cat]) }}" class="btn {{ request('categoria') === $cat ? 'btn-primary' : 'btn-ghost' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <div class="tienda-benefits">
                <div class="benefit-card">
                    <span class="benefit-title">Envio rapido</span>
                    <p>Preparacion en 24h y seguimiento en tiempo real.</p>
                </div>
                <div class="benefit-card">
                    <span class="benefit-title">Calidad verificada</span>
                    <p>Productos seleccionados con estandares de laboratorio.</p>
                </div>
                <div class="benefit-card">
                    <span class="benefit-title">Soporte experto</span>
                    <p>Recomendaciones segun tu objetivo y nivel.</p>
                </div>
            </div>

            <div id="catalogo" class="productos-grid">
                @forelse($productos as $p)
                    <article class="producto-card card glass-panel">
                        <div class="producto-media">
                            <img src="{{ asset($p->imagen_url) }}" alt="{{ $p->nombre }}">
                            <span class="badge-accent">Premium</span>
                        </div>
                        <div class="producto-info">
                            <h3>{{ $p->nombre }}</h3>
                            <p>{{ Str::limit($p->descripcion, 100) }}</p>
                            <div class="producto-precio">{{ number_format($p->precio, 2) }} €</div>
                            <form method="POST" action="{{ route('tienda.agregar') }}">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $p->id }}">
                                <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="tienda-empty">
                        <h3 class="text-muted">La bóveda esta vacia por ahora.</h3>
                    </div>
                @endforelse
            </div>

            <section id="carrito" class="carrito-section glass-panel">
                <div class="carrito-header">
                    <div>
                        <span class="eyebrow">Manifiesto de suministros</span>
                        <h2>Tu carrito</h2>
                    </div>
                    <a href="{{ route('mis_compras') }}" class="btn btn-ghost">Historial de adquisiciones</a>
                </div>

                @if(!empty(session('carrito')))
                    @php $total = 0; @endphp
                    <div class="carrito-list">
                        @foreach(session('carrito') as $id => $item)
                            <div class="carrito-item">
                                <img src="{{ asset($item['imagen']) }}" alt="">
                                <div class="item-details">
                                    <div class="name">{{ $item['nombre'] }}</div>
                                    <div class="price">{{ $item['cantidad'] }} unidad(es) &bull; {{ number_format($item['precio'] * $item['cantidad'], 2) }} €</div>
                                </div>
                                <form method="POST" action="{{ route('tienda.eliminar', $id) }}" class="inline-form">
                                    @csrf
                                    <button type="submit" class="btn btn-ghost remove" title="Eliminar">🗑️</button>
                                </form>
                            </div>
                            @php $total += $item['precio'] * $item['cantidad']; @endphp
                        @endforeach
                    </div>

                    <div class="carrito-total">
                        <span>Inversion total</span>
                        <strong>{{ number_format($total, 2) }} €</strong>
                    </div>

                    <div class="carrito-actions">
                        <form method="POST" action="{{ route('tienda.vaciar') }}" class="inline-form">
                            @csrf
                            <button type="submit" class="btn btn-ghost danger">Vaciar carrito</button>
                        </form>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Tramitar pedido</a>
                    </div>
                @else
                    <div class="carrito-empty">
                        <div class="icon">🛒</div>
                        <p class="text-muted">Tu inventario esta vacio. Empieza a equiparte.</p>
                        <a href="#catalogo" class="btn btn-ghost">Explorar catalogo</a>
                    </div>
                @endif
            </section>
        </div>
    </section>
@endsection

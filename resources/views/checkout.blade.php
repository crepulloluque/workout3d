@extends('layouts.master')

@section('title', 'Finalizar compra - Workout 3D')

@section('content')
    @php $total = 0; @endphp
    <section class="checkout-hero">
        <div class="checkout-hero-inner">
            <div>
                <span class="eyebrow">Checkout</span>
                <h1>Finaliza tu pedido</h1>
                <p>Revisa tu carrito y completa los datos para cerrar la compra.</p>
            </div>
            <a href="{{ route('tienda') }}" class="btn btn-ghost">Volver a la tienda</a>
        </div>
    </section>

    <div class="checkout-container">
        <div class="checkout-items">
            @forelse(session('carrito', []) as $producto)
                <div class="checkout-item">
                    <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}">
                    <div class="checkout-item-info">
                        <h3>{{ $producto['nombre'] }}</h3>
                        <p>{{ $producto['cantidad'] }} unidad(es) &bull; {{ number_format($producto['precio'], 2) }} €</p>
                    </div>
                </div>
                @php $total += ($producto['precio'] * $producto['cantidad']); @endphp
            @empty
                <p class="text-muted">Tu carrito está vacío.</p>
            @endforelse
        </div>

        <div class="total-section">
            <span class="total-label">Total a pagar</span>
            <span class="total-amount">{{ number_format($total, 2) }} €</span>
        </div>

        <div class="checkout-steps">
            <span class="step active">1. Envio</span>
            <span class="step">2. Pago</span>
            <span class="step">3. Confirmar</span>
        </div>

        <form class="checkout-form" action="{{ route('procesar_compra') }}" method="POST">
            @csrf

            <div id="form-envio" class="checkout-form-section active">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" type="text" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input id="apellidos" type="text" name="apellidos" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input id="telefono" type="tel" name="telefono" pattern="[0-9]{9,15}" required>
                    </div>
                    <div class="form-group">
                        <label for="pais">Pais</label>
                        <input id="pais" type="text" name="pais" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input id="provincia" type="text" name="provincia" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal">Codigo postal</label>
                        <input id="codigo_postal" type="text" name="codigo_postal" pattern="[0-9]{4,10}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <textarea id="direccion" name="direccion" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tipo_entrega">Tipo de entrega</label>
                    <select id="tipo_entrega" name="tipo_entrega" required>
                        <option value="domicilio">Domicilio</option>
                        <option value="recogida">Recogida en tienda</option>
                        <option value="express">Express (24h)</option>
                    </select>
                </div>

                <button type="button" class="btn btn-checkout" onclick="siguientePaso(2)">Continuar con el pago</button>
            </div>

            <div id="form-pago" class="checkout-form-section">
                <div class="form-group">
                    <label for="metodo_pago">Metodo de pago</label>
                    <select id="metodo_pago" name="metodo_pago" required onchange="mostrarPago()">
                        <option value="">Selecciona un metodo</option>
                        <option value="tarjeta">Tarjeta de credito</option>
                        <option value="bizum">Bizum</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>

                <div id="pago-tarjeta" class="payment-panel">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="num_tarjeta">Numero de tarjeta</label>
                            <input id="num_tarjeta" type="text" maxlength="16" inputmode="numeric" placeholder="1234 5678 9012 3456">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input id="cvv" type="text" maxlength="3" inputmode="numeric" placeholder="123">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="exp_mes">Mes</label>
                            <input id="exp_mes" type="text" maxlength="2" inputmode="numeric" placeholder="MM">
                        </div>
                        <div class="form-group">
                            <label for="exp_anio">Ano</label>
                            <input id="exp_anio" type="text" maxlength="2" inputmode="numeric" placeholder="AA">
                        </div>
                    </div>
                </div>

                <div id="pago-bizum" class="payment-panel">
                    <div class="form-group">
                        <label for="bizum_numero">Numero de Bizum</label>
                        <input id="bizum_numero" type="text" maxlength="9" inputmode="numeric" placeholder="600123456">
                    </div>
                </div>

                <div id="pago-paypal" class="payment-panel">
                    <p class="text-muted">Te redirigiremos a PayPal al confirmar el pedido.</p>
                </div>

                <div class="checkout-actions">
                    <button type="button" class="btn btn-ghost" onclick="siguientePaso(1)">Volver</button>
                    <button type="button" class="btn btn-checkout" onclick="siguientePaso(3)">Revisar pedido</button>
                </div>
            </div>

            <div id="form-finalizar" class="checkout-form-section">
                <div class="confirm-box">
                    <p class="text-muted">Estas a un paso de completar la compra.</p>
                    <div class="total-section">
                        <span class="total-label">Total final</span>
                        <span class="total-amount">{{ number_format($total, 2) }} €</span>
                    </div>
                </div>
                <div class="checkout-actions">
                    <button type="button" class="btn btn-ghost" onclick="siguientePaso(2)">Editar pago</button>
                    <button type="submit" class="btn btn-checkout">Finalizar compra</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.master')

@section('title', 'Procesar Compra - Workout 3D')



@section('content')
    <div class="container">
        @if($compra_realizada ?? false)
            <div class="confirmacion">
                ✅ <strong>¡Gracias por tu compra!</strong><br>
                Tu pedido se ha procesado correctamente.<br><br>
                <a href="{{ route('tienda') }}" style="color:#00b4d8;text-decoration:underline;">Volver a la tienda</a>
            </div>
        @else
            <h2>Introduce tus datos para finalizar la compra</h2>

            @if($error ?? false)
                <p class="error">{{ $error }}</p>
            @endif

            <div class="steps">
                <div class="step active" id="step-envio">1️⃣ Envío</div>
                <div class="step" id="step-pago">2️⃣ Pago</div>
                <div class="step" id="step-finalizar">3️⃣ Finalizar</div>
            </div>

            <!-- Paso 1: Envío -->
            <form id="form-envio" class="active">
                <label>Nombre:</label><input type="text" id="nombre" required>
                <label>Apellidos:</label><input type="text" id="apellidos" required>
                <label>Teléfono:</label><input type="tel" id="telefono" required>
                <label>Dirección:</label><textarea id="direccion" required></textarea>
                <label>País:</label><input type="text" id="pais" required>
                <label>Provincia:</label><input type="text" id="provincia" required>
                <label>Código Postal:</label><input type="text" id="codigo_postal" required>
                <label>Tipo de envío:</label>
                <select id="tipo_entrega" required>
                    <option value="recogida">Punto de recogida</option>
                    <option value="domicilio">Domicilio estándar</option>
                    <option value="express">Domicilio exprés</option>
                </select>
                <button type="button" onclick="siguientePaso(2)">Continuar a pago</button>
            </form>

            <!-- Paso 2: Pago -->
            <form id="form-pago">
                <h3 style="color:#00b4d8; text-align:center;">Método de pago</h3>
                <label>¿Cómo quieres pagar?</label>
                <select id="metodo_pago" onchange="mostrarPago()" required>
                    <option value="">Selecciona un método</option>
                    <option value="tarjeta">💳 Tarjeta de crédito</option>
                    <option value="bizum">📱 Bizum</option>
                    <option value="paypal">🅿️ PayPal</option>
                </select>

                <!-- Tarjeta -->
                <div id="pago-tarjeta" style="display:none; margin-top:15px;">
                    <label>Número de tarjeta:</label>
                    <input type="text" id="num_tarjeta" maxlength="16" placeholder="1234 5678 9012 3456">
                    <label>Fecha de expiración:</label>
                    <div style="display:flex; gap:10px;">
                        <input type="text" id="exp_mes" maxlength="2" placeholder="MM" style="width:70px;">
                        <input type="text" id="exp_anio" maxlength="2" placeholder="AA" style="width:70px;">
                    </div>
                    <label>CVV:</label>
                    <input type="text" id="cvv" maxlength="3" placeholder="123">
                </div>

                <!-- Bizum -->
                <div id="pago-bizum" style="display:none; margin-top:15px;">
                    <label>Número de teléfono (Bizum):</label>
                    <input type="tel" id="bizum_numero" placeholder="Ej: 612345678" maxlength="9">
                </div>

                <!-- PayPal -->
                <div id="pago-paypal" style="display:none; margin-top:15px; text-align:center;">
                    <p>Serás redirigido a <strong>PayPal</strong> para completar tu compra de forma segura.</p>
                    <img src="https://www.paypalobjects.com/webstatic/icon/pp258.png" alt="Logo PayPal" style="width:90px; margin-top:10px;">
                </div>

                <button type="button" onclick="siguientePaso(3)">Revisar y finalizar</button>
            </form>

            <!-- Paso 3: Finalizar -->
            <form id="form-finalizar" method="POST" action="{{ route('procesar_compra') }}">
                @csrf
                <input type="hidden" name="finalizar_compra" value="1">
                <input type="hidden" name="nombre" id="input_nombre">
                <input type="hidden" name="apellidos" id="input_apellidos">
                <input type="hidden" name="telefono" id="input_telefono">
                <input type="hidden" name="direccion" id="input_direccion">
                <input type="hidden" name="pais" id="input_pais">
                <input type="hidden" name="provincia" id="input_provincia">
                <input type="hidden" name="codigo_postal" id="input_codigo_postal">
                <input type="hidden" name="tipo_entrega" id="input_tipo_entrega">
                <input type="hidden" name="metodo_pago" id="input_metodo_pago">

                <h3>Revisa tu compra</h3>
                <div class="productos">
                    @php $total = 0; @endphp
                    @foreach(session('carrito', []) as $id => $producto)
                        @php $subtotal = $producto['precio'] * $producto['cantidad']; $total += $subtotal; @endphp
                        <div class="producto">
                            <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}">
                            <div class="producto-info">
                                <strong>{{ $producto['nombre'] }}</strong><br>
                                Cantidad: {{ $producto['cantidad'] }}<br>
                                Precio: {{ number_format($producto['precio'], 2) }} €
                            </div>
                            <div><strong>{{ number_format($subtotal, 2) }} €</strong></div>
                        </div>
                    @endforeach
                </div>
                <div class="total">Total: {{ number_format($total, 2) }} €</div>
                <button type="submit">Finalizar compra</button>
            </form>
        @endif
    </div>
@endsection

@push('scripts')
    
@endpush

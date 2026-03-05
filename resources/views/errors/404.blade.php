<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>404 - Página no encontrada | Workout 3D</title>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:#071017; --card:#0f1315; --accent:#00b4d8; --accent-2:#1CAAD9;
      --muted:#9aa7b0; --text:#f1f5f8;
    }
    * { box-sizing:border-box; margin:0; padding:0; }
    body {
      font-family:"Lato","Segoe UI",Arial,sans-serif;
      background:linear-gradient(135deg,var(--bg),#031216);
      color:var(--text);
      min-height:100vh;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      padding:20px;
      overflow:hidden;
    }
    .container {
      text-align:center;
      max-width:700px;
      width:100%;
      animation:fadeIn 0.8s ease;
    }
    @keyframes fadeIn {
      from { opacity:0; transform:translateY(20px); }
      to { opacity:1; transform:translateY(0); }
    }
    .error-code {
      font-family:"Oswald",sans-serif;
      font-size:9rem;
      font-weight:700;
      color:var(--accent);
      text-shadow:0 0 40px rgba(0,180,216,0.6);
      margin-bottom:10px;
      line-height:1;
    }
    .dumbbell {
      font-size:4rem;
      margin:0 0 20px;
      animation:spin 3s linear infinite;
    }
    @keyframes spin {
      from { transform:rotate(0deg); }
      to { transform:rotate(360deg); }
    }
    h1 {
      font-family:"Oswald",sans-serif;
      font-size:2.2rem;
      color:var(--text);
      margin-bottom:12px;
    }
    p {
      color:var(--muted);
      font-size:1.1rem;
      margin-bottom:30px;
      line-height:1.6;
    }
    .btn-container {
      display:flex;
      gap:12px;
      justify-content:center;
      flex-wrap:wrap;
    }
    a.btn {
      display:inline-block;
      padding:14px 24px;
      background:linear-gradient(90deg,var(--accent),var(--accent-2));
      color:#031216;
      font-weight:700;
      text-decoration:none;
      border-radius:10px;
      box-shadow:0 8px 20px rgba(0,0,0,0.5);
      transition:transform .2s, box-shadow .2s;
      font-family:"Oswald",sans-serif;
      font-size:1rem;
    }
    a.btn:hover {
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(0,180,216,0.5);
    }
    a.btn.secondary {
      background:rgba(255,255,255,0.05);
      color:var(--text);
      border:1px solid rgba(255,255,255,0.1);
    }
    a.btn.secondary:hover {
      background:rgba(255,255,255,0.08);
    }
    .footer-info {
      margin-top:40px;
      color:var(--muted);
      font-size:0.9rem;
    }
    @media (max-width:600px) {
      .error-code { font-size:6rem; }
      h1 { font-size:1.6rem; }
      p { font-size:1rem; }
      .btn-container { flex-direction:column; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="dumbbell">🏋️</div>
    <div class="error-code">404</div>
    <h1>¡Página no encontrada!</h1>
    <p>
      Parece que esta página se ha saltado el día de pierna.<br>
      No te preocupes, podemos llevarte de vuelta al gimnasio.
    </p>
    <div class="btn-container">
      <a class="btn" href="{{ url('/') }}">Volver al inicio</a>
      <a class="btn secondary" href="javascript:history.back()">Página anterior</a>
    </div>
    <div class="footer-info">
      © {{ date('Y') }} Workout 3D — Entrena inteligente
    </div>
  </div>
</body>
</html>

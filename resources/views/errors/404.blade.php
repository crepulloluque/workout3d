<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>404 - Pagina no encontrada | Workout 3D</title>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:#071017;
      --accent:#00bef0;
      --accent-2:#0077b6;
      --muted:#9aa7b0;
      --text:#f1f5f8;
      --panel:rgba(15,19,21,0.82);
      --border:rgba(255,255,255,0.08);
    }

    * { box-sizing:border-box; margin:0; padding:0; }

    body {
      font-family:"Lato","Segoe UI",Arial,sans-serif;
      background:
        radial-gradient(circle at 15% 20%, rgba(0,190,240,0.14), transparent 34%),
        radial-gradient(circle at 85% 80%, rgba(0,119,182,0.11), transparent 36%),
        linear-gradient(135deg,var(--bg),#031216);
      color:var(--text);
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
    }

    .container {
      width:min(720px,100%);
      text-align:center;
      padding:40px 32px;
      border-radius:24px;
      border:1px solid var(--border);
      background:linear-gradient(160deg, var(--panel), rgba(7,16,23,0.92));
      box-shadow:0 24px 60px rgba(0,0,0,0.42);
      animation:fadeIn .7s ease;
      backdrop-filter:blur(10px);
    }

    @keyframes fadeIn {
      from { opacity:0; transform:translateY(18px); }
      to { opacity:1; transform:translateY(0); }
    }

    .badge {
      display:inline-block;
      margin-bottom:16px;
      padding:7px 12px;
      border-radius:999px;
      border:1px solid rgba(0,190,240,0.22);
      background:rgba(0,190,240,0.1);
      color:var(--accent);
      font-size:.78rem;
      font-weight:700;
      letter-spacing:.14em;
      text-transform:uppercase;
    }

    .error-code {
      font-family:"Oswald",sans-serif;
      font-size:clamp(4.5rem, 12vw, 7rem);
      line-height:1;
      color:var(--accent);
      text-shadow:0 0 36px rgba(0,190,240,0.42);
      margin-bottom:8px;
    }

    h1 {
      font-family:"Oswald",sans-serif;
      font-size:clamp(1.7rem, 4vw, 2.5rem);
      margin-bottom:12px;
    }

    p {
      max-width:44ch;
      margin:0 auto;
      color:var(--muted);
      font-size:1rem;
      line-height:1.7;
    }

    .actions {
      margin-top:28px;
      display:flex;
      justify-content:center;
      gap:12px;
      flex-wrap:wrap;
    }

    .btn {
      display:inline-block;
      padding:12px 22px;
      border-radius:10px;
      text-decoration:none;
      font-family:"Oswald",sans-serif;
      font-size:1rem;
      transition:transform .2s, box-shadow .2s, background .2s;
    }

    .btn.primary {
      background:linear-gradient(90deg,var(--accent),var(--accent-2));
      color:#031216;
      box-shadow:0 12px 26px rgba(0,190,240,0.22);
    }

    .btn.secondary {
      background:rgba(255,255,255,0.05);
      border:1px solid rgba(255,255,255,0.1);
      color:var(--text);
    }

    .btn:hover {
      transform:translateY(-2px);
      box-shadow:0 14px 28px rgba(0,0,0,0.28);
    }

    .footer-info {
      margin-top:22px;
      color:var(--muted);
      font-size:.9rem;
    }

    @media (max-width:640px) {
      .container { padding:28px 20px; }
      .actions { flex-direction:column; }
      .btn { width:100%; }
    }
  </style>
</head>
<body>
  <main class="container">
    <div class="badge">Workout 3D</div>
    <div class="error-code">404</div>
    <h1>Pagina no encontrada</h1>
    <p>
      Parece que te has salido de la ruta. La pagina que buscas no existe o ha sido movida.
      Puedes volver al inicio y seguir navegando con normalidad.
    </p>

    <div class="actions">
      <a class="btn primary" href="{{ url('/') }}">Volver al inicio</a>
      <a class="btn secondary" href="javascript:history.back()">Pagina anterior</a>
    </div>

    <div class="footer-info">© {{ date('Y') }} Workout 3D</div>
  </main>
</body>
</html>

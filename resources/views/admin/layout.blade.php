<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title') - Admin Workout 3D</title>
  <style>
    :root { --bg:#071017; --card:#0f1315; --accent:#00b4d8; --muted:#9aa7b0; --text:#f1f5f8; }
    * { box-sizing:border-box; margin:0; padding:0; }
    body { font-family:"Lato",Arial,sans-serif; background:linear-gradient(135deg,var(--bg),#031216); color:var(--text); }
    .navbar { background:#0f1315; padding:12px 20px; display:flex; align-items:center; gap:20px; border-bottom:1px solid rgba(255,255,255,0.05); }
    .navbar a { color:var(--text); text-decoration:none; padding:8px 12px; border-radius:6px; }
    .navbar a:hover { background:rgba(255,255,255,0.05); }
    .navbar .logout { margin-left:auto; color:#E63946; }
    .main { max-width:1200px; margin:40px auto; padding:20px; }
    h1 { color:var(--accent); margin-bottom:30px; }
    .stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:20px; margin-bottom:40px; }
    .stat-card { background:var(--card); padding:20px; border-radius:12px; text-align:center; }
    .stat-card h3 { color:var(--muted); font-size:0.9rem; margin-bottom:10px; }
    .stat-card p { font-size:2rem; color:var(--accent); font-weight:700; }
    table { width:100%; background:var(--card); border-radius:12px; overflow:hidden; }
    th,td { padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.05); }
    th { background:rgba(0,180,216,0.1); color:var(--accent); }
    .btn { background:var(--accent); color:#000; padding:8px 12px; border-radius:6px; border:none; cursor:pointer; text-decoration:none; display:inline-block; }
    .btn-danger { background:#E63946; color:#fff; }
    .success { background:rgba(46,194,134,0.1); border:1px solid rgba(46,194,134,0.3); color:#2ec286; padding:12px; border-radius:8px; margin-bottom:20px; }
  </style>
</head>
<body>
  <nav class="navbar">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.usuarios') }}">Usuarios</a>
    <a href="{{ route('admin.productos') }}">Productos</a>
    <a href="{{ route('admin.pedidos') }}">Pedidos</a>
    <a href="{{ route('admin.logout') }}" class="logout">Salir</a>
  </nav>
  <div class="main">
    @if(session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif
    @yield('content')
  </div>
</body>
</html>

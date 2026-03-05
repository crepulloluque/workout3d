<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Workout 3D</title>
    <style>
        :root {
            --admin-bg: #0a0e27;
            --admin-card: #131a35;
            --admin-accent: #00b4d8;
            --admin-danger: #e63946;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, var(--admin-bg), #031216);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background: var(--admin-card);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        h1 {
            color: var(--admin-accent);
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .alert-error {
            background: rgba(230, 57, 70, 0.2);
            color: var(--admin-danger);
            border: 1px solid var(--admin-danger);
        }

        .alert-success {
            background: rgba(46, 194, 134, 0.2);
            color: #2ec286;
            border: 1px solid #2ec286;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #9aa7b0;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.03);
            color: #fff;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--admin-accent);
            box-shadow: 0 0 10px rgba(0,180,216,0.3);
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, var(--admin-accent), #1CAAD9);
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: transform 0.3s;
        }

        button:hover {
            transform: scale(1.02);
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #9aa7b0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>🔧 Admin Panel</h1>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required autofocus>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <p class="footer-text">Workout 3D Admin</p>
    </div>
</body>
</html>

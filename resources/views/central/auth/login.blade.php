<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MultiStore OS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #050507;
            --accent-purple: #8b5cf6;
            --accent-blue: #3b82f6;
            --card-bg: rgba(15, 15, 25, 0.7);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(59, 130, 246, 0.15) 0%, transparent 40%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin: 0;
            overflow: hidden;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff;
            padding: 0.8rem 1.2rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-purple);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.2);
            color: #fff;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            border: none;
            border-radius: 12px;
            color: #fff;
            width: 100%;
            padding: 0.8rem;
            font-weight: 700;
            margin-top: 1.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5);
            filter: brightness(1.1);
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.8rem;
        }

        .glow-dot {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--accent-purple);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--accent-purple);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.4; }
            50% { opacity: 1; }
            100% { opacity: 0.4; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">MultiStore<br><small style="font-weight: 300; font-size: 1rem">CORE TERMINAL</small></div>
        
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small text-muted">IDENTIFICADOR DE ACCESO</label>
                <input type="email" name="email" class="form-control" placeholder="admin@multistore.io" required autofocus>
            </div>
            
            <div class="mb-4">
                <label class="form-label small text-muted">CLAVE DE SEGURIDAD</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small text-muted" for="remember">
                    MANTENER SESIÓN ACTIVA
                </label>
            </div>

            <button type="submit" class="btn btn-login">INICIAR SUBSISTEMA</button>
        </form>

        <div class="footer-text">
            © 2026 NEURAL INTERFACE v4.0.2<br>
            RESTRICTED ACCESS
        </div>
    </div>

    <!-- Decorative particles -->
    <div class="glow-dot" style="top: 10%; left: 15%"></div>
    <div class="glow-dot" style="top: 80%; left: 85%; animation-delay: 0.5s"></div>
    <div class="glow-dot" style="top: 40%; left: 90%; animation-delay: 1.2s"></div>
</body>
</html>

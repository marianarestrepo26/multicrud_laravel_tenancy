<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ tenant('name') ?? 'Tienda' }} | MultiStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --bg-color: #030305;
            --navbar-bg: rgba(10, 10, 15, 0.8);
            --accent-purple: #8b5cf6;
            --accent-blue: #3b82f6;
            --card-bg: rgba(20, 20, 30, 0.6);
            --border-color: rgba(139, 92, 246, 0.2);
            --text-main: #f1f5f9;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(139, 92, 246, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 40%);
        }

        .navbar {
            background: var(--navbar-bg) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
        }

        .hero {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
            border-bottom: 1px solid var(--border-color);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(255,255,255,0.01) 40px, rgba(255,255,255,0.01) 41px);
            transform: rotate(15deg);
            pointer-events: none;
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: var(--accent-purple);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .product-img {
            height: 240px;
            object-fit: cover;
            filter: grayscale(20%);
            transition: all 0.5s;
        }

        .card:hover .product-img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7) !important;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: var(--accent-purple) !important;
        }

        footer {
            background: rgba(5, 5, 10, 0.9);
            border-top: 1px solid var(--border-color);
            padding: 3rem 0;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tenant.home') }}">
                {{ tenant('name') ?? 'Mi Tienda' }}
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('tenant.admin.products.index') }}" class="nav-link px-3 bg-white bg-opacity-5 rounded-pill">
                                ⚙️ Panel Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('tenant.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent">Cerrar Sesión</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ url('/login') }}" class="btn btn-primary">Iniciar Sesión</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex-grow-1">
        @yield('content')
    </div>

    <footer>
        <div class="container text-center">
            <p class="mb-2 fw-bold" style="letter-spacing: 2px; color: var(--accent-blue)">{{ strtoupper(tenant('name')) }}</p>
            <p class="mb-0 text-muted small">&copy; {{ date('Y') }} Protocolo de Tienda Activo. Todos los derechos reservados.</p>
            <div class="mt-3 small text-muted opacity-50">POWERED BY MULTISTORE QUANTUM CORE</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Confirmado',
                text: "{{ session('success') }}",
                background: '#0a0a0f',
                color: '#f1f5f9',
                confirmButtonColor: '#8b5cf6'
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Fallo de Sistema',
                text: "{{ session('error') }}",
                background: '#0a0a0f',
                color: '#f1f5f9',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración Central - MultiStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
        }

        .nav-link {
            color: #4b5563;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #4f46e5;
            background-color: #f3f4f6;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4 text-primary fw-bold px-2">MultiStore Admin</h4>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('tenants.index') }}"
                        class="nav-link {{ request()->routeIs('tenants.*') ? 'active' : '' }}">
                        🏢 Tenants (Tiendas)
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.index') }}"
                        class="nav-link {{ request()->routeIs('admins.*') ? 'active' : '' }}">
                        👤 Administradores
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light px-4 py-3">
                <div class="container-fluid">
                    <h5 class="mb-0 text-muted">@yield('header', 'Dashboard')</h5>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Admin Central
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Salir</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="p-4">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es" class="dark" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MultiStore - Admin Central</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --bg-color: #050507;
            --sidebar-bg: #0a0a0f;
            --card-bg: rgba(15, 15, 25, 0.7);
            --accent-purple: #8b5cf6;
            --accent-blue: #3b82f6;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --border-color: rgba(139, 92, 246, 0.2);
            --glow-purple: 0 0 15px rgba(139, 92, 246, 0.3);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding: 1.5rem 1rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            transition: all 0.2s;
            margin: 0.2rem 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(139, 92, 246, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.2));
            border-left: 4px solid var(--accent-purple);
            box-shadow: var(--glow-purple);
        }

        /* Card Styling */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }

        .card:hover {
            border-color: rgba(139, 92, 246, 0.4);
        }

        /* Topbar Styling */
        .navbar {
            background-color: rgba(5, 5, 7, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
            filter: brightness(1.1);
        }

        .btn-outline-secondary {
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            border-radius: 10px;
        }

        .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        /* Tables */
        .table {
            color: var(--text-main);
            --bs-table-bg: transparent;
            --bs-table-hover-bg: transparent;
            border-collapse: separate;
            border-spacing: 0 12px;
            margin-top: -12px; /* Offset the spacing for the first row */
        }

        .table thead th {
            background: transparent !important;
            border-bottom: none !important;
            color: var(--accent-blue);
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 2px;
            padding: 1rem 1.5rem;
            font-weight: 700;
        }

        .table tbody tr {
            background: #000000 !important;
            border: 1px solid rgba(139, 92, 246, 0.3) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .table td {
            padding: 1.5rem !important;
            border: none !important;
            background: transparent !important;
        }

        .table td:first-child {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            border-left: 1px solid rgba(139, 92, 246, 0.3) !important;
        }

        .table td:last-child {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            border-right: 1px solid rgba(139, 92, 246, 0.3) !important;
        }

        /* Border top and bottom for the whole row */
        .table tbody tr td {
            border-top: 1px solid rgba(139, 92, 246, 0.3) !important;
            border-bottom: 1px solid rgba(139, 92, 246, 0.3) !important;
        }

        .table tbody tr:hover {
            transform: translateY(-3px) scale(1.01);
            border-color: var(--accent-purple) !important;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        }

        .table tbody tr:hover td {
            border-color: var(--accent-purple) !important;
            color: #fff;
        }



        /* Forms */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: #fff;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-purple);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.5;
        }

        .form-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .form-text {
            color: var(--text-muted);
            font-size: 0.75rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        main {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-purple);
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4" style="width: 280px;">
            <div class="sidebar-brand mb-4">MultiStore <span style="font-weight: 300;">OS</span></div>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('tenants.index') }}"
                        class="nav-link {{ request()->routeIs('tenants.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Tenants
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.index') }}"
                        class="nav-link {{ request()->routeIs('admins.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Administradores
                    </a>
                </li>
            </ul>

            <div class="mt-auto">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Cerrar Sesión
                        </button>
                    </form>
                @endauth
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column min-vh-100">
            <nav class="navbar navbar-expand-lg d-flex justify-content-between">
                <h5 class="mb-0 fw-bold" style="color: var(--accent-blue)">@yield('header', 'Panel de Control')</h5>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="small fw-bold">{{ auth()->user()->name ?? 'Visitante' }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">Admin Central</div>
                    </div>
                    <div class="rounded-circle bg-gradient p-1" style="background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue))">
                        <div class="bg-dark rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </nav>

            <main class="p-4 flex-grow-1">
                @yield('content')
            </main>

            <footer class="py-3 px-4 border-top" style="border-color: var(--border-color) !important background: rgba(0,0,0,0.2)">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-muted small">&copy; {{ date('Y') }} MultiStore OS. Terminal v2.0.4</p>
                    <div class="d-flex gap-3">
                        <div class="px-2 py-1 rounded bg-success bg-opacity-10 text-success small" style="font-size: 0.7rem">● SYSTEM ONLINE</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // SweetAlert2 global triggers
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                background: '#0a0a0f',
                color: '#e2e8f0',
                confirmButtonColor: '#8b5cf6',
                customClass: {
                    popup: 'border border-primary'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                background: '#0a0a0f',
                color: '#e2e8f0',
                confirmButtonColor: '#ef4444'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                html: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#0a0a0f',
                color: '#e2e8f0',
                confirmButtonColor: '#f59e0b'
            });
        @endif
    </script>
</body>

</html>
@extends('tenant.layout')

@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 border-0 shadow-lg" style="background: rgba(15, 15, 25, 0.8); backdrop-filter: blur(20px);">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold text-white mb-2">Protocolo de Acceso</h2>
                            <p class="text-muted small text-uppercase letter-spacing-2">Terminal Operativo: {{ tenant('name') }}</p>
                        </div>

                        <form action="{{ route('tenant.login.submit') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">IDENTIDAD (EMAIL)</label>
                                <input type="email" name="email" class="form-control border-secondary border-opacity-25 bg-dark text-white p-3" 
                                    placeholder="admin@tienda.io" required autofocus>
                            </div>

                            <div class="mb-5">
                                <label class="form-label text-muted small fw-bold">CLAVE DE ACCESO</label>
                                <input type="password" name="password" class="form-control border-secondary border-opacity-25 bg-dark text-white p-3" 
                                    placeholder="••••••••" required>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary p-3 fw-bold text-uppercase" style="letter-spacing: 1px;">
                                    Inicializar Sesión
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('tenant.home') }}" class="text-muted small text-decoration-none hover-white">← Volver al Escala de Inicio</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-white:hover {
            color: #fff !important;
        }
        .form-control:focus {
            background-color: rgba(255,255,255,0.05);
            border-color: var(--accent-purple);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.2);
        }
    </style>
@endsection
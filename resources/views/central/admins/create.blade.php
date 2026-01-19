@extends('central.layout')

@section('header', 'Nuevo Administrador')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-5">
                <div class="mb-4">
                    <h4 class="fw-bold text-white mb-1">Nueva Identidad</h4>
                    <p class="text-muted">Registra un nuevo operador en el sistema central</p>
                </div>

                <form action="{{ route('admins.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre del Operador</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" placeholder="ej: John Doe" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Correo de Acceso</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" placeholder="admin@multistore.io" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Clave de Seguridad</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="••••••••" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar Clave</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="••••••••" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-10">
                        <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Registrar Operador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
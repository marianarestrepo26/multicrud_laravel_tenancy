@extends('central.layout')

@section('header', 'Editar Administrador')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-5">
                <div class="mb-4">
                    <h4 class="fw-bold text-white mb-1">Modificar Identidad</h4>
                    <p class="text-muted">Actualizando credenciales del operador central</p>
                </div>

                <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre del Operador</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name', $admin->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Correo de Acceso</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $admin->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="p-4 bg-dark bg-opacity-25 rounded-3 border border-secondary border-opacity-10 mb-4">
                        <h6 class="text-white mb-3 fw-bold small">SEGURIDAD ADICIONAL</h6>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Clave (Opcional)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" placeholder="Dejar vacío para no cambiar">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-0">
                            <label for="password_confirmation" class="form-label">Confirmar Nueva Clave</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-10">
                        <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">Volver</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Sincronizar Operador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
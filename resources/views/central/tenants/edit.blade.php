@extends('central.layout')

@section('header', 'Editar Tienda')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-5">
                <div class="mb-4">
                    <h4 class="fw-bold text-white mb-1">Configuración de Instancia</h4>
                    <p class="text-muted text-uppercase small letter-spacing-1">ID Central: <span class="text-info">{{ $tenant->id }}</span></p>
                </div>

                <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre Comercial</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name', $tenant->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="type" class="form-label">Protocolo de Inventario</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="cocina" {{ $tenant->type == 'cocina' ? 'selected' : '' }}>Alimentos & Cocina</option>
                            <option value="ferreteria" {{ $tenant->type == 'ferreteria' ? 'selected' : '' }}>Construcción & Herramientas</option>
                            <option value="joyeria" {{ $tenant->type == 'joyeria' ? 'selected' : '' }}>Lujo & Accesorios</option>
                            <option value="gamer" {{ $tenant->type == 'gamer' ? 'selected' : '' }}>Gaming & Entretenimiento</option>
                            <option value="papeleria" {{ $tenant->type == 'papeleria' ? 'selected' : '' }}>Oficina & Útiles</option>
                            <option value="otro" {{ $tenant->type == 'otro' ? 'selected' : '' }}>Misceláneos</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch p-3 bg-dark bg-opacity-25 rounded-3 border border-secondary border-opacity-10">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="status" name="status" value="1" {{ $tenant->status ? 'checked' : '' }}>
                            <label class="form-check-label text-white fw-bold" for="status">ESTADO OPERATIVO</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-10">
                        <a href="{{ route('tenants.index') }}" class="btn btn-outline-secondary">Volver</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Sincronizar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
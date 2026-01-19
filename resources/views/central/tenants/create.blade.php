@extends('central.layout')

@section('header', 'Nueva Tienda')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-5">
                <div class="mb-4">
                    <h4 class="fw-bold text-white mb-1">Módulo de Despliegue</h4>
                    <p class="text-muted">Configura una nueva instancia de tienda en el núcleo</p>
                </div>

                <form action="{{ route('tenants.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="id" class="form-label">Identificador de Sistema</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id"
                            value="{{ old('id') }}" placeholder="ej: store-alpha" required>
                        <div class="form-text">ID único que identifica la base de datos y recursos.</div>
                        @error('id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre Comercial</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" placeholder="ej: Tech Solutions S.A." required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="domain" class="form-label">Dirección de Red (Dominio)</label>
                        <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain"
                            name="domain" value="{{ old('domain') }}" placeholder="store.localhost" required>
                        <div class="form-text">El punto de entrada principal para el cliente.</div>
                        @error('domain') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5">
                        <label for="type" class="form-label">Protocolo de Inventario</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="" disabled selected>Seleccione categoría...</option>
                            <option value="cocina">Alimentos & Cocina</option>
                            <option value="ferreteria">Construcción & Herramientas</option>
                            <option value="joyeria">Lujo & Accesorios</option>
                            <option value="gamer">Gaming & Entretenimiento</option>
                            <option value="papeleria">Oficina & Útiles</option>
                            <option value="otro">Misceláneos</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-10">
                        <a href="{{ route('tenants.index') }}" class="btn btn-outline-secondary">Abortar</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Inicializar Tienda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
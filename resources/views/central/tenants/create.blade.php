@extends('central.layout')

@section('header', 'Nueva Tienda')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h5 class="fw-bold mb-4">Registrar Nuevo Tenant</h5>

                <form action="{{ route('tenants.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id" class="form-label">ID del Tenant (Único)</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id"
                            value="{{ old('id') }}" placeholder="ej: cocina" required>
                        <div class="form-text">Identificador interno único (sin espacios).</div>
                        @error('id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Negocio</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" placeholder="ej: Tienda de Cocina" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="domain" class="form-label">Dominio / Subdominio</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain"
                                name="domain" value="{{ old('domain') }}" placeholder="cocina.localhost" required>
                        </div>
                        @error('domain') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de Negocio</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="" disabled selected>Selecciona un tipo...</option>
                            <option value="cocina">Productos de Cocina</option>
                            <option value="ferreteria">Ferretería</option>
                            <option value="joyeria">Joyería</option>
                            <option value="gamer">Productos Gamer</option>
                            <option value="papeleria">Papelería</option>
                            <option value="otro">Otro</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('tenants.index') }}" class="btn btn-light">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Crear Tienda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
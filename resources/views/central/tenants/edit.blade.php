@extends('central.layout')

@section('header', 'Editar Tienda')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h5 class="fw-bold mb-4">Editar Tenant: {{ $tenant->id }}</h5>

                <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">ID del Tenant</label>
                        <input type="text" class="form-control" value="{{ $tenant->id }}" disabled readonly>
                        <div class="form-text">El ID no se puede cambiar.</div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Negocio</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name', $tenant->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de Negocio</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="cocina" {{ $tenant->type == 'cocina' ? 'selected' : '' }}>Productos de Cocina
                            </option>
                            <option value="ferreteria" {{ $tenant->type == 'ferreteria' ? 'selected' : '' }}>Ferretería
                            </option>
                            <option value="joyeria" {{ $tenant->type == 'joyeria' ? 'selected' : '' }}>Joyería</option>
                            <option value="gamer" {{ $tenant->type == 'gamer' ? 'selected' : '' }}>Productos Gamer</option>
                            <option value="papeleria" {{ $tenant->type == 'papeleria' ? 'selected' : '' }}>Papelería</option>
                            <option value="otro" {{ $tenant->type == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $tenant->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Tienda Activa</label>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('tenants.index') }}" class="btn btn-light">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('central.layout')

@section('header', 'Gestión de Tenants (Tiendas)')

@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Lista de Tiendas</h5>
                <p class="text-muted small mb-0">Gestiona los inquilinos de tu plataforma</p>
            </div>
            <a href="{{ route('tenants.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z" />
                </svg>
                Nueva Tienda
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dominio</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tenants as $tenant)
                        <tr>
                            <td><code>{{ $tenant->id }}</code></td>
                            <td class="fw-medium">{{ $tenant->name ?? 'Sin nombre' }}</td>
                            <td>
                                @foreach($tenant->domains as $domain)
                                    <a href="http://{{ $domain->domain }}" target="_blank"
                                        class="badge bg-light text-dark text-decoration-none border">
                                        {{ $domain->domain }} ↗
                                    </a>
                                @endforeach
                            </td>
                            <td><span class="badge bg-secondary">{{ ucfirst($tenant->type) }}</span></td>
                            <td>
                                @if($tenant->status)
                                    <span class="badge bg-success bg-opacity-10 text-success">Activo</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('tenants.admins.index', $tenant->id) }}"
                                        class="btn btn-sm btn-outline-info" title="Gestionar Usuarios">
                                        👥 Admins
                                    </a>
                                    <a href="{{ route('tenants.edit', $tenant->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta tienda?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No hay tiendas registradas aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
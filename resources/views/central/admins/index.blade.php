@extends('central.layout')

@section('header', 'Gestión de Administradores')

@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Administradores Centrales</h5>
                <p class="text-muted small mb-0">Usuarios con acceso al panel central</p>
            </div>
            <a href="{{ route('admins.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>
                Nuevo Admin
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fecha Registro</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold"
                                        style="width: 32px; height: 32px;">
                                        {{ substr($admin->name, 0, 1) }}
                                    </div>
                                    {{ $admin->name }}
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admins.edit', $admin->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No hay administradores registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
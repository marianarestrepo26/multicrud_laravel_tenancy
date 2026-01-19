@extends('central.layout')

@section('header', 'Gestión de Tenants (Tiendas)')

@section('content')
    <div class="card p-4 border-0 shadow-none bg-transparent">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-white">Nodos Activos</h4>
                <p class="text-muted small mb-0">Monitoreo y gestión de instancias del ecosistema</p>
            </div>
            <a href="{{ route('tenants.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Nueva Tienda
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">Identificador</th>
                        <th scope="col">Nombre Comercial</th>
                        <th scope="col">Dirección Red</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end pe-4">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tenants as $tenant)
                        <tr class="tenant-row">
                            <td class="ps-4">
                                <span class="badge bg-dark border border-info border-opacity-25 text-info px-3 py-2">
                                    {{ $tenant->id }}
                                </span>
                            </td>
                            <td class="fw-bold text-white">{{ $tenant->name ?? 'Sin asignar' }}</td>
                            <td>
                                @foreach($tenant->domains as $domain)
                                    <a href="http://{{ $domain->domain }}" target="_blank"
                                        class="text-accent-blue text-decoration-none small d-flex align-items-center gap-1">
                                        {{ $domain->domain }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <span class="small text-muted border border-secondary border-opacity-25 rounded-pill px-3 py-1">
                                    {{ strtoupper($tenant->type) }}
                                </span>
                            </td>
                            <td>
                                @if($tenant->status)
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="pulse-green"></div>
                                        <span class="text-success small fw-bold">ONLINE</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-danger rounded-circle" style="width: 8px; height: 8px"></div>
                                        <span class="text-danger small fw-bold">OFFLINE</span>
                                    </div>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group gap-2">
                                    <a href="{{ route('tenants.admins.index', $tenant->id) }}"
                                        class="btn btn-sm btn-outline-info rounded-pill px-3" title="Gestionar Usuarios">
                                        Usuarios
                                    </a>
                                    <a href="{{ route('tenants.edit', $tenant->id) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-circle p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-2 btn-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">No hay registros en la base de datos central.</div>
                                <a href="{{ route('tenants.create') }}" class="btn btn-sm btn-primary mt-3">Iniciar Primer Despliegue</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .tenant-row {
            transition: all 0.3s;
        }
        .text-accent-blue {
            color: var(--accent-blue);
        }
        .pulse-green {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: '¿Confirmar Desmantelamiento?',
                    text: "Todos los recursos y datos asociados a este nodo serán eliminados permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#4b5563',
                    confirmButtonText: 'ELIMINAR NODO',
                    cancelButtonText: 'CANCELAR',
                    background: '#0a0a0f',
                    color: '#e2e8f0'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
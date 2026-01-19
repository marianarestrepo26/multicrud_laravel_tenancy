@extends('tenant.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white">Consola de Inventario</h2>
                <p class="text-muted text-uppercase small letter-spacing-2">Gestión de Cargas y Suministros</p>
            </div>
            <a href="{{ route('tenant.admin.products.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Registrar Suministro
            </a>
        </div>

        <div class="card border-0" style="background: rgba(15, 15, 25, 0.4); backdrop-filter: blur(10px);">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-white">
                        <thead style="background: rgba(255,255,255,0.03);">
                            <tr>
                                <th scope="col" class="ps-4 border-secondary border-opacity-10 py-3 text-muted small text-uppercase">Producto</th>
                                <th scope="col" class="border-secondary border-opacity-10 py-3 text-muted small text-uppercase">Costo Unid.</th>
                                <th scope="col" class="border-secondary border-opacity-10 py-3 text-muted small text-uppercase">Bitácora</th>
                                <th scope="col" class="text-end pe-4 border-secondary border-opacity-10 py-3 text-muted small text-uppercase">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($products as $product)
                                <tr class="border-secondary border-opacity-10">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($product->image)
                                                <div class="p-1 rounded bg-gradient" style="background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue))">
                                                    <img src="{{ Storage::url($product->image) }}" class="rounded" width="50"
                                                        height="50" style="object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="rounded bg-dark border border-secondary border-opacity-25 d-flex align-items-center justify-content-center text-muted"
                                                    style="width: 58px; height: 58px; font-size: 0.7rem">
                                                    NO_DATA
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold">{{ $product->name }}</div>
                                                <div class="text-muted small">REF-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-info fw-bold">${{ number_format($product->price, 2) }}</span>
                                    </td>
                                    <td class="text-muted small py-3" style="max-width: 300px;">
                                        {{ Str::limit($product->description, 60) ?: 'Sin descripción técnica registrada.' }}
                                    </td>
                                    <td class="text-end pe-4 py-3">
                                        <div class="btn-group gap-2">
                                            <a href="{{ route('tenant.admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-outline-info rounded-pill px-3">
                                                Editar
                                            </a>
                                            <form action="{{ route('tenant.admin.products.destroy', $product->id) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <div class="mb-3">📡</div>
                                        No se han detectado productos en este sector.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: '¿Confirmar Descarte?',
                    text: "El producto será removido permanentemente del inventario.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#4b5563',
                    confirmButtonText: 'ELIMINAR',
                    cancelButtonText: 'CANCELAR',
                    background: '#0a0a0f',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
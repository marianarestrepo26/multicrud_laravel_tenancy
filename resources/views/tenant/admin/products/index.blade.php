@extends('tenant.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Inventario de Productos</h2>
                <p class="text-muted">Gestiona el catálogo de tu tienda</p>
            </div>
            <a href="{{ route('tenant.admin.products.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z" />
                </svg>
                Nuevo Producto
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="ps-4">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col" class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($product->image)
                                                <img src="{{ Storage::url($product->image) }}" class="rounded" width="48"
                                                    height="48" style="object-fit: cover;">
                                            @else
                                                <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted small"
                                                    style="width: 48px; height: 48px;">
                                                    Img
                                                </div>
                                            @endif
                                            <span class="fw-medium">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-success">${{ number_format($product->price, 2) }}</td>
                                    <td class="text-muted small" style="max-width: 300px;">
                                        {{ Str::limit($product->description, 50) }}</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('tenant.admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-outline-secondary">Editar</a>
                                            <form action="{{ route('tenant.admin.products.destroy', $product->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('¿Eliminar producto?');">
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
                                        No hay productos en el inventario.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
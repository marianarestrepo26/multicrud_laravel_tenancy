@extends('tenant.layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Agregar Nuevo Producto</h4>

                        <form action="{{ route('tenant.admin.products.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Precio ($)</label>
                                <input type="number" step="0.01" class="form-control" name="price" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Imagen del Producto</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <div class="form-text">Formatos: JPG, PNG. Máx 2MB.</div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('tenant.admin.products.index') }}" class="btn btn-light">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
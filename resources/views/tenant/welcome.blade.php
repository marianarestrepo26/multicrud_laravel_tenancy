@extends('tenant.layout')

@section('content')
    <div class="hero mb-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Bienvenido a {{ tenant('name') }}</h1>
            <p class="lead">Explora nuestro catálogo de productos exclusivos</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($products as $product)
                <div class="col">
                    <div class="card h-100 product-card">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="card-img-top product-img"
                                alt="{{ $product->name }}">
                        @else
                            <div
                                class="card-img-top product-img bg-light d-flex align-items-center justify-content-center text-muted">
                                Sin Imagen
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                            <h4 class="text-primary fw-bold mt-3">${{ number_format($product->price, 2) }}</h4>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <button class="btn btn-outline-primary w-100">Ver Detalles</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3>No hay productos disponibles por ahora.</h3>
                    <p>Vuelve pronto para ver nuestras novedades.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
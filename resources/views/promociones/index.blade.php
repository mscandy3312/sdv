@extends('layouts.app')

@section('title', 'Promociones')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary">
            <i class='bx bx-gift'></i> Promociones Especiales
        </h1>
    </div>

    <div class="row">
        @foreach($promociones as $promo)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm hover-card">
                <img src="{{ $promo['imagen'] }}" class="card-img-top" alt="{{ $promo['nombre'] }}">
                <div class="card-body">
                    <div class="badge bg-danger mb-2">-{{ $promo['descuento'] }}% OFF</div>
                    <h5 class="card-title">{{ $promo['nombre'] }}</h5>
                    <p class="card-text text-muted">{{ $promo['descripcion'] }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-decoration-line-through text-muted">${{ number_format($promo['precio_original'], 2) }}</span>
                            <h4 class="text-primary mb-0">${{ number_format($promo['precio_descuento'], 2) }}</h4>
                        </div>
                        <button class="btn btn-primary">Ver Detalles</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.badge {
    font-size: 1rem;
    padding: 0.5rem 1rem;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
@endsection 
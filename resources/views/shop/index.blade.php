@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar de categorías -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Categorías</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($categorias as $categoria)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $categoria->nombre }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid de productos -->
        <div class="col-md-9">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($productos as $producto)
                <div class="col">
                    <div class="card h-100 product-card">
                        <div class="position-relative">
                            @if($producto->image)
                                <img src="{{ Storage::url($producto->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $producto->nombre }}">
                            @else
                                <img src="https://via.placeholder.com/300" 
                                     class="card-img-top" 
                                     alt="Placeholder">
                            @endif
                            @if($producto->stock < 5)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-warning">¡Últimas unidades!</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($producto->descripcion, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-primary mb-0">${{ number_format($producto->precio, 2) }}</h4>
                                <form action="{{ route('shop.addToCart', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-cart-add"></i> Agregar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</div>

<style>
.product-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.product-card:hover {
    transform: translateY(-5px);
    border-color: var(--light-blue);
    box-shadow: 0 5px 15px rgba(37, 99, 235, 0.1);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    background-color: var(--pale-blue);
}

.list-group-item {
    border: none;
    padding: 0.75rem 1.25rem;
    transition: all 0.3s ease;
    color: var(--dark-blue);
}

.list-group-item:hover {
    background-color: var(--pale-blue);
    color: var(--primary-blue);
    transform: translateX(5px);
}

.badge.bg-warning {
    background-color: var(--light-blue) !important;
    color: white;
}

.text-primary {
    color: var(--primary-blue) !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--dark-blue), var(--hover-blue));
    transform: translateY(-2px);
}

.card-header {
    background-color: var(--pale-blue);
    border-bottom: 1px solid var(--light-blue);
}
</style>
@endsection 
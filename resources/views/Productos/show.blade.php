<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Detalles del Producto</h1>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back'></i> Volver
            </a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        @if($producto->image)
                            <img src="{{ Storage::url($producto->image) }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="img-fluid rounded mb-3"
                                 style="max-height: 300px; width: auto;">
                        @else
                            <img src="https://via.placeholder.com/300" 
                                 alt="Sin imagen" 
                                 class="img-fluid rounded mb-3">
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title border-bottom pb-2">Información del Producto</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Código:</strong> {{ $producto->code }}</p>
                                <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                                <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                                <p>
                                    <strong>Stock:</strong> 
                                    <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $producto->stock }}
                                    </span>
                                </p>
                                <p><strong>Stock Mínimo:</strong> {{ $producto->stock_minimo }}</p>
                            </div>
                        </div>

                        <h5 class="border-bottom pb-2">Descripción</h5>
                        <p class="card-text">{{ $producto->descripcion ?: 'Sin descripción' }}</p>

                        <div class="mt-4">
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-info me-2">
                                <i class='bx bx-edit-alt'></i> Editar
                            </a>
                            <form action="{{ route('productos.destroy', $producto) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Está seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class='bx bx-trash'></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    }

    .img-fluid {
        object-fit: contain;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    }

    .badge {
        padding: 0.5em 1em;
        font-size: 0.85em;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }

    .card-title {
        color: #2196F3;
        font-weight: 600;
    }

    strong {
        color: #555;
    }
    </style>
</x-app-layout> 
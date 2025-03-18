@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Gestión de Productos</h1>
            <p class="text-muted">Administra tu inventario de productos</p>
        </div>
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-2"></i>Exportar
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('productos.exportar', ['formato' => 'pdf']) }}">
                            <i class="fas fa-file-pdf me-2 text-danger"></i>PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('productos.exportar', ['formato' => 'excel']) }}">
                            <i class="fas fa-file-excel me-2 text-success"></i>Excel
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('productos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Nuevo Producto
            </a>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('productos.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Categoría</label>
                    <select name="categoria" class="form-select">
                        <option value="">Todas</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado Stock</label>
                    <select name="stock" class="form-select">
                        <option value="">Todos</option>
                        <option value="bajo" {{ request('stock') == 'bajo' ? 'selected' : '' }}>Stock Bajo</option>
                        <option value="normal" {{ request('stock') == 'normal' ? 'selected' : '' }}>Stock Normal</option>
                        <option value="alto" {{ request('stock') == 'alto' ? 'selected' : '' }}>Stock Alto</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Buscar</label>
                    <input type="text" name="search" class="form-control" placeholder="Nombre o código..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="d-flex gap-2 w-100">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filtrar
                        </button>
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Alertas -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Tabla de Productos -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $producto->code }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-icon me-2">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $producto->name }}</div>
                                        <div class="small text-muted">{{ Str::limit($producto->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($producto->categoria)
                                    {{ $producto->categoria->name }}
                                @else
                                    <span class="text-muted">Sin categoría</span>
                                @endif
                            </td>
                            <td>
                                <span class="product-price">${{ number_format($producto->price, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $producto->stock > 10 ? 'success' : 'danger' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $producto->status ? 'success' : 'danger' }}">
                                    {{ $producto->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('productos.show', $producto) }}" 
                                       class="btn btn-sm btn-info"
                                       data-bs-toggle="tooltip" 
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('productos.edit', $producto) }}" 
                                       class="btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmarEliminacion('{{ route('productos.destroy', $producto) }}')"
                                            data-bs-toggle="tooltip" 
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-box fa-3x mb-3"></i>
                                    <p class="text-muted">No hay productos registrados</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Mostrando {{ $productos->firstItem() ?? 0 }} - {{ $productos->lastItem() ?? 0 }}
                    de {{ $productos->total() }} productos
                </div>
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(145deg, var(--primary-blue), var(--dark-blue));
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-price {
        font-weight: 600;
        color: var(--primary-blue);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-buttons .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
    }

    .empty-state {
        color: var(--primary-blue);
        opacity: 0.5;
    }
</style>
@endpush

@push('scripts')
<script>
// Inicializar tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

function confirmarEliminacion(url) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                window.location.reload();
            }
        });
    }
}
</script>
@endpush

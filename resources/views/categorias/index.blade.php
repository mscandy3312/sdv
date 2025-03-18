@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Gestión de Categorías</h1>
            <p class="text-muted">Administra las categorías de tus productos</p>
        </div>
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-2"></i>Exportar
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('categorias.exportar', ['formato' => 'pdf']) }}">
                            <i class="fas fa-file-pdf me-2 text-danger"></i>PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('categorias.exportar', ['formato' => 'excel']) }}">
                            <i class="fas fa-file-excel me-2 text-success"></i>Excel
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Nueva Categoría
            </a>
        </div>
    </div>

    <!-- Alertas -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Grid de Categorías -->
    <div class="row g-4">
        @forelse($categorias as $categoria)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="category-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-dark" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('categorias.edit', $categoria) }}">
                                        <i class="fas fa-edit me-2 text-primary"></i>Editar
                                    </a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" 
                                            onclick="confirmarEliminacion('{{ route('categorias.destroy', $categoria) }}')">
                                        <i class="fas fa-trash me-2"></i>Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h5 class="card-title mb-2">{{ $categoria->name }}</h5>
                    <p class="card-text text-muted mb-3">
                        {{ Str::limit($categoria->description ?? 'Sin descripción', 100) }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="category-count">
                            <i class="fas fa-box me-2"></i>{{ $categoria->productos_count }} productos
                        </span>
                        <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-outline-primary">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-tags fa-3x mb-3"></i>
                        <h6 class="text-muted">No hay categorías registradas</h6>
                        <p class="text-muted">Comienza creando una nueva categoría</p>
                        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Nueva Categoría
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Mostrando {{ $categorias->firstItem() ?? 0 }} - {{ $categorias->lastItem() ?? 0 }}
            de {{ $categorias->total() }} categorías
        </div>
        {{ $categorias->links() }}
    </div>
</div>

@push('styles')
<style>
    .category-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(145deg, var(--primary-blue), var(--dark-blue));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .category-count {
        background: var(--pale-blue);
        color: var(--primary-blue);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .empty-state {
        color: var(--primary-blue);
        opacity: 0.5;
    }

    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.1);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
    }

    .dropdown-item:hover {
        background-color: var(--pale-blue);
    }
</style>
@endpush

@push('scripts')
<script>
function confirmarEliminacion(url) {
    if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
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
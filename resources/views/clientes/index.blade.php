@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Gestión de Clientes</h1>
            <p class="text-muted">Administra tu cartera de clientes</p>
        </div>
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-2"></i>Exportar
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('clientes.exportar', ['formato' => 'pdf']) }}">
                            <i class="fas fa-file-pdf me-2 text-danger"></i>PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('clientes.exportar', ['formato' => 'excel']) }}">
                            <i class="fas fa-file-excel me-2 text-success"></i>Excel
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Nuevo Cliente
            </a>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('clientes.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Buscar</label>
                    <input type="text" name="search" class="form-control" placeholder="Nombre, email o teléfono..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="">Todos</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ordenar por</label>
                    <select name="sort" class="form-select">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Más recientes</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                        <option value="purchases" {{ request('sort') == 'purchases' ? 'selected' : '' }}>Compras</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="d-flex gap-2 w-100">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filtrar
                        </button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
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

    <!-- Lista de Clientes -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Contacto</th>
                            <th>Compras</th>
                            <th>Última Compra</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="client-avatar me-3">
                                        {{ strtoupper(substr($cliente->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $cliente->name }}</div>
                                        <div class="small text-muted">ID: {{ $cliente->id }}</div>
                                        <div class="small text-muted">{{ $cliente->email }}</div>
                                        <div class="small text-muted">{{ $cliente->phone }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $totalCompras = $cliente->ventas->sum('total');
                                    $cantidadCompras = $cliente->ventas->count();
                                    $ultimaCompra = $cliente->ventas->sortByDesc('created_at')->first();
                                @endphp
                                <div class="fw-bold">${{ number_format($totalCompras, 2) }}</div>
                                <div class="small text-muted">
                                    {{ $cantidadCompras }} {{ Str::plural('compra', $cantidadCompras) }}
                                </div>
                            </td>
                            <td>
                                @if($ultimaCompra)
                                    {{ $ultimaCompra->created_at->format('d/m/Y') }}
                                    <div class="small text-muted">{{ $ultimaCompra->created_at->diffForHumans() }}</div>
                                @else
                                    <span class="text-muted">Sin compras</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $cliente->status ? 'success' : 'danger' }}">
                                    {{ $cliente->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('clientes.show', $cliente) }}" 
                                       class="btn btn-sm btn-info"
                                       data-bs-toggle="tooltip" 
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente) }}" 
                                       class="btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmarEliminacion('{{ route('clientes.destroy', $cliente) }}')"
                                            data-bs-toggle="tooltip" 
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-users fa-3x mb-3"></i>
                                    <h6 class="text-muted">No hay clientes registrados</h6>
                                    <p class="text-muted">Comienza agregando un nuevo cliente</p>
                                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle me-2"></i>Nuevo Cliente
                                    </a>
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
                    Mostrando {{ $clientes->firstItem() ?? 0 }} - {{ $clientes->lastItem() ?? 0 }}
                    de {{ $clientes->total() }} clientes
                </div>
                {{ $clientes->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .client-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(145deg, var(--primary-blue), var(--dark-blue));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
    }

    .purchase-count {
        background: var(--pale-blue);
        color: var(--primary-blue);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
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
    if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
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
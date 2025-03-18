@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header con estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Ventas</h6>
                            <h3 class="mb-0">${{ number_format($ventas->sum('total'), 2) }}</h3>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Ventas Completadas</h6>
                            <h3 class="mb-0">{{ $ventas->where('status', 'PAID')->count() }}</h3>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Ventas Pendientes</h6>
                            <h3 class="mb-0">{{ $ventas->where('status', 'PENDING')->count() }}</h3>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Promedio Venta</h6>
                            <h3 class="mb-0">${{ number_format($ventas->avg('total'), 2) }}</h3>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header con título y botones -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Gestión de Ventas</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ventas</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-2"></i>Exportar
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('ventas.exportar', ['formato' => 'csv']) }}">
                                    <i class="fas fa-file-csv me-2 text-info"></i>CSV
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ventas.exportar', ['formato' => 'txt']) }}">
                                    <i class="fas fa-file-alt me-2 text-secondary"></i>Texto plano
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('ventas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Nueva Venta
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros mejorados -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('ventas.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="date" name="fecha_inicio" class="form-control" id="fechaInicio" value="{{ request('fecha_inicio') }}">
                        <label for="fechaInicio">Fecha Inicio</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="date" name="fecha_fin" class="form-control" id="fechaFin" value="{{ request('fecha_fin') }}">
                        <label for="fechaFin">Fecha Fin</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select name="estado" class="form-select" id="estado">
                            <option value="">Todos</option>
                            <option value="PAID" {{ request('estado') == 'PAID' ? 'selected' : '' }}>Pagada</option>
                            <option value="PENDING" {{ request('estado') == 'PENDING' ? 'selected' : '' }}>Pendiente</option>
                        </select>
                        <label for="estado">Estado</label>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="d-flex gap-2 w-100">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filtrar
                        </button>
                        <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">
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

    <!-- Tabla con diseño mejorado -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventas as $venta)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $venta->code }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary text-white me-2">
                                        {{ strtoupper(substr($venta->client->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $venta->client->name }}</div>
                                        <div class="small text-muted">{{ $venta->client->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">${{ number_format($venta->total, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $venta->status == 'PAID' ? 'success' : 'warning' }} rounded-pill">
                                    {{ $venta->status == 'PAID' ? 'Pagada' : 'Pendiente' }}
                                </span>
                            </td>
                            <td>
                                <div>{{ $venta->created_at->format('d/m/Y') }}</div>
                                <div class="small text-muted">{{ $venta->created_at->format('H:i A') }}</div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('ventas.show', $venta) }}" 
                                       class="btn btn-sm btn-info" 
                                       data-bs-toggle="tooltip" 
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('ventas.pdf', $venta) }}" 
                                       class="btn btn-sm btn-secondary"
                                       data-bs-toggle="tooltip" 
                                       title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmarEliminacion('{{ route('ventas.destroy', $venta) }}')"
                                            data-bs-toggle="tooltip" 
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                    <p>No hay ventas registradas</p>
                                    <a href="{{ route('ventas.create') }}" class="btn btn-sm btn-primary">
                                        Crear primera venta
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación mejorada -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Mostrando {{ $ventas->firstItem() ?? 0 }} - {{ $ventas->lastItem() ?? 0 }}
                    de {{ $ventas->total() }} ventas
                </div>
                {{ $ventas->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .badge {
        padding: 0.5em 0.8em;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
        border-radius: 0.5rem;
    }

    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
    }

    .form-floating > .form-control {
        padding: 1rem 0.75rem;
    }

    .btn-group > .btn {
        padding: 0.375rem 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});

function confirmarEliminacion(url) {
    if (confirm('¿Estás seguro de que deseas eliminar esta venta?')) {
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

@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Dashboard</h4>
                    <div class="text-muted">Bienvenido, {{ Auth::user()->name }}</div>
                </div>
                <div class="text-end">
                    <div class="fs-6 text-muted">{{ now()->format('l, d F Y') }}</div>
                    <div class="small">Última actualización: {{ now()->format('H:i A') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas Principales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Ventas Totales</h6>
                            <h3 class="mb-0">${{ number_format($ventasTotales, 2) }}</h3>
                            <div class="small">{{ $numeroVentas }} ventas realizadas</div>
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
                            <h6 class="card-title mb-0">Productos</h6>
                            <h3 class="mb-0">{{ $totalProductos }}</h3>
                            <div class="small">{{ $productosActivos }} activos</div>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-box"></i>
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
                            <h6 class="card-title mb-0">Clientes</h6>
                            <h3 class="mb-0">{{ $totalClientes }}</h3>
                            <div class="small">{{ $clientesNuevos }} nuevos este mes</div>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-users"></i>
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
                            <h6 class="card-title mb-0">Categorías</h6>
                            <h3 class="mb-0">{{ $totalCategorias }}</h3>
                            <div class="small">{{ $productosMinStock }} productos bajo stock</div>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Gráfico de Ventas -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Ventas Últimos 7 Días</h5>
                </div>
                <div class="card-body">
                    <canvas id="ventasChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Productos -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Top Productos Vendidos</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($topProductos as $producto)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $producto->name }}</h6>
                                    <small class="text-muted">{{ $producto->ventas_count }} ventas</small>
                                </div>
                                <span class="badge bg-success rounded-pill">
                                    ${{ number_format($producto->total_ventas, 2) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Últimas Ventas -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Últimas Ventas</h5>
                    <a href="{{ route('ventas.index') }}" class="btn btn-sm btn-primary">
                        Ver todas
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ultimasVentas as $venta)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white me-2">
                                                {{ strtoupper(substr($venta->client->name, 0, 1)) }}
                                            </div>
                                            {{ $venta->client->name }}
                                        </div>
                                    </td>
                                    <td>${{ number_format($venta->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $venta->status == 'PAID' ? 'success' : 'warning' }}">
                                            {{ $venta->status }}
                                        </span>
                                    </td>
                                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Bajo Stock -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Productos Bajo Stock</h5>
                    <a href="{{ route('productos.index') }}" class="btn btn-sm btn-primary">
                        Ver todos
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productosBajoStock as $producto)
                                <tr>
                                    <td>{{ $producto->name }}</td>
                                    <td>{{ $producto->categoria->name }}</td>
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ $producto->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $producto->status ? 'success' : 'danger' }}">
                                            {{ $producto->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.875rem;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }

    .badge {
        padding: 0.5em 0.8em;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('ventasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($ventasChart['labels']) !!},
            datasets: [{
                label: 'Ventas',
                data: {!! json_encode($ventasChart['data']) !!},
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid fade-in">
    <!-- Estadísticas Principales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Ventas de Hoy</h6>
                            <h2 class="card-title mb-0">${{ number_format($stats['today_sales'], 2) }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-dollar text-primary' style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Ventas del Mes</h6>
                            <h2 class="card-title mb-0">${{ number_format($stats['month_sales'], 2) }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-calendar text-success' style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Productos</h6>
                            <h2 class="card-title mb-0">{{ number_format($stats['total_products']) }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-package text-info' style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Clientes</h6>
                            <h2 class="card-title mb-0">{{ number_format($stats['total_customers']) }}</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class='bx bx-group text-warning' style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráfico de Ventas -->
        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Tendencia de Ventas</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Productos con Bajo Stock -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Productos con Bajo Stock</h5>
                    <div class="alert alert-warning">
                        <i class='bx bx-error'></i>
                        {{ $stats['low_stock_products'] }} productos con stock bajo
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($stats['top_products'] as $product)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $product->name }}</h6>
                                <small class="text-muted">Vendidos: {{ $product->total_sold }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Ventas -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Últimas Ventas</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
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
                        @foreach($stats['recent_sales'] as $sale)
                        <tr>
                            <td>{{ $sale->code }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>${{ number_format($sale->total, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $sale->status == 'PAID' ? 'success' : ($sale->status == 'PENDING' ? 'warning' : 'danger') }}">
                                    {{ $sale->status }}
                                </span>
                            </td>
                            <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info">
                                    <i class='bx bx-show'></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    const salesData = @json($stats['sales_chart']);
    const labels = salesData.map(item => item.date);
    const data = salesData.map(item => item.total);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventas Diarias',
                data: data,
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection

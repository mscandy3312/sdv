@extends('layouts.app')

@section('title', 'Reporte de Ventas')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class='bx bx-cart'></i> Reporte de Ventas
        </h1>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
            <i class='bx bx-arrow-back'></i> Volver
        </a>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" 
                           value="{{ request('start_date', $startDate->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="end_date" name="end_date"
                           value="{{ request('end_date', $endDate->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-filter-alt'></i> Filtrar
                    </button>
                </div>
            </form>
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

        <!-- Resumen de Ventas -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Resumen del Período</h5>
                    @php
                        $totalSales = $sales->sum('total');
                        $totalOrders = $sales->count();
                        $avgOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
                    @endphp
                    <div class="mb-3">
                        <label class="fw-bold">Total Ventas:</label>
                        <h3 class="text-primary">${{ number_format($totalSales, 2) }}</h3>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Número de Órdenes:</label>
                        <h4>{{ $totalOrders }}</h4>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Valor Promedio por Orden:</label>
                        <h4>${{ number_format($avgOrderValue, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Ventas -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Detalle de Ventas</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->code }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ $sale->user->name }}</td>
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
    
    const dailySales = @json($dailySales);
    const labels = dailySales.map(sale => sale.date);
    const data = dailySales.map(sale => sale.total);

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

@extends('layouts.app')

@section('title', 'Reporte de Clientes')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class='bx bx-group'></i> Reporte de Clientes
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
        <!-- Gráfico de Clientes -->
        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Top 10 Clientes por Ventas</h5>
                    <canvas id="customersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Resumen de Clientes -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Resumen del Período</h5>
                    @php
                        $totalAmount = $topCustomers->sum('total_amount');
                        $totalSales = $topCustomers->sum('total_sales');
                        $avgPurchase = $totalSales > 0 ? $totalAmount / $totalSales : 0;
                    @endphp
                    <div class="mb-3">
                        <label class="fw-bold">Total en Ventas:</label>
                        <h3 class="text-primary">${{ number_format($totalAmount, 2) }}</h3>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Total de Ventas:</label>
                        <h4>{{ $totalSales }}</h4>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Promedio por Venta:</label>
                        <h4>${{ number_format($avgPurchase, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Clientes -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Detalle de Clientes</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Total Ventas</th>
                            <th>Monto Total</th>
                            <th>Promedio por Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topCustomers as $index => $customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->total_sales }}</td>
                            <td>${{ number_format($customer->total_amount, 2) }}</td>
                            <td>${{ number_format($customer->total_amount / $customer->total_sales, 2) }}</td>
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
    const ctx = document.getElementById('customersChart').getContext('2d');
    
    const customers = @json($topCustomers);
    const labels = customers.map(customer => customer.name);
    const amounts = customers.map(customer => customer.total_amount);
    const sales = customers.map(customer => customer.total_sales);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Monto Total ($)',
                    data: amounts,
                    backgroundColor: 'rgba(79, 70, 229, 0.6)',
                    yAxisID: 'y'
                },
                {
                    label: 'Número de Ventas',
                    data: sales,
                    backgroundColor: 'rgba(99, 102, 241, 0.6)',
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    type: 'linear',
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Monto Total ($)'
                    }
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Número de Ventas'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection

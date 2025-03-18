@extends('layouts.app')

@section('title', 'Panel de Reportes')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class='bx bx-line-chart'></i> Panel de Reportes
        </h1>
        <div class="btn-group">
            <button class="btn btn-outline-primary" onclick="exportToPDF()">
                <i class='bx bxs-file-pdf'></i> Exportar PDF
            </button>
            <button class="btn btn-outline-success" onclick="exportToExcel()">
                <i class='bx bxs-file-export'></i> Exportar Excel
            </button>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Ventas de Hoy</h6>
                            <h2 class="mb-0">${{ number_format($stats['today_sales'], 2) }}</h2>
                            <div class="trend up">
                                <i class='bx bx-up-arrow-alt'></i> +15% vs ayer
                            </div>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10">
                            <i class='bx bx-dollar text-primary'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Ventas del Mes</h6>
                            <h2 class="mb-0">${{ number_format($stats['month_sales'], 2) }}</h2>
                            <div class="trend up">
                                <i class='bx bx-up-arrow-alt'></i> +8% vs mes anterior
                            </div>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10">
                            <i class='bx bx-calendar text-success'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Productos</h6>
                            <h2 class="mb-0">{{ number_format($stats['total_products']) }}</h2>
                            <div class="trend down">
                                <i class='bx bx-down-arrow-alt'></i> -3% stock bajo
                            </div>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10">
                            <i class='bx bx-package text-warning'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Clientes</h6>
                            <h2 class="mb-0">{{ number_format($stats['total_customers']) }}</h2>
                            <div class="trend up">
                                <i class='bx bx-up-arrow-alt'></i> +5% nuevos
                            </div>
                        </div>
                        <div class="icon-box bg-info bg-opacity-10">
                            <i class='bx bx-group text-info'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <div class="col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">Ventas por Mes</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">Productos Más Vendidos</h5>
                </div>
                <div class="card-body">
                    <canvas id="productsChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos adicionales -->
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">Ventas por Categoría</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">Ventas por Hora</h5>
                </div>
                <div class="card-body">
                    <canvas id="hourlyChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    border: none;
    border-radius: 1rem;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.icon-box {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-box i {
    font-size: 24px;
}

.trend {
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
}

.trend.up {
    color: #4caf50;
}

.trend.down {
    color: #f44336;
}

.trend i {
    font-size: 1rem;
    margin-right: 0.25rem;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 1rem;
}

.card-header {
    padding: 1.25rem;
}

.card-title {
    color: #333;
    font-weight: 600;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos para los gráficos
    const ventasPorMes = {
        labels: {!! json_encode($ventasPorMes->pluck('mes')) !!},
        data: {!! json_encode($ventasPorMes->pluck('total')) !!}
    };

    const productosMasVendidos = {
        labels: {!! json_encode($productosMasVendidos->pluck('nombre')) !!},
        data: {!! json_encode($productosMasVendidos->pluck('total')) !!}
    };

    // Gráfico de Ventas por Mes
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ventasPorMes.labels,
            datasets: [{
                label: 'Ventas Mensuales',
                data: ventasPorMes.data,
                borderColor: '#2196F3',
                backgroundColor: 'rgba(33, 150, 243, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => '$' + value.toLocaleString()
                    }
                }
            }
        }
    });

    // Gráfico de Productos más Vendidos
    new Chart(document.getElementById('productsChart'), {
        type: 'doughnut',
        data: {
            labels: productosMasVendidos.labels,
            datasets: [{
                data: productosMasVendidos.data,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Gráfico de Ventas por Categoría (datos de ejemplo)
    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: ['Electrónicos', 'Ropa', 'Alimentos', 'Hogar', 'Otros'],
            datasets: [{
                label: 'Ventas por Categoría',
                data: [12000, 8000, 6000, 4500, 3000],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Gráfico de Ventas por Hora (datos de ejemplo)
    new Chart(document.getElementById('hourlyChart'), {
        type: 'line',
        data: {
            labels: ['8am', '10am', '12pm', '2pm', '4pm', '6pm', '8pm'],
            datasets: [{
                label: 'Ventas por Hora',
                data: [1500, 2500, 3800, 3000, 2800, 3200, 2000],
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});

// Funciones de exportación (a implementar)
function exportToPDF() {
    alert('Exportando a PDF...');
}

function exportToExcel() {
    alert('Exportando a Excel...');
}
</script>
@endpush
@endsection 
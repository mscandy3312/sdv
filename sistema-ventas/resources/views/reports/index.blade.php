@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class='bx bx-line-chart'></i> Panel de Reportes
        </h1>
    </div>

    <!-- Tarjetas de Estadísticas -->
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

    <!-- Enlaces a Reportes Específicos -->
    <div class="row">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class='bx bx-cart'></i> Reporte de Ventas
                    </h5>
                    <p class="card-text">Analiza el rendimiento de las ventas por período, incluyendo tendencias y totales.</p>
                    <a href="{{ route('reports.sales') }}" class="btn btn-primary">
                        Ver Reporte <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class='bx bx-package'></i> Reporte de Productos
                    </h5>
                    <p class="card-text">Visualiza los productos más vendidos y el estado del inventario.</p>
                    <a href="{{ route('reports.products') }}" class="btn btn-primary">
                        Ver Reporte <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class='bx bx-user'></i> Reporte de Clientes
                    </h5>
                    <p class="card-text">Analiza el comportamiento de los clientes y sus compras totales.</p>
                    <a href="{{ route('reports.customers') }}" class="btn btn-primary">
                        Ver Reporte <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

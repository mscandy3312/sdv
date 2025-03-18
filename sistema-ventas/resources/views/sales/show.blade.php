@extends('layouts.app')

@section('title', 'Detalle de Venta')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class='bx bx-receipt'></i> Detalle de Venta #{{ $sale->code }}
        </h1>
        <div>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary me-2">
                <i class='bx bx-arrow-back'></i> Volver
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class='bx bx-printer'></i> Imprimir
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class='bx bx-info-circle'></i> Información de la Venta
                    </h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Código:</strong></p>
                            <p class="text-light">{{ $sale->code }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Fecha:</strong></p>
                            <p class="text-light">{{ $sale->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Estado:</strong></p>
                            <span class="badge bg-{{ $sale->status == 'PAID' ? 'success' : ($sale->status == 'PENDING' ? 'warning' : 'danger') }}">
                                {{ $sale->status }}
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Vendedor:</strong></p>
                            <p class="text-light">{{ $sale->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class='bx bx-user'></i> Información del Cliente
                    </h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Nombre:</strong></p>
                            <p class="text-light">{{ $sale->customer->name }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>DNI:</strong></p>
                            <p class="text-light">{{ $sale->customer->dni }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p class="text-light">{{ $sale->customer->email }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Teléfono:</strong></p>
                            <p class="text-light">{{ $sale->customer->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <i class='bx bx-package'></i> Productos
            </h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->saleDetails as $detail)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($detail->product->image)
                                        <img src="{{ asset($detail->product->image) }}" 
                                             alt="{{ $detail->product->name }}" 
                                             class="me-2"
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $detail->product->name }}</div>
                                        <small class="text-muted">{{ $detail->product->code }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>${{ number_format($detail->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                            <td>${{ number_format($sale->total - $sale->tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>IGV (18%):</strong></td>
                            <td>${{ number_format($sale->tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td class="fw-bold">${{ number_format($sale->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
@media print {
    .navbar, .sidebar, .btn {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    body {
        background: white !important;
        color: black !important;
    }
    .table {
        color: black !important;
    }
}
</style>
@endpush
@endsection

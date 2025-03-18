@extends('layouts.app')

@section('content')
<x-app-layout>
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">Detalle de Venta #{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</h2>
        <div>
            <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
            <button type="button" 
                    class="btn btn-outline-primary"
                    onclick="window.open('{{ route('ventas.pdf', $venta) }}', '_blank')">
                <i class="fas fa-file-pdf me-2"></i>Generar PDF
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Productos</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($venta->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay detalles disponibles</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Información de la Venta</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Estado:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-{{ 
                                $venta->estado == 'completada' ? 'success' : 
                                ($venta->estado == 'pendiente' ? 'warning' : 'danger') 
                            }}">
                                {{ ucfirst($venta->estado) }}
                            </span>
                        </dd>

                        <dt class="col-sm-5">Cliente:</dt>
                        <dd class="col-sm-7">{{ $venta->cliente }}</dd>

                        <dt class="col-sm-5">Fecha:</dt>
                        <dd class="col-sm-7">{{ $venta->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-5">Método Pago:</dt>
                        <dd class="col-sm-7">{{ ucfirst($venta->metodo_pago) }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Resumen</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($venta->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>IVA (16%):</span>
                        <span>${{ number_format($venta->iva, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span>${{ number_format($venta->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection 
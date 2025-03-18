<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detalles del Cliente</h4>
                <a href="{{ route('clientes.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2">Información Personal</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nombre:</th>
                                <td>{{ $cliente->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $cliente->email }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono:</th>
                                <td>{{ $cliente->phone }}</td>
                            </tr>
                            <tr>
                                <th>Dirección:</th>
                                <td>{{ $cliente->address }}</td>
                            </tr>
                            <tr>
                                <th>Estado:</th>
                                <td>
                                    <span class="badge bg-{{ $cliente->status ? 'success' : 'danger' }}">
                                        {{ $cliente->status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2">Resumen de Compras</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="50%">Total de Compras:</th>
                                <td>${{ number_format($cliente->ventas->sum('total'), 2) }}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de Compras:</th>
                                <td>{{ $cliente->ventas->count() }}</td>
                            </tr>
                            <tr>
                                <th>Última Compra:</th>
                                <td>
                                    @if($ultimaCompra = $cliente->ventas->sortByDesc('created_at')->first())
                                        {{ $ultimaCompra->created_at->format('d/m/Y') }}
                                    @else
                                        Sin compras
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="border-bottom pb-2">Historial de Compras</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cliente->ventas->sortByDesc('created_at') as $venta)
                                <tr>
                                    <td>{{ $venta->code }}</td>
                                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                    <td>${{ number_format($venta->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ $venta->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('ventas.show', $venta) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay compras registradas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
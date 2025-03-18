<x-app-layout>
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detalles de la Categoría</h4>
                <a href="{{ route('categorias.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2">Información General</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nombre:</th>
                                <td>{{ $categoria->name }}</td>
                            </tr>
                            <tr>
                                <th>Descripción:</th>
                                <td>{{ $categoria->description ?? 'Sin descripción' }}</td>
                            </tr>
                            <tr>
                                <th>Productos:</th>
                                <td>{{ $categoria->productos->count() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="border-bottom pb-2">Productos en esta Categoría</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categoria->productos as $producto)
                                <tr>
                                    <td>{{ $producto->code }}</td>
                                    <td>{{ $producto->name }}</td>
                                    <td>${{ number_format($producto->price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $producto->stock > 10 ? 'success' : 'danger' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $producto->status ? 'success' : 'danger' }}">
                                            {{ $producto->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay productos en esta categoría</td>
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
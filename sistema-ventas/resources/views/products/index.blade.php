@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Productos</h2>
                        <a href="{{ route('products.create') }}" class="btn btn-light text-primary">Nuevo Producto</a>
                    </div>
                </div>

                <div class="card-body bg-light">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>Código</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="table-row">
                                        <td>{{ $product->code }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                                                     style="width: 50px; height: auto; border-radius: 5px;">
                                            @else
                                                <span class="text-muted">Sin imagen</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }} text-white">
                                                {{ $product->status ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                                    Eliminar
                                                </button>
                                            </form>
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
@endsection

@section('styles')
<style>
    .table-row:hover {
        background-color: #e9f7fc; /* Hover effect for rows */
        transition: background-color 0.3s ease;
    }

    .btn-light {
        background-color: #ffffff;
        color: #007bff;
    }

    .btn-light:hover {
        background-color: #f1f1f1;
        color: #0056b3;
    }

    .badge.bg-success {
        background-color: #28a745;
    }

    .badge.bg-danger {
        background-color: #dc3545;
    }

    .card-header {
        background: linear-gradient(135deg, #0066cc, #3399ff);
        border-radius: 8px 8px 0 0;
    }

    .card-body {
        background-color: #f0f8ff;
        border-radius: 0 0 8px 8px;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary bg-gradient text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">Proveedores</h2>
                    <a href="{{ route('proveedores.create') }}" class="btn btn-light">
                        <i class="fas fa-plus"></i> Nuevo Proveedor
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cumplimiento Legal</th>
                                    <th>Perfil General</th>
                                    <th>Precio</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proveedores as $proveedor)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $proveedor->name }}</td>
                                        <td>{{ Str::limit($proveedor->{'Legal Compliance'}, 50) }}</td>
                                        <td>{{ Str::limit($proveedor->{'General Supplier Profile'}, 50) }}</td>
                                        <td class="fw-bold">${{ number_format($proveedor->Price, 2) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('proveedores.edit', $proveedor) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('proveedores.destroy', $proveedor) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger ms-1"
                                                        onclick="return confirm('¿Está seguro de eliminar este proveedor?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $proveedores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card { border: none; border-radius: 10px; }
    .card-header { border-radius: 10px 10px 0 0 !important; }
    .table th { background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; }
    .btn-group .btn { border-radius: 5px !important; }
</style>
@endpush 
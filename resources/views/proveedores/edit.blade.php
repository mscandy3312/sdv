@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary bg-gradient text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">Editar Proveedor</h2>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body bg-light bg-gradient">
                    <form method="POST" action="{{ route('proveedores.update', $proveedor) }}" class="p-4 bg-white rounded shadow-sm">
                        @csrf
                        @method('PUT')
                        @include('proveedores.partials.form', ['buttonText' => 'Actualizar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .form-control {
        border: 1px solid #e0e0e0;
        padding: 0.75rem;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn-lg {
        padding: 0.75rem 1.5rem;
    }
</style>
@endpush 
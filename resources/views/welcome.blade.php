@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Sistema de Compras y Ventas</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="{{ route('productos.index') }}" class="btn btn-primary btn-lg btn-block">Gestión de Productos</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('categorias.index') }}" class="btn btn-success btn-lg btn-block">Gestión de Categorías</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('ventas.index') }}" class="btn btn-warning btn-lg btn-block">Gestión de Ventas</a>
        </div>
    </div>
</div>
@endsection

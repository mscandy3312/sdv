@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Configuración del Sistema</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <h5>Información de la Empresa</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="empresa_nombre" class="form-label">Nombre de la Empresa</label>
                                <input type="text" class="form-control" id="empresa_nombre" name="empresa_nombre"
                                    value="{{ $settings->empresa_nombre ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="empresa_logo" class="form-label">Logo de la Empresa</label>
                                @if(isset($settings->empresa_logo))
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings->empresa_logo) }}" 
                                            alt="Logo actual" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="empresa_logo" name="empresa_logo"
                                    accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="empresa_direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="empresa_direccion" name="empresa_direccion"
                                    value="{{ $settings->empresa_direccion ?? '' }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="empresa_telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="empresa_telefono" name="empresa_telefono"
                                            value="{{ $settings->empresa_telefono ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="empresa_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="empresa_email" name="empresa_email"
                                            value="{{ $settings->empresa_email ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Configuración de Ventas</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="moneda_simbolo" class="form-label">Símbolo de Moneda</label>
                                        <input type="text" class="form-control" id="moneda_simbolo" name="moneda_simbolo"
                                            value="{{ $settings->moneda_simbolo ?? '$' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="impuesto_porcentaje" class="form-label">Porcentaje de Impuesto</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" class="form-control" id="impuesto_porcentaje" 
                                                name="impuesto_porcentaje" value="{{ $settings->impuesto_porcentaje ?? '18.00' }}">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Personalización de Documentos</h5>
                            <hr>

                            <div class="mb-3">
                                <label for="factura_pie_pagina" class="form-label">Pie de Página en Facturas</label>
                                <textarea class="form-control" id="factura_pie_pagina" name="factura_pie_pagina" 
                                    rows="3">{{ $settings->factura_pie_pagina ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="ticket_pie_pagina" class="form-label">Pie de Página en Tickets</label>
                                <textarea class="form-control" id="ticket_pie_pagina" name="ticket_pie_pagina" 
                                    rows="3">{{ $settings->ticket_pie_pagina ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
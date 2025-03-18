<div class="row">
    <div class="col-md-12 mb-4">
        <label for="name" class="form-label fw-bold text-primary">Nombre del Proveedor</label>
        <input type="text" 
               class="form-control form-control-lg @error('name') is-invalid @enderror" 
               id="name" 
               name="name" 
               value="{{ old('name', $proveedor->name ?? '') }}" 
               maxlength="50"
               required>
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12 mb-4">
        <label for="Legal_Compliance" class="form-label fw-bold text-primary">Cumplimiento Legal</label>
        <textarea class="form-control @error('Legal_Compliance') is-invalid @enderror" 
                 id="Legal_Compliance" 
                 name="Legal_Compliance"
                 rows="3"
                 maxlength="200"
                 required>{{ old('Legal_Compliance', $proveedor->{'Legal Compliance'} ?? '') }}</textarea>
        @error('Legal_Compliance')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12 mb-4">
        <label for="General_Supplier_Profile" class="form-label fw-bold text-primary">Perfil General del Proveedor</label>
        <textarea class="form-control @error('General_Supplier_Profile') is-invalid @enderror" 
                 id="General_Supplier_Profile" 
                 name="General_Supplier_Profile"
                 rows="3"
                 maxlength="200"
                 required>{{ old('General_Supplier_Profile', $proveedor->{'General Supplier Profile'} ?? '') }}</textarea>
        @error('General_Supplier_Profile')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6 mb-4">
        <label for="Price" class="form-label fw-bold text-primary">Precio</label>
        <div class="input-group input-group-lg">
            <span class="input-group-text bg-primary text-white">$</span>
            <input type="number" 
                   class="form-control @error('Price') is-invalid @enderror" 
                   id="Price" 
                   name="Price" 
                   value="{{ old('Price', $proveedor->Price ?? '') }}"
                   required>
        </div>
        @error('Price')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12 mb-4">
        <label for="Technical_Capability" class="form-label fw-bold text-primary">Capacidad Técnica</label>
        <textarea class="form-control @error('Technical_Capability') is-invalid @enderror" 
                 id="Technical_Capability" 
                 name="Technical_Capability"
                 rows="3"
                 maxlength="200"
                 required>{{ old('Technical_Capability', $proveedor->{'Technical Capability'} ?? '') }}</textarea>
        @error('Technical_Capability')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12 mb-4">
        <label for="Technology_and_Infrastructure" class="form-label fw-bold text-primary">Tecnología e Infraestructura</label>
        <textarea class="form-control @error('Technology_and_Infrastructure') is-invalid @enderror" 
                 id="Technology_and_Infrastructure" 
                 name="Technology_and_Infrastructure"
                 rows="3"
                 maxlength="200"
                 required>{{ old('Technology_and_Infrastructure', $proveedor->{'Technology and Infrastructure'} ?? '') }}</textarea>
        @error('Technology_and_Infrastructure')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12 mb-4">
        <label for="Performance_and_Service_Level" class="form-label fw-bold text-primary">Nivel de Servicio y Desempeño</label>
        <textarea class="form-control @error('Performance_and_Service_Level') is-invalid @enderror" 
                 id="Performance_and_Service_Level" 
                 name="Performance_and_Service_Level"
                 rows="3"
                 maxlength="200"
                 required>{{ old('Performance_and_Service_Level', $proveedor->{'Performance and Service Level'} ?? '') }}</textarea>
        @error('Performance_and_Service_Level')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
    <button type="submit" class="btn btn-primary btn-lg px-5">
        <i class="fas fa-save me-2"></i> {{ $buttonText }}
    </button>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary btn-lg px-5">
        <i class="fas fa-times me-2"></i> Cancelar
    </a>
</div> 
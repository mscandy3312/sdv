@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Nueva Venta</h2>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('sales.store') }}" method="POST" id="sale-form">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_id">Cliente</label>
                                    <select class="form-control @error('customer_id') is-invalid @enderror" 
                                            id="customer_id" name="customer_id" required>
                                        <option value="">Seleccione un cliente</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }} - {{ $customer->dni }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="mb-0">Productos</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <select class="form-control" id="product-select">
                                            <option value="">Seleccione un producto</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" 
                                                        data-name="{{ $product->name }}"
                                                        data-price="{{ $product->price }}"
                                                        data-stock="{{ $product->stock }}">
                                                    {{ $product->name }} - Stock: {{ $product->stock }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="quantity-input" 
                                               placeholder="Cantidad" min="1">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary" id="add-product">
                                            Agregar
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="products-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                                <td><span id="total">$0.00</span></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>IGV (18%):</strong></td>
                                                <td><span id="tax">$0.00</span></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>Total con IGV:</strong></td>
                                                <td><span id="total-with-tax">$0.00</span></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="submit-sale">
                                Registrar Venta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let products = [];
    const productSelect = document.getElementById('product-select');
    const quantityInput = document.getElementById('quantity-input');
    const addProductBtn = document.getElementById('add-product');
    const productsTable = document.getElementById('products-table').getElementsByTagName('tbody')[0];
    const saleForm = document.getElementById('sale-form');

    function updateTotals() {
        let total = 0;
        products.forEach(p => {
            total += p.price * p.quantity;
        });
        
        const tax = total * 0.18;
        const totalWithTax = total + tax;

        document.getElementById('total').textContent = '$' + total.toFixed(2);
        document.getElementById('tax').textContent = '$' + tax.toFixed(2);
        document.getElementById('total-with-tax').textContent = '$' + totalWithTax.toFixed(2);
    }

    function removeProduct(index) {
        products.splice(index, 1);
        renderProducts();
        updateTotals();
    }

    function renderProducts() {
        productsTable.innerHTML = '';
        products.forEach((product, index) => {
            const row = productsTable.insertRow();
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.quantity}</td>
                <td>$${product.price.toFixed(2)}</td>
                <td>$${(product.price * product.quantity).toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeProduct(${index})">
                        Eliminar
                    </button>
                </td>
            `;
        });
    }

    addProductBtn.addEventListener('click', function() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        if (!selectedOption.value || !quantityInput.value) {
            alert('Por favor seleccione un producto y especifique la cantidad');
            return;
        }

        const quantity = parseInt(quantityInput.value);
        const stock = parseInt(selectedOption.dataset.stock);
        
        if (quantity > stock) {
            alert('La cantidad supera el stock disponible');
            return;
        }

        products.push({
            id: selectedOption.value,
            name: selectedOption.dataset.name,
            quantity: quantity,
            price: parseFloat(selectedOption.dataset.price)
        });

        renderProducts();
        updateTotals();

        // Reset inputs
        productSelect.value = '';
        quantityInput.value = '';
    });

    saleForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (products.length === 0) {
            alert('Debe agregar al menos un producto');
            return;
        }

        // Add products to form
        products.forEach((product, index) => {
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = `products[${index}][id]`;
            idInput.value = product.id;

            const quantityInput = document.createElement('input');
            quantityInput.type = 'hidden';
            quantityInput.name = `products[${index}][quantity]`;
            quantityInput.value = product.quantity;

            saleForm.appendChild(idInput);
            saleForm.appendChild(quantityInput);
        });

        saleForm.submit();
    });

    // Make removeProduct function globally available
    window.removeProduct = removeProduct;
});
</script>
@endpush
@endsection

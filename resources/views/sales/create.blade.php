@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>New Sale</h2>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sales.store') }}" id="sale-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="client_id">Client</label>
                            <select class="form-control @error('client_id') is-invalid @enderror" 
                                    id="client_id" 
                                    name="client_id" 
                                    required>
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" 
                                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} {{ $client->lastname }} - {{ $client->dni }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Products
                                <button type="button" class="btn btn-sm btn-success float-end" id="add-product">
                                    Add Product
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="products-container">
                                    <!-- Products will be added here dynamically -->
                                </div>
                                <div class="text-end mt-3">
                                    <h4>Total: $<span id="total">0.00</span></h4>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Sale</button>
                            <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product template -->
<template id="product-template">
    <div class="product-row border rounded p-3 mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Product</label>
                    <select class="form-control product-select" name="products[][id]" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                    data-price="{{ $product->price }}"
                                    data-stock="{{ $product->stock }}">
                                {{ $product->name }} - Stock: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" 
                           class="form-control quantity-input" 
                           name="products[][quantity]" 
                           min="1" 
                           value="1" 
                           required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Subtotal</label>
                    <input type="text" class="form-control subtotal" readonly>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <button type="button" class="btn btn-danger btn-sm remove-product">Remove</button>
            </div>
        </div>
    </div>
</template>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('products-container');
    const addButton = document.getElementById('add-product');
    const template = document.getElementById('product-template');
    const form = document.getElementById('sale-form');

    function updateTotals() {
        let total = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            const subtotalInput = row.querySelector('.subtotal');
            if (subtotalInput.value) {
                total += parseFloat(subtotalInput.value);
            }
        });
        document.getElementById('total').textContent = total.toFixed(2);
    }

    function handleProductChange(row) {
        const select = row.querySelector('.product-select');
        const quantityInput = row.querySelector('.quantity-input');
        const priceInput = row.querySelector('input[readonly]:not(.subtotal)');
        const subtotalInput = row.querySelector('.subtotal');
        
        const option = select.selectedOptions[0];
        const price = option.dataset.price || 0;
        const stock = parseInt(option.dataset.stock || 0);
        
        quantityInput.max = stock;
        priceInput.value = price;
        
        const quantity = parseInt(quantityInput.value || 0);
        subtotalInput.value = (price * quantity).toFixed(2);
        
        updateTotals();
    }

    addButton.addEventListener('click', () => {
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
        
        const newRow = container.lastElementChild;
        
        newRow.querySelector('.product-select').addEventListener('change', () => {
            handleProductChange(newRow);
        });
        
        newRow.querySelector('.quantity-input').addEventListener('input', () => {
            handleProductChange(newRow);
        });
        
        newRow.querySelector('.remove-product').addEventListener('click', () => {
            newRow.remove();
            updateTotals();
        });
    });

    form.addEventListener('submit', (e) => {
        const products = container.querySelectorAll('.product-row');
        if (products.length === 0) {
            e.preventDefault();
            alert('Please add at least one product');
        }
    });

    // Add first product row automatically
    addButton.click();
});
</script>
@endsection 
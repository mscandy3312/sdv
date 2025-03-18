@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class='bx bx-cart-alt me-2'></i>Mi Carrito</h3>
                <span class="badge bg-light text-primary">{{ session()->has('cart') ? count(session('cart')) : 0 }} productos</span>
            </div>
        </div>
        <div class="card-body">
            @if(session('cart'))
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['precio'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td style="min-width: 200px;">
                                        <div class="d-flex align-items-center">
                                            @if($details['imagen'])
                                                <img src="{{ Storage::url($details['imagen']) }}" 
                                                     alt="{{ $details['nombre'] }}"
                                                     class="img-thumbnail me-3"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $details['nombre'] }}</h6>
                                                <small class="text-muted">SKU: {{ $id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['precio'], 2) }}</td>
                                    <td style="width: 150px;">
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="decrementQuantity(this)">-</button>
                                            <input type="number" 
                                                   value="{{ $details['quantity'] }}" 
                                                   class="form-control form-control-sm text-center quantity update-cart"
                                                   min="1"
                                                   style="width: 60px">
                                            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="incrementQuantity(this)">+</button>
                                        </div>
                                    </td>
                                    <td class="text-primary fw-bold">${{ number_format($details['precio'] * $details['quantity'], 2) }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm remove-from-cart">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2" class="text-primary"><h4 class="mb-0">${{ number_format($total, 2) }}</h4></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">
                        <i class='bx bx-arrow-back me-2'></i>Seguir Comprando
                    </a>
                    <div>
                        <button class="btn btn-danger me-2" onclick="clearCart()">
                            <i class='bx bx-trash me-2'></i>Vaciar Carrito
                        </button>
                        <button class="btn btn-primary" onclick="checkout()">
                            <i class='bx bx-check me-2'></i>Proceder al Pago
                        </button>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-cart-alt text-muted" style="font-size: 5rem;"></i>
                    <h4 class="mt-3">Tu carrito está vacío</h4>
                    <p class="text-muted">¡Agrega algunos productos a tu carrito!</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">
                        <i class='bx bx-shopping-bag me-2'></i>Ir a la Tienda
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function incrementQuantity(button) {
    const input = button.previousElementSibling;
    input.value = parseInt(input.value) + 1;
    $(input).trigger('change');
}

function decrementQuantity(button) {
    const input = button.nextElementSibling;
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        $(input).trigger('change');
    }
}

function clearCart() {
    if(confirm('¿Estás seguro de vaciar el carrito?')) {
        // Implementar la lógica para vaciar el carrito
        window.location.href = '/shop/clear-cart';
    }
}

function checkout() {
    // Implementar la lógica para proceder al pago
    alert('Redirigiendo al proceso de pago...');
}

$(document).ready(function() {
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('shop.updateCart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("¿Estás seguro de eliminar este producto?")) {
            $.ajax({
                url: '{{ route('shop.removeFromCart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
});
</script>

<style>
.card-header {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
}

.quantity-control {
    border-color: var(--light-blue);
}

.btn-outline-secondary {
    color: var(--primary-blue);
    border-color: var(--light-blue);
}

.btn-outline-secondary:hover {
    background-color: var(--pale-blue);
    color: var(--dark-blue);
}

.table-light {
    background-color: var(--pale-blue);
}

.text-primary {
    color: var(--primary-blue) !important;
}

.badge.bg-light {
    background-color: var(--pale-blue) !important;
    color: var(--primary-blue) !important;
}

.img-thumbnail {
    border-color: var(--light-blue);
}

.img-thumbnail:hover {
    border-color: var(--primary-blue);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--dark-blue), var(--hover-blue));
}

.quantity {
    border-color: var(--light-blue);
}

.quantity:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
}
</style>
@endpush
@endsection 
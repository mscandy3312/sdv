<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Nueva Venta</h4>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form id="formVenta" action="{{ route('ventas.store') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="client_id" class="form-label">Cliente</label>
                                    <select class="form-select @error('client_id') is-invalid @enderror" 
                                            name="client_id" 
                                            required>
                                        <option value="">Seleccionar Cliente</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <div class="search-container position-relative">
                                        <div class="input-group">
                                            <input type="text" 
                                                   id="searchInput" 
                                                   class="form-control" 
                                                   placeholder="Buscar producto por nombre o código"
                                                   autocomplete="off">
                                            <button class="btn btn-outline-secondary" type="button" id="btnBuscar">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        <div id="searchResults" class="position-absolute w-100 mt-1 shadow-sm" style="display:none; z-index:1000; max-height:300px; overflow-y:auto;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table" id="tablaProductos">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td colspan="2"><strong id="total">$0.00</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <input type="hidden" id="total_venta" name="total_venta" value="0">

                            <div class="text-end mt-3">
                                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Registrar Venta
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
        let productosSeleccionados = [];

        // Simplificar la función de búsqueda
        async function buscarProducto() {
            const search = document.getElementById('searchInput').value;
            if(!search) return;

            try {
                const response = await fetch(`/ventas/productos/buscar?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const productos = await response.json();
                console.log('Productos encontrados:', productos); // Para debug
                
                const resultsDiv = document.getElementById('searchResults');
                resultsDiv.innerHTML = '';
                
                if (productos.length === 0) {
                    resultsDiv.innerHTML = '<div class="p-2">No se encontraron productos</div>';
                    resultsDiv.style.display = 'block';
                    return;
                }

                productos.forEach(producto => {
                    const div = document.createElement('div');
                    div.className = 'p-2 border-bottom hover-bg-light cursor-pointer';
                    div.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>${producto.nombre}</strong>
                                <div class="small">Stock: ${producto.stock}</div>
                            </div>
                            <div>
                                <strong>$${producto.precio}</strong>
                            </div>
                        </div>
                    `;
                    div.onclick = () => seleccionarProducto(producto);
                    resultsDiv.appendChild(div);
                });
                
                resultsDiv.style.display = 'block';
                
            } catch (error) {
                console.error('Error en la búsqueda:', error);
            }
        }

        function seleccionarProducto(producto) {
            // Verificar si el producto ya está en la lista
            if (productosSeleccionados.some(p => p.id === producto.id)) {
                alert('Este producto ya está en la lista');
                return;
            }

            // Agregar el producto a la lista
            productosSeleccionados.push({
                ...producto,
                cantidad: 1
            });

            // Limpiar búsqueda
            document.getElementById('searchInput').value = '';
            document.getElementById('searchResults').style.display = 'none';

            actualizarTabla();
        }

        function actualizarTabla() {
            const tbody = document.querySelector('#tablaProductos tbody');
            let total = 0;

            tbody.innerHTML = productosSeleccionados.map((producto, index) => {
                const subtotal = producto.precio * producto.cantidad;
                total += subtotal;

                return `
                    <tr>
                        <td>${producto.nombre}</td>
                        <td>$${producto.precio.toFixed(2)}</td>
                        <td>
                            <input type="number" 
                                   class="form-control form-control-sm" 
                                   value="${producto.cantidad}"
                                   min="1"
                                   max="${producto.stock}"
                                   onchange="actualizarCantidad(${index}, this.value)"
                                   style="width: 80px">
                            <input type="hidden" name="productos[]" value="${producto.id}">
                            <input type="hidden" name="cantidades[]" value="${producto.cantidad}">
                        </td>
                        <td>$${subtotal.toFixed(2)}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');

            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
            document.getElementById('total_venta').value = total;
        }

        function actualizarCantidad(index, cantidad) {
            cantidad = parseInt(cantidad);
            if (cantidad > productosSeleccionados[index].stock) {
                alert('Stock insuficiente');
                actualizarTabla();
                return;
            }
            productosSeleccionados[index].cantidad = cantidad;
            actualizarTabla();
        }

        function eliminarProducto(index) {
            productosSeleccionados.splice(index, 1);
            actualizarTabla();
        }

        // Event Listeners
        document.getElementById('searchInput').addEventListener('keyup', function() {
            if (this.value.length >= 2) {
                buscarProducto();
            } else {
                document.getElementById('searchResults').style.display = 'none';
            }
        });

        document.getElementById('btnBuscar').addEventListener('click', function() {
            buscarProducto();
        });

        // Cerrar resultados al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-container')) {
                document.getElementById('searchResults').style.display = 'none';
            }
        });

        // Validación del formulario
        document.getElementById('formVenta').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!document.querySelector('[name="client_id"]').value) {
                alert('Debe seleccionar un cliente');
                return;
            }

            if (productosSeleccionados.length === 0) {
                alert('Debe agregar al menos un producto');
                return;
            }

            this.submit();
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .hover-bg-light:hover {
            background-color: #f8f9fa !important;
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    @endpush
</x-app-layout>

@extends('layouts.app')

@section('title', 'Registrar Nueva Venta')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title mb-0">
                    <i class="fas fa-cash-register me-2"></i> Registrar Nueva Venta
                </h1>
            </div>

            <div class="card-body">
                <form action="{{ route('ventas.store') }}" method="POST" id="venta-form">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="dni" name="dni" required>
                                <label for="dni">DNI del Cliente</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente"
                                    required>
                                <label for="nombre_cliente">Nombres del Cliente</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente"
                                    required>
                                <label for="apellido_cliente">Apellidos del Cliente</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-boxes me-2"></i> Productos
                        </h5>

                        <div id="productos-container">
                            <div class="producto-item card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <select class="form-select producto-select" name="producto_id[]" required>
                                                <option value="" disabled selected>Seleccione un producto</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}"
                                                        data-imagen="{{ $producto->imagen_principal ? asset('storage/' . $producto->imagen_principal) : asset('img/default-product.png') }}"
                                                        data-precio="{{ number_format($producto->precio, 2) }}"
                                                        data-stock="{{ $producto->stock }}"
                                                        data-sku="{{ $producto->sku ?? 'N/A' }}"
                                                        data-color="{{ $producto->color }}"
                                                        data-talla="{{ $producto->talla }}">
                                                        {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control cantidad-input" name="cantidad[]"
                                                placeholder="Cantidad" min="1" required>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center">
                                                <img src="" class="producto-imagen img-thumbnail me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <span class="producto-precio text-success fw-bold"></span>
                                                    <div class="producto-detalles small text-muted">
                                                        <div class="producto-sku"></div>
                                                        <div class="producto-talla-color"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <button type="button" class="btn btn-outline-danger remove-producto">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-producto" class="btn btn-outline-primary mt-2">
                            <i class="fas fa-plus me-1"></i> Agregar otro producto
                        </button>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Registrar Venta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Añadir nuevo producto
            document.getElementById('add-producto').addEventListener('click', function() {
                const container = document.getElementById('productos-container');
                const newItem = document.querySelector('.producto-item').cloneNode(true);

                // Limpiar selección y valores
                const select = newItem.querySelector('.producto-select');
                select.selectedIndex = 0;
                newItem.querySelector('.cantidad-input').value = '';
                newItem.querySelector('.producto-imagen').src = '';
                newItem.querySelector('.producto-precio').textContent = '';
                newItem.querySelector('.producto-sku').textContent = '';
                newItem.querySelector('.producto-talla-color').textContent = '';

                container.appendChild(newItem);
                updateProductoInfo(newItem);
            });

            // Eliminar producto
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-producto')) {
                    if (document.querySelectorAll('.producto-item').length > 1) {
                        e.target.closest('.producto-item').remove();
                    } else {
                        alert('Debe haber al menos un producto en la venta.');
                    }
                }
            });

            // Actualizar información del producto al seleccionar
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('producto-select')) {
                    updateProductoInfo(e.target.closest('.producto-item'));
                }
            });

            // Validar cantidad no exceda stock
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('cantidad-input')) {
                    const productoItem = e.target.closest('.producto-item');
                    const stock = parseInt(productoItem.querySelector('.producto-select').dataset.stock);
                    const cantidadInput = productoItem.querySelector('.cantidad-input');

                    if (parseInt(cantidadInput.value) > stock) {
                        cantidadInput.setCustomValidity(
                            'La cantidad no puede ser mayor al stock disponible');
                        cantidadInput.reportValidity();
                    } else {
                        cantidadInput.setCustomValidity('');
                    }
                }
            });

            // Función para actualizar la información visual del producto
            function updateProductoInfo(productoItem) {
                const select = productoItem.querySelector('.producto-select');
                const selectedOption = select.options[select.selectedIndex];

                if (selectedOption.value) {
                    // Actualizar imagen
                    productoItem.querySelector('.producto-imagen').src = selectedOption.dataset.imagen;

                    // Actualizar precio
                    productoItem.querySelector('.producto-precio').textContent = '$' + selectedOption.dataset
                        .precio;

                    // Actualizar detalles adicionales
                    productoItem.querySelector('.producto-sku').textContent = 'SKU: ' + selectedOption.dataset.sku;
                    productoItem.querySelector('.producto-talla-color').textContent =
                        selectedOption.dataset.talla + ' / ' + selectedOption.dataset.color;

                    // Establecer máximo en input de cantidad
                    const cantidadInput = productoItem.querySelector('.cantidad-input');
                    cantidadInput.max = selectedOption.dataset.stock;
                    cantidadInput.placeholder = 'Máx: ' + selectedOption.dataset.stock;
                } else {
                    // Limpiar campos si no hay selección
                    productoItem.querySelector('.producto-imagen').src = '';
                    productoItem.querySelector('.producto-precio').textContent = '';
                    productoItem.querySelector('.producto-sku').textContent = '';
                    productoItem.querySelector('.producto-talla-color').textContent = '';
                }
            }

            // Inicializar el primer producto
            updateProductoInfo(document.querySelector('.producto-item'));
        });
    </script>
@endsection

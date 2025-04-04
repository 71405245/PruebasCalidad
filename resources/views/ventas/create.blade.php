@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Registrar Nueva Venta</h1>
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="dni" class="form-label">DNI del Cliente</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            
            <div class="mb-3">
                <label for="nombre_cliente" class="form-label">Nombres del Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
            </div>

            <div class="mb-3">
                <label for="apellido_cliente" class="form-label">Apellidos del Cliente</label>
                <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Productos</label>
                <div id="productos-container">
                    <div class="input-group mb-2">
                        <select class="form-select" name="producto_id[]" required>
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
                        <button type="button" class="btn btn-danger remove-producto">X</button>
                    </div>
                </div>
                <button type="button" id="add-producto" class="btn btn-secondary mt-2">Agregar otro producto</button>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Venta</button>
        </form>
    </div>

    <script>
        document.getElementById('add-producto').addEventListener('click', function () {
            const container = document.getElementById('productos-container');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <select class="form-select" name="producto_id[]" required>
                    <option value="" disabled selected>Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
                <button type="button" class="btn btn-danger remove-producto">X</button>
            `;
            container.appendChild(div);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-producto')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection

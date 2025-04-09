@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="display-4 text-center mb-4">Editar Venta</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Formulario de edición -->
        <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Método PUT para la actualización -->

            <div class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                <select name="producto_id" id="producto" class="form-select">
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" 
                            {{ $venta->productos->contains($producto->id) ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad', $venta->productos->sum('pivot.cantidad')) }}">
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" name="total" id="total" class="form-control" value="{{ old('total', $venta->total) }}" step="0.01">
            </div>

            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Actualizar Venta</button>
        </form>

    </div>
@endsection

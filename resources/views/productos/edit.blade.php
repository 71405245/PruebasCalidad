@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($producto) ? 'Editar' : 'Crear' }} Producto</h1>
    
    <form method="POST" action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($producto))
            @method('PUT')
        @endif

        @include('productos.partials._form')

        <button type="submit" class="btn btn-primary">
            {{ isset($producto) ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
@endsection
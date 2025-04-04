@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="container text-center mt-5">
        <h1>Bienvenido al Sistema de Ventas</h1>
        <p class="lead">Gestiona tus productos y ventas de manera eficiente.</p>

        <div class="d-flex justify-content-center gap-4 mt-5">
            <a href="{{ route('productos.index') }}" class="btn btn-warning text-white fw-bold w-25 py-6 fs-2">Gestión de Productos</a>
            <a href="{{ route('ventas.index') }}" class="btn btn-primary text-white fw-bold w-25 py-6 fs-2">Gestión de Ventas</a>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre }}</li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">{{ $producto->nombre }}</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Columna de imágenes  -->
            <div class="col-md-5">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if ($producto->imagen_principal)
                            <img src="{{ asset('storage/' . $producto->imagen_principal) }}" class="img-fluid rounded mb-3"
                                alt="{{ $producto->nombre }}">
                        @else
                            <div class="bg-light p-5 text-center text-muted rounded">
                                <i class="bi bi-image fs-1"></i>
                                <p class="mt-2">Sin imagen principal</p>
                            </div>
                        @endif

                        @if ($producto->imagenes_adicionales)
                            @php
                                // Convertir JSON a array si es necesario
                                $imagenesAdicionales = is_string($producto->imagenes_adicionales)
                                    ? json_decode($producto->imagenes_adicionales, true)
                                    : $producto->imagenes_adicionales;
                            @endphp

                            @if (is_array($imagenesAdicionales) && count($imagenesAdicionales) > 0)
                                <div class="d-flex flex-wrap gap-2 justify-content-center mt-3">
                                    @foreach ($imagenesAdicionales as $image)
                                        @if ($image)
                                            {{-- Verificar que la imagen no sea null --}}
                                            <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail" width="80"
                                                alt="Imagen adicional del producto">
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Columna de detalles -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Información del Producto</h4>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>SKU:</strong> {{ $producto->sku ?? 'N/A' }}</p>
                                <p class="mb-1"><strong>Código de barras:</strong> {{ $producto->codigo_barras ?? 'N/A' }}
                                </p>
                                <p class="mb-1"><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'N/A' }}
                                </p>
                                <p class="mb-1"><strong>Marca:</strong> {{ $producto->marca->nombre ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Talla:</strong> {{ $producto->talla }}</p>
                                <p class="mb-1"><strong>Color:</strong> {{ $producto->color }}</p>
                                <p class="mb-1"><strong>Género:</strong> {{ $producto->genero }}</p>
                                <p class="mb-1"><strong>Material:</strong> {{ $producto->material ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-2">Descripción</h5>
                            <p class="text-muted">{{ $producto->descripcion ?? 'No hay descripción disponible' }}</p>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-muted">Precio</h6>
                                        @if ($producto->precio_descuento)
                                            <h4 class="text-danger fw-bold">
                                                ${{ number_format($producto->precio_descuento, 2) }}</h4>
                                            <small
                                                class="text-decoration-line-through text-muted">${{ number_format($producto->precio, 2) }}</small>
                                        @else
                                            <h4 class="fw-bold">${{ number_format($producto->precio, 2) }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-muted">Stock</h6>
                                        <h4 class="{{ $producto->stock > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $producto->stock }}
                                        </h4>
                                        <small>{{ $producto->stock > 0 ? 'Disponible' : 'Agotado' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-muted">Estado</h6>
                                        <div>
                                            @if ($producto->es_destacado)
                                                <span class="badge bg-warning text-dark mb-1">Destacado</span>
                                            @endif
                                            @if ($producto->es_nuevo)
                                                <span class="badge bg-info mb-1">Nuevo</span>
                                            @endif
                                            @if ($producto->es_promocion)
                                                <span class="badge bg-danger mb-1">Promoción</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

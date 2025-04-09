@extends('layouts.app')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold">
                    <i class="bi bi-tag"></i> Catálogo de Productos
                </h2>
                <p class="text-muted">Administra todos los productos de tu tienda de ropa</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('productos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nuevo Producto
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('productos.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="search" class="form-label">Buscar</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Nombre, SKU...">
                        </div>
                        <div class="col-md-2">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select class="form-select" id="categoria" name="categoria">
                                <option value="">Todas</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" 
                                        {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="marca" class="form-label">Marca</label>
                            <select class="form-select" id="marca" name="marca">
                                <option value="">Todas</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}" 
                                        {{ request('marca') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-select" id="genero" name="genero">
                                <option value="">Todos</option>
                                <option value="Masculino" {{ request('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ request('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Unisex" {{ request('genero') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bi bi-funnel"></i> Filtrar
                            </button>
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de productos -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Marca</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Talla</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productos as $producto)
                                <tr>
                                    <td>
                                        @if($producto->imagen_principal)
                                            <img src="{{ asset('storage/' . $producto->imagen_principal) }}" 
                                                 alt="{{ $producto->nombre }}" 
                                                 class="img-thumbnail" width="60">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $producto->nombre }}</strong>
                                        <div class="text-muted small">{{ $producto->sku }}</div>
                                    </td>
                                    <td>{{ $producto->categoria->nombre ?? 'N/A' }}</td>
                                    <td>{{ $producto->marca->nombre ?? 'N/A' }}</td>
                                    <td>
                                        @if($producto->precio_descuento)
                                            <span class="text-danger fw-bold">${{ number_format($producto->precio_descuento, 2) }}</span>
                                            <span class="text-decoration-line-through text-muted small d-block">${{ number_format($producto->precio, 2) }}</span>
                                        @else
                                            <span class="fw-bold">${{ number_format($producto->precio, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $producto->stock > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </td>
                                    <td>{{ $producto->talla }}</td>
                                    <td>
                                        @if($producto->es_destacado)
                                            <span class="badge bg-warning text-dark">Destacado</span>
                                        @endif
                                        @if($producto->es_nuevo)
                                            <span class="badge bg-info">Nuevo</span>
                                        @endif
                                        @if($producto->es_promocion)
                                            <span class="badge bg-danger">Promoción</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('productos.edit', $producto->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            
                                            <form action="{{ route('productos.destroy', $producto->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este producto?')"
                                                        title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            
                                            <a href="{{ route('productos.show', $producto->id) }}" 
                                               class="btn btn-sm btn-outline-secondary" 
                                               title="Ver detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="bi bi-exclamation-circle fs-4"></i>
                                        <p class="mt-2">No se encontraron productos</p>
                                        <a href="{{ route('productos.create') }}" class="btn btn-sm btn-primary">
                                            Crear primer producto
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Paginación -->
        @if($productos->hasPages())
            <div class="mt-4">
                {{ $productos->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
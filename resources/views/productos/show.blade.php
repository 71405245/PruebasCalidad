@extends('layouts.app')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 30px 30px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: rotate(15deg);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .product-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .product-header {
        background: linear-gradient(45deg, #f8f9fa, #ffffff);
        padding: 2rem;
        border-bottom: 2px solid #e9ecef;
        position: relative;
    }
    
    .product-badges {
        position: absolute;
        top: 2rem;
        right: 2rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .product-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .badge-destacado {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #8b5a00;
    }
    
    .badge-nuevo {
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        color: white;
    }
    
    .badge-promocion {
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white;
    }
    
    .product-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }
    
    .product-sku {
        font-family: 'Courier New', monospace;
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        padding: 0.5rem 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        display: inline-block;
    }
    
    .breadcrumb-custom {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .breadcrumb-custom .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .breadcrumb-custom .breadcrumb-item a:hover {
        color: white;
    }
    
    .breadcrumb-custom .breadcrumb-item.active {
        color: white;
        font-weight: 600;
    }
    
    .product-body {
        padding: 0;
    }
    
    .image-gallery {
        padding: 2rem;
        background: #f8f9fa;
    }
    
    .main-image-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        margin-bottom: 1.5rem;
        background: white;
    }
    
    .main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .main-image:hover {
        transform: scale(1.05);
    }
    
    .no-image-placeholder {
        height: 400px;
        background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #6c757d;
        border-radius: 20px;
    }
    
    .no-image-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .thumbnail-gallery {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .thumbnail-item {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .thumbnail-item:hover {
        transform: scale(1.1);
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-details {
        padding: 2rem;
    }
    
    .details-section {
        background: linear-gradient(145deg, #f8f9fa, #ffffff);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 4px solid #667eea;
    }
    
    .section-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.2rem;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .info-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .info-content h6 {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-content p {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .description-section {
        background: linear-gradient(145deg, #f8f9ff, #ffffff);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 2px solid #e9ecef;
    }
    
    .description-text {
        color: #6c757d;
        line-height: 1.7;
        font-size: 1.1rem;
        margin: 0;
    }
    
    .price-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .price-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }
    
    .price-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-color);
    }
    
    .price-card:hover {
        transform: translateY(-5px);
        border-color: var(--card-color);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .price-card.price { --card-color: linear-gradient(45deg, #667eea, #764ba2); }
    .price-card.stock { --card-color: linear-gradient(45deg, #28a745, #20c997); }
    .price-card.status { --card-color: linear-gradient(45deg, #ffc107, #fd7e14); }
    
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        background: var(--card-color);
    }
    
    .card-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    
    .card-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .card-subtitle {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .price-original {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 1rem;
        margin-left: 0.5rem;
    }
    
    .stock-high { color: #28a745; }
    .stock-medium { color: #ffc107; }
    .stock-low { color: #fd7e14; }
    .stock-out { color: #dc3545; }
    
    .action-buttons {
        background: #f8f9fa;
        padding: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: space-between;
        align-items: center;
        border-top: 2px solid #e9ecef;
        flex-wrap: wrap;
    }
    
    .btn-custom {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        font-size: 1rem;
    }
    
    .btn-primary-custom {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(45deg, #5a6fd8, #6a4190);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-warning-custom {
        background: linear-gradient(45deg, #ffc107, #fd7e14);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }
    
    .btn-warning-custom:hover {
        background: linear-gradient(45deg, #e0a800, #ea6100);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-secondary-custom {
        background: #6c757d;
        color: white;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }
    
    .btn-secondary-custom:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-success-custom {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    
    .btn-success-custom:hover {
        background: linear-gradient(45deg, #218838, #1ea080);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        backdrop-filter: blur(5px);
    }
    
    .modal-content-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
    
    .close-modal {
        position: absolute;
        top: 2rem;
        right: 2rem;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .close-modal:hover {
        background: rgba(0,0,0,0.8);
        transform: scale(1.1);
    }
    
    @media (max-width: 768px) {
        .product-title {
            font-size: 2rem;
        }
        
        .product-badges {
            position: static;
            margin-bottom: 1rem;
            flex-direction: row;
            flex-wrap: wrap;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .price-cards {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-custom {
            width: 100%;
            justify-content: center;
        }
        
        .main-image {
            height: 300px;
        }
    }
    
    .fade-in {
        animation: fadeIn 0.6s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .slide-in {
        animation: slideIn 0.8s ease forwards;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .thumbnail-item {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .thumbnail-item.active {
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transform: scale(1.05);
    }

    .thumbnail-item:hover {
        transform: scale(1.1);
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: white;
        font-size: 0.7rem;
        text-align: center;
        padding: 2px;
        font-weight: 600;
    }

    .btn-danger-custom {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-danger-custom:hover {
        background: linear-gradient(45deg, #c82333, #a71e2a);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        color: white;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-custom">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('productos.index') }}">
                            <i class="fas fa-box me-2"></i>Productos
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre }}</li>
                </ol>
            </nav>
            
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-eye me-3"></i>
                        Detalles del Producto
                    </h1>
                    <p class="lead mb-0">
                        Información completa y especificaciones técnicas
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('productos.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>
                        Volver al Catálogo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="product-container fade-in">
        <!-- Header del Producto -->
        <div class="product-header">
            <div class="product-badges">
                @if($producto->es_destacado)
                    <span class="product-badge badge-destacado">
                        <i class="fas fa-star"></i>Destacado
                    </span>
                @endif
                @if($producto->es_nuevo)
                    <span class="product-badge badge-nuevo">
                        <i class="fas fa-sparkles"></i>Nuevo
                    </span>
                @endif
                @if($producto->precio_descuento)
                    <span class="product-badge badge-promocion">
                        <i class="fas fa-percentage"></i>Promoción
                    </span>
                @endif
            </div>
            
            <h1 class="product-title">{{ $producto->nombre }}</h1>
            <div class="product-sku">
                <i class="fas fa-barcode me-2"></i>
                SKU: {{ $producto->sku ?? 'N/A' }}
            </div>
        </div>
        
        <div class="product-body">
            <div class="row">
                <!-- Galería de Imágenes -->
                <div class="col-lg-5">
                    <div class="image-gallery slide-in">
                        <div class="main-image-container">
                            @if($producto->imagen_principal)
                                <img src="{{ asset('storage/' . $producto->imagen_principal) }}" 
                                     class="main-image" 
                                     alt="{{ $producto->nombre }}"
                                     onclick="openImageModal(this.src)">
                            @else
                                <div class="no-image-placeholder">
                                    <div class="no-image-icon">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <p class="mb-0">Sin imagen principal</p>
                                </div>
                            @endif
                        </div>
                        
                        @if($producto->imagen_principal || ($producto->imagenes_adicionales && count(json_decode($producto->imagenes_adicionales, true) ?? []) > 0))
                            <div class="thumbnail-gallery">
                                <!-- Thumbnail de imagen principal -->
                                @if($producto->imagen_principal)
                                    <div class="thumbnail-item active" onclick="changeMainImage('{{ asset('storage/' . $producto->imagen_principal) }}', this)">
                                        <img src="{{ asset('storage/' . $producto->imagen_principal) }}" alt="Imagen principal">
                                        <div class="thumbnail-label">Principal</div>
                                    </div>
                                @endif
                                
                                <!-- Thumbnails de imágenes adicionales -->
                                @if($producto->imagenes_adicionales)
                                    @php
                                        $imagenesAdicionales = is_string($producto->imagenes_adicionales)
                                            ? json_decode($producto->imagenes_adicionales, true)
                                            : $producto->imagenes_adicionales;
                                    @endphp
                                    
                                    @if(is_array($imagenesAdicionales) && count($imagenesAdicionales) > 0)
                                        @foreach($imagenesAdicionales as $index => $image)
                                            @if($image)
                                                <div class="thumbnail-item" onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Imagen adicional {{ $index + 1 }}">
                                                    <div class="thumbnail-label">{{ $index + 1 }}</div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Detalles del Producto -->
                <div class="col-lg-7">
                    <div class="product-details">
                        <!-- Información Básica -->
                        <div class="details-section">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Información Básica
                            </h3>
                            
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Código de Barras</h6>
                                        <p>{{ $producto->codigo_barras ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Categoría</h6>
                                        <p>{{ $producto->categoria->nombre ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Marca</h6>
                                        <p>{{ $producto->marca->nombre ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-ruler"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Talla</h6>
                                        <p>{{ $producto->talla }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Color</h6>
                                        <p>{{ $producto->color }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-venus-mars"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Género</h6>
                                        <p>{{ ucfirst($producto->genero) }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Material</h6>
                                        <p>{{ $producto->material ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-weight"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Peso</h6>
                                        <p>{{ $producto->peso ? $producto->peso . 'g' : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Descripción -->
                        @if($producto->descripcion)
                            <div class="description-section">
                                <h3 class="section-title">
                                    <i class="fas fa-align-left"></i>
                                    Descripción
                                </h3>
                                <p class="description-text">{{ $producto->descripcion }}</p>
                            </div>
                        @endif
                        
                        <!-- Precios y Stock -->
                        <div class="price-cards">
                            <!-- Precio -->
                            <div class="price-card price">
                                <div class="card-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-label">Precio</div>
                                @if($producto->precio_descuento)
                                    <div class="card-value" style="color: #dc3545;">
                                        ${{ number_format($producto->precio_descuento, 2) }}
                                        <span class="price-original">${{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                    <div class="card-subtitle">Precio con descuento</div>
                                @else
                                    <div class="card-value">${{ number_format($producto->precio, 2) }}</div>
                                    <div class="card-subtitle">Precio regular</div>
                                @endif
                            </div>
                            
                            <!-- Stock -->
                            <div class="price-card stock">
                                <div class="card-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <div class="card-label">Stock</div>
                                <div class="card-value 
                                    @if($producto->stock > 20) stock-high
                                    @elseif($producto->stock > 5) stock-medium
                                    @elseif($producto->stock > 0) stock-low
                                    @else stock-out
                                    @endif">
                                    {{ $producto->stock }}
                                </div>
                                <div class="card-subtitle">
                                    @if($producto->stock > 20)
                                        Disponible
                                    @elseif($producto->stock > 5)
                                        Pocas unidades
                                    @elseif($producto->stock > 0)
                                        Últimas unidades
                                    @else
                                        Agotado
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Estado -->
                            <div class="price-card status">
                                <div class="card-icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <div class="card-label">Estado</div>
                                <div class="card-value" style="font-size: 1rem;">
                                    @if($producto->es_destacado || $producto->es_nuevo || $producto->precio_descuento)
                                        @if($producto->es_destacado)
                                            <span class="badge bg-warning text-dark mb-1">Destacado</span><br>
                                        @endif
                                        @if($producto->es_nuevo)
                                            <span class="badge bg-info mb-1">Nuevo</span><br>
                                        @endif
                                        @if($producto->precio_descuento)
                                            <span class="badge bg-danger mb-1">Promoción</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Regular</span>
                                    @endif
                                </div>
                                <div class="card-subtitle">Etiquetas del producto</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botones de Acción -->
        <div class="action-buttons">
            <div class="d-flex gap-2">
                <a href="{{ route('productos.index') }}" class="btn-custom btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i>
                    Volver al Catálogo
                </a>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn-custom btn-warning-custom">
                    <i class="fas fa-edit"></i>
                    Editar Producto
                </a>
                <button type="button" class="btn-custom btn-success-custom" onclick="addToCart()">
                    <i class="fas fa-shopping-cart"></i>
                    Agregar al Carrito
                </button>
                <button type="button" class="btn-custom btn-danger-custom" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i>
                    Eliminar Producto
                </button>
                <button type="button" class="btn-custom btn-primary-custom" onclick="generateReport()">
                    <i class="fas fa-file-pdf"></i>
                    Generar Reporte
                </button>
            </div>
        </div>

        <!-- Formulario oculto para eliminación -->
        <form id="delete-form" action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<!-- Modal de Imagen -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="close-modal" onclick="closeImageModal()">&times;</span>
    <img class="modal-content-image" id="modalImage">
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animaciones de entrada
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    });
    
    document.querySelectorAll('.info-item, .price-card').forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'all 0.6s ease';
        observer.observe(item);
    });
});

function changeMainImage(src, thumbnailElement) {
    const mainImage = document.querySelector('.main-image');
    if (mainImage) {
        // Remover clase active de todos los thumbnails
        document.querySelectorAll('.thumbnail-item').forEach(item => {
            item.classList.remove('active');
        });
        
        // Añadir clase active al thumbnail seleccionado
        if (thumbnailElement) {
            thumbnailElement.classList.add('active');
        }
        
        // Cambiar imagen principal con efecto de transición
        mainImage.style.opacity = '0';
        setTimeout(() => {
            mainImage.src = src;
            mainImage.style.opacity = '1';
        }, 200);
    }
}

function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = src;
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function addToCart() {
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Agregando...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> Agregado';
        button.style.background = 'linear-gradient(45deg, #28a745, #20c997)';
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            button.style.background = '';
        }, 2000);
    }, 1000);
    
    showNotification('Producto agregado al carrito exitosamente', 'success');
}

function confirmDelete() {
    // Usar SweetAlert2 si está disponible, sino usar confirm nativo
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: 'rgba(255, 255, 255, 0.95)',
            backdrop: 'rgba(0, 0, 0, 0.4)'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteProduct();
            }
        });
    } else {
        if (confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')) {
            deleteProduct();
        }
    }
}

function deleteProduct() {
    const form = document.getElementById('delete-form');
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Eliminando...';
    button.disabled = true;
    
    // Simular delay para mostrar el loading
    setTimeout(() => {
        form.submit();
    }, 500);
}

function generateReport() {
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-download"></i> Descargar';
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        }, 2000);
    }, 1500);
    
    showNotification('Reporte generado exitosamente', 'info');
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 2rem; right: 2rem; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-triangle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Cerrar modal con tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Inicializar thumbnail activo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const firstThumbnail = document.querySelector('.thumbnail-item');
    if (firstThumbnail) {
        firstThumbnail.classList.add('active');
    }
});
</script>
@endpush

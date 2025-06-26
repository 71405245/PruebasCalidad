@extends('layouts.app')

@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 50px 50px;
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: rotate(15deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .stats-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-top: -2rem;
            position: relative;
            z-index: 3;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
            border-radius: 15px;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            border-color: #667eea;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin: 0 auto 1rem;
        }

        .stat-icon.primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .stat-icon.success {
            background: linear-gradient(45deg, #56ab2f, #a8e6cf);
        }

        .stat-icon.info {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
        }

        .stat-icon.warning {
            background: linear-gradient(45deg, #ffd89b, #19547b);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .filters-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .search-container {
            position: relative;
        }

        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 1rem 1rem 3.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            width: 100%;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            background: white;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.1rem;
        }

        .filter-select {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .filter-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            background: white;
            outline: none;
        }

        .capacitaciones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .capacitacion-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border: 2px solid transparent;
            position: relative;
        }

        .capacitacion-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
        }

        .card-header {
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
        }

        .tipo-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tipo-video {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
        }

        .tipo-documento {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
        }

        .tipo-presentacion {
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            color: white;
        }

        .tipo-curso {
            background: linear-gradient(45deg, #ffa726, #fb8c00);
            color: white;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .card-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .card-actions {
            padding: 0 2rem 2rem;
        }

        .btn-view {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            width: 100%;
            justify-content: center;
        }

        .btn-view:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            color: white;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            font-size: 5rem;
            color: #e9ecef;
            margin-bottom: 2rem;
        }

        .empty-title {
            font-size: 2rem;
            font-weight: 700;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .empty-description {
            color: #adb5bd;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-create {
            background: linear-gradient(45deg, #56ab2f, #a8e6cf);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .btn-create:hover {
            background: linear-gradient(45deg, #4a9428, #96d9b8);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(86, 171, 47, 0.3);
            color: white;
            text-decoration: none;
        }

        .floating-add {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            font-size: 1.5rem;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .floating-add:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .filter-chip {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .filter-chip:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
            color: white;
            text-decoration: none;
            transform: scale(1.05);
        }

        .filter-chip .remove {
            cursor: pointer;
            opacity: 0.8;
            margin-left: 0.3rem;
        }

        .filter-chip .remove:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .capacitaciones-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stats-container {
                margin-top: -1rem;
                padding: 1.5rem;
            }

            .filters-section {
                padding: 1.5rem;
            }

            .floating-add {
                bottom: 1rem;
                right: 1rem;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.8s ease forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">
                    <i class="fas fa-graduation-cap me-3"></i>
                    Centro de Capacitaciones
                </h1>
                <p class="hero-subtitle">
                    Desarrolla tus habilidades y conocimientos con nuestros recursos de aprendizaje
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Estadísticas -->
        <div class="stats-container fade-in">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon primary">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="stat-number">{{ $capacitaciones->where('tipo', 'video')->count() }}</div>
                        <div class="stat-label">Videos</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon info">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-number">{{ $capacitaciones->where('tipo', 'documento')->count() }}</div>
                        <div class="stat-label">Documentos</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon success">
                            <i class="fas fa-presentation"></i>
                        </div>
                        <div class="stat-number">{{ $capacitaciones->where('tipo', 'presentacion')->count() }}</div>
                        <div class="stat-label">Presentaciones</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon warning">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-number">{{ $capacitaciones->count() }}</div>
                        <div class="stat-label">Total</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="filters-section slide-in">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="search-input"
                            placeholder="Buscar capacitaciones por título o contenido...">
                    </div>
                </div>
                <div class="col-lg-3">
                    <select id="tipoFilter" class="filter-select">
                        <option value="">Todos los tipos</option>
                        <option value="video">Videos</option>
                        <option value="documento">Documentos</option>
                        <option value="presentacion">Presentaciones</option>
                        <option value="curso">Cursos</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select id="ordenFilter" class="filter-select">
                        <option value="reciente">Más recientes</option>
                        <option value="antiguo">Más antiguos</option>
                        <option value="alfabetico">A-Z</option>
                        <option value="tipo">Por tipo</option>
                    </select>
                </div>
            </div>

            <!-- Filtros Activos -->
            <div class="filter-chips" id="activeFilters" style="display: none;">
                <span class="text-muted me-2">Filtros activos:</span>
            </div>
        </div>

        <!-- Grid de Capacitaciones -->
        @if ($capacitaciones->isEmpty())
            <div class="empty-state fade-in">
                <div class="empty-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h2 class="empty-title">No hay capacitaciones disponibles</h2>
                <p class="empty-description">
                    Aún no se han creado capacitaciones en el sistema.<br>
                    ¡Comienza creando tu primera capacitación!
                </p>
                <a href="{{ route('capacitaciones.create') }}" class="btn-create">
                    <i class="fas fa-plus-circle"></i>
                    Crear Primera Capacitación
                </a>
            </div>
        @else
            <div class="capacitaciones-grid" id="capacitacionesGrid">
                @foreach ($capacitaciones as $index => $capacitacion)
                    <div class="capacitacion-card fade-in" style="animation-delay: {{ $index * 0.1 }}s"
                        data-tipo="{{ $capacitacion->tipo }}" data-titulo="{{ strtolower($capacitacion->titulo) }}">

                        <div class="card-header">
                            <span class="tipo-badge tipo-{{ $capacitacion->tipo }}">
                                @switch($capacitacion->tipo)
                                    @case('video')
                                        <i class="fas fa-play me-1"></i>Video
                                    @break

                                    @case('documento')
                                        <i class="fas fa-file-alt me-1"></i>Documento
                                    @break

                                    @case('presentacion')
                                        <i class="fas fa-presentation me-1"></i>Presentación
                                    @break

                                    @case('curso')
                                        <i class="fas fa-book-open me-1"></i>Curso
                                    @break

                                    @default
                                        <i class="fas fa-file me-1"></i>{{ ucfirst($capacitacion->tipo) }}
                                @endswitch
                            </span>

                            <div class="card-icon">
                                @switch($capacitacion->tipo)
                                    @case('video')
                                        <i class="fas fa-play-circle"></i>
                                    @break

                                    @case('documento')
                                        <i class="fas fa-file-alt"></i>
                                    @break

                                    @case('presentacion')
                                        <i class="fas fa-presentation"></i>
                                    @break

                                    @case('curso')
                                        <i class="fas fa-book-open"></i>
                                    @break

                                    @default
                                        <i class="fas fa-graduation-cap"></i>
                                @endswitch
                            </div>

                            <h3 class="card-title">{{ $capacitacion->titulo }}</h3>

                            @if (isset($capacitacion->descripcion))
                                <p class="card-description">{{ Str::limit($capacitacion->descripcion, 120) }}</p>
                            @endif

                            <div class="card-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $capacitacion->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $capacitacion->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('capacitaciones.show', $capacitacion) }}" class="btn-view">
                                <i class="fas fa-eye"></i>
                                Ver Capacitación
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Botón Flotante -->
    @if (!$capacitaciones->isEmpty())
        <button class="floating-add" onclick="window.location.href='{{ route('capacitaciones.create') }}'"
            title="Crear nueva capacitación">
            <i class="fas fa-plus"></i>
        </button>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tipoFilter = document.getElementById('tipoFilter');
            const ordenFilter = document.getElementById('ordenFilter');
            const activeFilters = document.getElementById('activeFilters');
            const capacitacionesGrid = document.getElementById('capacitacionesGrid');

            let capacitaciones = Array.from(document.querySelectorAll('.capacitacion-card'));

            function performFilter() {
                const searchTerm = searchInput.value.toLowerCase();
                const tipoValue = tipoFilter.value;
                const ordenValue = ordenFilter.value;

                let filteredCapacitaciones = capacitaciones.filter(card => {
                    const titulo = card.dataset.titulo;
                    const tipo = card.dataset.tipo;

                    const matchesSearch = !searchTerm || titulo.includes(searchTerm);
                    const matchesTipo = !tipoValue || tipo === tipoValue;

                    return matchesSearch && matchesTipo;
                });

                // Ordenar
                switch (ordenValue) {
                    case 'alfabetico':
                        filteredCapacitaciones.sort((a, b) =>
                            a.dataset.titulo.localeCompare(b.dataset.titulo)
                        );
                        break;
                    case 'tipo':
                        filteredCapacitaciones.sort((a, b) =>
                            a.dataset.tipo.localeCompare(b.dataset.tipo)
                        );
                        break;
                }

                // Mostrar/ocultar cards
                capacitaciones.forEach(card => {
                    card.style.display = 'none';
                });

                filteredCapacitaciones.forEach((card, index) => {
                    card.style.display = 'block';
                    card.style.animationDelay = `${index * 0.1}s`;
                });

                // Mostrar filtros activos
                updateActiveFilters(searchTerm, tipoValue);

                // Mostrar mensaje si no hay resultados
                if (filteredCapacitaciones.length === 0) {
                    showNoResults();
                } else {
                    hideNoResults();
                }
            }

            function updateActiveFilters(searchTerm, tipoValue) {
                let hasActiveFilters = false;
                let filtersHtml = '<span class="text-muted me-2">Filtros activos:</span>';

                if (searchTerm) {
                    filtersHtml +=
                        `<span class="filter-chip">Búsqueda: "${searchTerm}" <span class="remove" onclick="clearSearch()">&times;</span></span>`;
                    hasActiveFilters = true;
                }

                if (tipoValue) {
                    const tipoText = tipoFilter.options[tipoFilter.selectedIndex].text;
                    filtersHtml +=
                        `<span class="filter-chip">Tipo: ${tipoText} <span class="remove" onclick="clearTipo()">&times;</span></span>`;
                    hasActiveFilters = true;
                }

                activeFilters.style.display = hasActiveFilters ? 'flex' : 'none';
                activeFilters.innerHTML = filtersHtml;
            }

            function showNoResults() {
                if (!document.getElementById('noResults')) {
                    const noResults = document.createElement('div');
                    noResults.id = 'noResults';
                    noResults.className = 'empty-state fade-in';
                    noResults.innerHTML = `
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h2 class="empty-title">No se encontraron capacitaciones</h2>
                <p class="empty-description">
                    No hay capacitaciones que coincidan con los filtros seleccionados.<br>
                    Intenta ajustar tus criterios de búsqueda.
                </p>
                <button onclick="clearAllFilters()" class="btn-create">
                    <i class="fas fa-undo"></i>
                    Limpiar Filtros
                </button>
            `;
                    capacitacionesGrid.appendChild(noResults);
                }
            }

            function hideNoResults() {
                const noResults = document.getElementById('noResults');
                if (noResults) {
                    noResults.remove();
                }
            }

            // Event listeners
            searchInput.addEventListener('input', performFilter);
            tipoFilter.addEventListener('change', performFilter);
            ordenFilter.addEventListener('change', performFilter);

            // Funciones globales para los filtros
            window.clearSearch = function() {
                searchInput.value = '';
                performFilter();
            };

            window.clearTipo = function() {
                tipoFilter.value = '';
                performFilter();
            };

            window.clearAllFilters = function() {
                searchInput.value = '';
                tipoFilter.value = '';
                ordenFilter.value = 'reciente';
                performFilter();
            };

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

            document.querySelectorAll('.capacitacion-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
@endpush

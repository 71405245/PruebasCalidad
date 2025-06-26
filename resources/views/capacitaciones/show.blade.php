@extends('layouts.app')

@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: rotate(15deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .content-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .content-header {
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            padding: 2rem;
            border-bottom: 2px solid #e9ecef;
            position: relative;
        }

        .tipo-badge {
            position: absolute;
            top: 2rem;
            right: 2rem;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        .content-icon {
            width: 100px;
            height: 100px;
            border-radius: 25px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .content-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .content-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.95rem;
        }

        .meta-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            border: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
        }

        .content-body {
            padding: 2rem;
        }

        .description-section {
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 4px solid #667eea;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }

        .description-text {
            color: #6c757d;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        .content-viewer {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            border: 2px solid #e9ecef;
        }

        .viewer-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .viewer-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .viewer-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-action {
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

        .progress-section {
            background: linear-gradient(145deg, #f8f9ff, #ffffff);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 2px solid #e9ecef;
        }

        .progress-bar-custom {
            height: 12px;
            border-radius: 6px;
            background: #e9ecef;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 6px;
            transition: width 0.3s ease;
        }

        .progress-text {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .video-player {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .document-embed {
            width: 100%;
            height: 600px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .content-title {
                font-size: 2rem;
            }

            .content-meta {
                gap: 1rem;
            }

            .viewer-actions {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .action-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .tipo-badge {
                position: static;
                margin-bottom: 1rem;
                align-self: flex-start;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-eye me-3"></i>
                            Visualizar Capacitación
                        </h1>
                        <p class="lead mb-0">
                            Contenido educativo para el desarrollo profesional
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('capacitaciones.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>
                            Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-container fade-in">
            <div class="content-header">
                <span class="tipo-badge tipo-{{ $capacitacion->tipo }}">
                    @switch($capacitacion->tipo)
                        @case('video')
                            <i class="fas fa-play"></i>Video
                        @break

                        @case('documento')
                            <i class="fas fa-file-alt"></i>Documento
                        @break

                        @case('presentacion')
                            <i class="fas fa-presentation"></i>Presentación
                        @break

                        @case('curso')
                            <i class="fas fa-book-open"></i>Curso
                        @break

                        @default
                            <i class="fas fa-file"></i>{{ ucfirst($capacitacion->tipo) }}
                    @endswitch
                </span>

                <div class="content-icon">
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

                <h1 class="content-title">{{ $capacitacion->titulo }}</h1>

                <div class="content-meta">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <strong>Creado:</strong><br>
                            {{ $capacitacion->created_at ? $capacitacion->created_at->format('d/m/Y H:i') : 'No disponible' }}
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <strong>Actualizado:</strong><br>
                            {{ $capacitacion->updated_at ? $capacitacion->updated_at->diffForHumans() : 'No disponible' }}
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <strong>Autor:</strong><br>
                            {{ $capacitacion->autor ?? 'Sistema' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                @if ($capacitacion->descripcion)
                    <div class="description-section">
                        <h3 class="section-title">
                            <i class="fas fa-info-circle"></i>
                            Descripción
                        </h3>
                        <p class="description-text">{{ $capacitacion->descripcion }}</p>
                    </div>
                @endif

                <!-- Progreso (simulado) -->
                <div class="progress-section">
                    <h3 class="section-title">
                        <i class="fas fa-chart-line"></i>
                        Progreso de Aprendizaje
                    </h3>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: 0%" id="progressBar"></div>
                    </div>
                    <div class="progress-text">
                        <span>Progreso completado</span>
                        <span id="progressPercent">0%</span>
                    </div>
                </div>

                <!-- Visor de Contenido -->
                <div class="content-viewer">
                    @if ($capacitacion->archivo)
                        @php
                            $extension = pathinfo($capacitacion->archivo, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($extension, ['mp4', 'avi', 'mov']))
                            <div class="viewer-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <h4 class="viewer-title">Contenido de Video</h4>
                            <video class="video-player" controls>
                                <source src="{{ asset('storage/' . $capacitacion->archivo) }}"
                                    type="video/{{ $extension }}">
                                Tu navegador no soporta el elemento de video.
                            </video>
                        @elseif($extension === 'pdf')
                            <div class="viewer-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h4 class="viewer-title">Documento PDF</h4>
                            <iframe class="document-embed" src="{{ asset('storage/' . $capacitacion->archivo) }}"
                                title="Documento PDF">
                            </iframe>
                        @else
                            <div class="viewer-icon">
                                <i class="fas fa-download"></i>
                            </div>
                            <h4 class="viewer-title">Archivo de Capacitación</h4>
                            <p class="text-muted mb-3">
                                Archivo: {{ basename($capacitacion->archivo) }}<br>
                                Tipo: {{ strtoupper($extension) }}
                            </p>
                        @endif

                        <div class="viewer-actions">
                            <a href="{{ asset('storage/' . $capacitacion->archivo) }}"
                                class="btn-action btn-primary-custom" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                Abrir en Nueva Pestaña
                            </a>
                            <a href="{{ asset('storage/' . $capacitacion->archivo) }}"
                                class="btn-action btn-success-custom" download>
                                <i class="fas fa-download"></i>
                                Descargar Archivo
                            </a>
                        </div>
                    @elseif($capacitacion->url)
                        <div class="viewer-icon">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                        <h4 class="viewer-title">Contenido en Línea</h4>
                        <p class="text-muted mb-3">Este contenido se encuentra disponible en un enlace externo</p>
                        <div class="viewer-actions">
                            <a href="{{ $capacitacion->url }}" class="btn-action btn-primary-custom" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                Acceder al Contenido
                            </a>
                        </div>
                    @else
                        <div class="viewer-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h4 class="viewer-title">Contenido No Disponible</h4>
                        <p class="text-muted">No se ha proporcionado contenido para esta capacitación.</p>
                    @endif
                </div>
            </div>

            <div class="action-buttons">
                <div class="d-flex gap-2">
                    <a href="{{ route('capacitaciones.index') }}" class="btn-action btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
                <div class="d-flex gap-2">
                    <a href="/capacitaciones/{{ $capacitacion->id }}/edit" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <button type="button" class="btn-action btn-success-custom" onclick="markAsCompleted()">
                        <i class="fas fa-check-circle"></i>
                        Marcar como Completado
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simular progreso de aprendizaje
            let progress = localStorage.getItem('capacitacion_{{ $capacitacion->id }}_progress') || 0;
            updateProgress(progress);

            // Detectar interacción con el contenido
            const video = document.querySelector('video');
            const iframe = document.querySelector('iframe');

            if (video) {
                video.addEventListener('timeupdate', function() {
                    const progress = (video.currentTime / video.duration) * 100;
                    updateProgress(Math.round(progress));
                });

                video.addEventListener('ended', function() {
                    updateProgress(100);
                    showCompletionMessage();
                });
            }

            if (iframe) {
                // Simular progreso para documentos
                let viewTime = 0;
                const interval = setInterval(() => {
                    viewTime += 1;
                    const progress = Math.min((viewTime / 30) * 100, 100); // 30 segundos = 100%
                    updateProgress(Math.round(progress));

                    if (progress >= 100) {
                        clearInterval(interval);
                        showCompletionMessage();
                    }
                }, 1000);
            }
        });

        function updateProgress(percent) {
            const progressBar = document.getElementById('progressBar');
            const progressPercent = document.getElementById('progressPercent');

            if (progressBar && progressPercent) {
                progressBar.style.width = percent + '%';
                progressPercent.textContent = percent + '%';

                // Guardar progreso
                localStorage.setItem('capacitacion_{{ $capacitacion->id }}_progress', percent);
            }
        }

        function markAsCompleted() {
            updateProgress(100);
            showCompletionMessage();

            // Aquí podrías hacer una llamada AJAX para guardar el progreso en el servidor
            // fetch('/capacitaciones/{{ $capacitacion->id }}/complete', { method: 'POST' })
        }

        function showCompletionMessage() {
            // Mostrar mensaje de felicitación
            const message = document.createElement('div');
            message.className = 'alert alert-success alert-dismissible fade show';
            message.innerHTML = `
        <i class="fas fa-trophy me-2"></i>
        <strong>¡Felicitaciones!</strong> Has completado esta capacitación.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

            const container = document.querySelector('.container');
            container.insertBefore(message, container.firstChild);

            // Auto-dismiss después de 5 segundos
            setTimeout(() => {
                if (message.parentNode) {
                    message.remove();
                }
            }, 5000);
        }
    </script>
@endpush

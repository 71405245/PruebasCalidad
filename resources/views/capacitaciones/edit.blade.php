@extends('layouts.app')

@push('styles')
<<<<<<< HEAD
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: rotate(15deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .form-header {
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            padding: 2rem;
            border-bottom: 2px solid #e9ecef;
            position: relative;
        }

        .current-type-badge {
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

        .form-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .form-subtitle {
            color: #6c757d;
            margin-bottom: 0;
        }

        .form-body {
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            border-radius: 15px;
            border-left: 4px solid #667eea;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.1rem;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating>.form-control,
        .form-floating>.form-select {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .form-floating>.form-control:focus,
        .form-floating>.form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            transform: translateY(-1px);
        }

        .form-floating>label {
            color: #6c757d;
            font-weight: 500;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            z-index: 10;
            pointer-events: none;
        }

        .current-file-display {
            background: linear-gradient(145deg, #f8f9ff, #ffffff);
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .current-file-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .file-icon-large {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .file-details h6 {
            margin: 0;
            color: #2c3e50;
            font-weight: 600;
        }

        .file-details small {
            color: #6c757d;
        }

        .file-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-file {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-view {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
        }

        .btn-view:hover {
            background: linear-gradient(45deg, #3d8bfe, #00d4fe);
            color: white;
            text-decoration: none;
        }

        .btn-download {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
        }

        .btn-download:hover {
            background: linear-gradient(45deg, #218838, #1ea080);
            color: white;
            text-decoration: none;
        }

        .file-upload-area {
            border: 3px dashed #667eea;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            background: linear-gradient(145deg, #f8f9ff, #ffffff);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .file-upload-area:hover {
            border-color: #5a6fd8;
            background: linear-gradient(145deg, #f0f2ff, #f8f9ff);
            transform: scale(1.02);
        }

        .file-upload-area.dragover {
            border-color: #28a745;
            background: linear-gradient(145deg, #f8fff9, #ffffff);
        }

        .upload-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .upload-text {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .upload-hint {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .file-preview {
            margin-top: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            display: none;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .file-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tipo-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .tipo-option {
            position: relative;
        }

        .tipo-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .tipo-card {
            padding: 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .tipo-card:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .tipo-option input[type="radio"]:checked+.tipo-card {
            border-color: #667eea;
            background: linear-gradient(145deg, #f8f9ff, #ffffff);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        }

        .tipo-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #667eea;
        }

        .tipo-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .tipo-description {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .form-actions {
            background: #f8f9fa;
            padding: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            border-top: 2px solid #e9ecef;
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
        }

        .required-field::after {
            content: '*';
            color: #dc3545;
            font-weight: bold;
            margin-left: 4px;
        }

        .form-help {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .form-body {
                padding: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .tipo-selector {
                grid-template-columns: 1fr;
            }

            .current-type-badge {
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
                                <i class="fas fa-edit me-3"></i>
                                Editar Capacitación
                            </h1>
                            <p class="lead mb-0">
                                Actualiza el contenido educativo existente
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="{{ route('capacitaciones.show', $capacitacion) }}" class="btn btn-light btn-lg">
                                <i class="fas fa-eye me-2"></i>
                                Ver Capacitación
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <form action="{{ route('capacitaciones.update', $capacitacion) }}" method="POST" enctype="multipart/form-data"
                id="capacitacionForm">
                @csrf
                @method('PUT')

                <div class="form-container fade-in">
                    <div class="form-header">
                        <span class="current-type-badge tipo-{{ $capacitacion->tipo }}">
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

                        <h2 class="form-title">
                            <i class="fas fa-graduation-cap"></i>
                            Editar Capacitación
                        </h2>
                        <p class="form-subtitle">Actualiza la información de la capacitación existente</p>
                    </div>

                    <div class="form-body">
                        <!-- Información Básica -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Información Básica
                            </h3>

                            <div class="form-floating">
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror"
                                    id="titulo" name="titulo" value="{{ old('titulo', $capacitacion->titulo) }}"
                                    placeholder="Título de la capacitación" required>
                                <label for="titulo" class="required-field">Título de la Capacitación</label>
                                <i class="fas fa-heading input-icon"></i>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-help">
                                <i class="fas fa-lightbulb"></i>
                                <span>Usa un título claro y descriptivo que indique el tema principal</span>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                                    style="height: 120px" placeholder="Descripción detallada">{{ old('descripcion', $capacitacion->descripcion) }}</textarea>
                                <label for="descripcion">Descripción</label>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-help">
                                <i class="fas fa-pen"></i>
                                <span>Describe los objetivos y contenido de la capacitación</span>
                            </div>
                        </div>

                        <!-- Tipo de Capacitación -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-layer-group"></i>
                                Tipo de Capacitación
                            </h3>

                            <div class="tipo-selector">
                                <div class="tipo-option">
                                    <input type="radio" id="tipo_video" name="tipo" value="video"
                                        {{ old('tipo', $capacitacion->tipo) == 'video' ? 'checked' : '' }} required>
                                    <label for="tipo_video" class="tipo-card">
                                        <div class="tipo-icon">
                                            <i class="fas fa-play-circle"></i>
                                        </div>
                                        <div class="tipo-title">Video</div>
                                        <div class="tipo-description">Contenido audiovisual educativo</div>
                                    </label>
                                </div>

                                <div class="tipo-option">
                                    <input type="radio" id="tipo_documento" name="tipo" value="documento"
                                        {{ old('tipo', $capacitacion->tipo) == 'documento' ? 'checked' : '' }}>
                                    <label for="tipo_documento" class="tipo-card">
                                        <div class="tipo-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="tipo-title">Documento</div>
                                        <div class="tipo-description">PDF, Word, o texto informativo</div>
                                    </label>
                                </div>

                                <div class="tipo-option">
                                    <input type="radio" id="tipo_presentacion" name="tipo" value="presentacion"
                                        {{ old('tipo', $capacitacion->tipo) == 'presentacion' ? 'checked' : '' }}>
                                    <label for="tipo_presentacion" class="tipo-card">
                                        <div class="tipo-icon">
                                            <i class="fas fa-presentation"></i>
                                        </div>
                                        <div class="tipo-title">Presentación</div>
                                        <div class="tipo-description">Slides o diapositivas</div>
                                    </label>
                                </div>

                                <div class="tipo-option">
                                    <input type="radio" id="tipo_curso" name="tipo" value="curso"
                                        {{ old('tipo', $capacitacion->tipo) == 'curso' ? 'checked' : '' }}>
                                    <label for="tipo_curso" class="tipo-card">
                                        <div class="tipo-icon">
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                        <div class="tipo-title">Curso</div>
                                        <div class="tipo-description">Contenido estructurado completo</div>
                                    </label>
                                </div>
                            </div>
                            @error('tipo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Archivo Actual -->
                        @if ($capacitacion->archivo)
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-file-check"></i>
                                    Archivo Actual
                                </h3>

                                <div class="current-file-display">
                                    <div class="current-file-info">
                                        <div class="file-icon-large">
                                            @php
                                                $extension = pathinfo($capacitacion->archivo, PATHINFO_EXTENSION);
                                            @endphp
                                            @switch($extension)
                                                @case('pdf')
                                                    <i class="fas fa-file-pdf"></i>
                                                @break

                                                @case('doc')
                                                @case('docx')
                                                    <i class="fas fa-file-word"></i>
                                                @break

                                                @case('ppt')
                                                @case('pptx')
                                                    <i class="fas fa-file-powerpoint"></i>
                                                @break

                                                @case('mp4')
                                                @case('avi')

                                                @case('mov')
                                                    <i class="fas fa-file-video"></i>
                                                @break

                                                @default
                                                    <i class="fas fa-file"></i>
                                            @endswitch
                                        </div>
                                        <div class="file-details">
                                            <h6>{{ basename($capacitacion->archivo) }}</h6>
                                            <small>Tipo: {{ strtoupper($extension) }} | Subido:
                                                {{ $capacitacion->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <div class="file-actions">
                                        <a href="{{ asset('storage/' . $capacitacion->archivo) }}"
                                            class="btn-file btn-view" target="_blank">
                                            <i class="fas fa-eye"></i>
                                            Ver
                                        </a>
                                        <a href="{{ asset('storage/' . $capacitacion->archivo) }}"
                                            class="btn-file btn-download" download>
                                            <i class="fas fa-download"></i>
                                            Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Nuevo Contenido/Archivo -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-upload"></i>
                                {{ $capacitacion->archivo ? 'Reemplazar Archivo' : 'Subir Nuevo Archivo' }}
                            </h3>

                            <div class="file-upload-area" onclick="document.getElementById('archivo').click()">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="upload-text">
                                    {{ $capacitacion->archivo ? 'Subir Nuevo Archivo (Opcional)' : 'Subir Archivo de Capacitación' }}
                                </div>
                                <div class="upload-hint">
                                    Arrastra y suelta o haz clic para seleccionar<br>
                                    <small>Formatos: PDF, DOC, DOCX, PPT, PPTX, MP4, AVI (Max: 50MB)</small>
                                    @if ($capacitacion->archivo)
                                        <br><small class="text-muted">Deja vacío para mantener el archivo actual</small>
                                    @endif
                                </div>
                            </div>

                            <input type="file" class="d-none @error('archivo') is-invalid @enderror" id="archivo"
                                name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.avi,.mov">

                            <div class="file-preview" id="filePreview">
                                <div class="file-info">
                                    <div class="file-icon">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <div class="file-details">
                                        <h6 id="fileName"></h6>
                                        <small id="fileSize"></small>
                                    </div>
                                </div>
                            </div>

                            @error('archivo')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-help mt-3">
                                <i class="fas fa-info"></i>
                                <span>
                                    {{ $capacitacion->archivo ? 'Solo sube un archivo si deseas reemplazar el actual' : 'El archivo será el contenido principal de la capacitación' }}
                                </span>
                            </div>
                        </div>

                        <!-- URL Alternativa -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-link"></i>
                                Enlace Alternativo (Opcional)
                            </h3>

                            <div class="form-floating">
                                <input type="url" class="form-control @error('url') is-invalid @enderror"
                                    id="url" name="url" value="{{ old('url', $capacitacion->url) }}"
                                    placeholder="https://ejemplo.com">
                                <label for="url">URL del Contenido</label>
                                <i class="fas fa-external-link-alt input-icon"></i>
                                @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-help">
                                <i class="fas fa-globe"></i>
                                <span>Si el contenido está en línea, proporciona el enlace directo</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="d-flex gap-2">
                            <a href="{{ route('capacitaciones.show', $capacitacion) }}"
                                class="btn-custom btn-secondary-custom">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </a>
                            <button type="button" class="btn-custom btn-danger-custom" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i>
                                Eliminar
                            </button>
                        </div>
                        <button type="submit" class="btn-custom btn-primary-custom">
                            <i class="fas fa-save"></i>
                            Actualizar Capacitación
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal de Confirmación de Eliminación -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 20px; border: none;">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="deleteModalLabel">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            Confirmar Eliminación
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <p class="mb-2">¿Estás seguro de que deseas eliminar la capacitación:</p>
                        <p class="fw-bold text-primary mb-2">"{{ $capacitacion->titulo }}"</p>
                        <small class="text-muted">Esta acción no se puede deshacer y se perderá todo el contenido
                            asociado.</small>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                        <form action="{{ route('capacitaciones.destroy', $capacitacion) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i>Eliminar Capacitación
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('archivo');
                const filePreview = document.getElementById('filePreview');
                const uploadArea = document.querySelector('.file-upload-area');

                // Manejo de archivos
                fileInput.addEventListener('change', function(e) {
                    handleFile(e.target.files[0]);
                });

                // Drag and drop
                uploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });

                uploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                });

                uploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');

                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files;
                        handleFile(files[0]);
                    }
                });

                function handleFile(file) {
                    if (file) {
                        document.getElementById('fileName').textContent = file.name;
                        document.getElementById('fileSize').textContent = formatFileSize(file.size);
                        filePreview.style.display = 'block';

                        // Cambiar icono según tipo de archivo
                        const fileIcon = document.querySelector('.file-icon i');
                        const extension = file.name.split('.').pop().toLowerCase();

                        switch (extension) {
                            case 'pdf':
                                fileIcon.className = 'fas fa-file-pdf';
                                break;
                            case 'doc':
                            case 'docx':
                                fileIcon.className = 'fas fa-file-word';
                                break;
                            case 'ppt':
                            case 'pptx':
                                fileIcon.className = 'fas fa-file-powerpoint';
                                break;
                            case 'mp4':
                            case 'avi':
                            case 'mov':
                                fileIcon.className = 'fas fa-file-video';
                                break;
                            default:
                                fileIcon.className = 'fas fa-file';
                        }
                    }
                }

                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }

                // Validación del formulario
                document.getElementById('capacitacionForm').addEventListener('submit', function(e) {
                    const titulo = document.getElementById('titulo').value.trim();
                    const tipo = document.querySelector('input[name="tipo"]:checked');

                    if (!titulo) {
                        e.preventDefault();
                        alert('Por favor, ingresa un título para la capacitación.');
                        return;
                    }

                    if (!tipo) {
                        e.preventDefault();
                        alert('Por favor, selecciona un tipo de capacitación.');
                        return;
                    }
                });
            });

            function confirmDelete() {
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            }
        </script>
    @endpush
=======
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
    
    .form-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .form-header {
        background: linear-gradient(45deg, #f8f9fa, #ffffff);
        padding: 2rem;
        border-bottom: 2px solid #e9ecef;
        position: relative;
    }
    
    .current-type-badge {
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
    
    .form-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .form-subtitle {
        color: #6c757d;
        margin-bottom: 0;
    }
    
    .form-body {
        padding: 2rem;
    }
    
    .form-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: linear-gradient(145deg, #f8f9fa, #ffffff);
        border-radius: 15px;
        border-left: 4px solid #667eea;
    }
    
    .section-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.1rem;
    }
    
    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating > .form-control,
    .form-floating > .form-select {
        height: calc(3.5rem + 2px);
        line-height: 1.25;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .form-floating > .form-control:focus,
    .form-floating > .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
        transform: translateY(-1px);
    }
    
    .form-floating > label {
        color: #6c757d;
        font-weight: 500;
    }
    
    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        z-index: 10;
        pointer-events: none;
    }
    
    .current-file-display {
        background: linear-gradient(145deg, #f8f9ff, #ffffff);
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .current-file-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .file-icon-large {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .file-details h6 {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .file-details small {
        color: #6c757d;
    }
    
    .file-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .btn-file {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .btn-view {
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        color: white;
    }
    
    .btn-view:hover {
        background: linear-gradient(45deg, #3d8bfe, #00d4fe);
        color: white;
        text-decoration: none;
    }
    
    .btn-download {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
    }
    
    .btn-download:hover {
        background: linear-gradient(45deg, #218838, #1ea080);
        color: white;
        text-decoration: none;
    }
    
    .file-upload-area {
        border: 3px dashed #667eea;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        background: linear-gradient(145deg, #f8f9ff, #ffffff);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .file-upload-area:hover {
        border-color: #5a6fd8;
        background: linear-gradient(145deg, #f0f2ff, #f8f9ff);
        transform: scale(1.02);
    }
    
    .file-upload-area.dragover {
        border-color: #28a745;
        background: linear-gradient(145deg, #f8fff9, #ffffff);
    }
    
    .upload-icon {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 1rem;
    }
    
    .upload-text {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .upload-hint {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .file-preview {
        margin-top: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        display: none;
    }
    
    .file-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .file-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .tipo-selector {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .tipo-option {
        position: relative;
    }
    
    .tipo-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .tipo-card {
        padding: 1.5rem;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }
    
    .tipo-card:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
    }
    
    .tipo-option input[type="radio"]:checked + .tipo-card {
        border-color: #667eea;
        background: linear-gradient(145deg, #f8f9ff, #ffffff);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
    }
    
    .tipo-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #667eea;
    }
    
    .tipo-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .tipo-description {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .form-actions {
        background: #f8f9fa;
        padding: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        border-top: 2px solid #e9ecef;
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
    }
    
    .required-field::after {
        content: '*';
        color: #dc3545;
        font-weight: bold;
        margin-left: 4px;
    }
    
    .form-help {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .form-body {
            padding: 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn-custom {
            width: 100%;
            justify-content: center;
        }
        
        .tipo-selector {
            grid-template-columns: 1fr;
        }
        
        .current-type-badge {
            position: static;
            margin-bottom: 1rem;
            align-self: flex-start;
        }
    }
    
    .fade-in {
        animation: fadeIn 0.6s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
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
                        <i class="fas fa-edit me-3"></i>
                        Editar Capacitación
                    </h1>
                    <p class="lead mb-0">
                        Actualiza el contenido educativo existente
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('capacitaciones.show', $capacitacion) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-eye me-2"></i>
                        Ver Capacitación
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <form action="{{ route('capacitaciones.update', $capacitacion) }}" method="POST" enctype="multipart/form-data" id="capacitacionForm">
        @csrf
        @method('PUT')
        
        <div class="form-container fade-in">
            <div class="form-header">
                <span class="current-type-badge tipo-{{ $capacitacion->tipo }}">
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
                
                <h2 class="form-title">
                    <i class="fas fa-graduation-cap"></i>
                    Editar Capacitación
                </h2>
                <p class="form-subtitle">Actualiza la información de la capacitación existente</p>
            </div>
            
            <div class="form-body">
                <!-- Información Básica -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Información Básica
                    </h3>
                    
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" 
                               name="titulo"
                               value="{{ old('titulo', $capacitacion->titulo) }}" 
                               placeholder="Título de la capacitación"
                               required>
                        <label for="titulo" class="required-field">Título de la Capacitación</label>
                        <i class="fas fa-heading input-icon"></i>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-help">
                        <i class="fas fa-lightbulb"></i>
                        <span>Usa un título claro y descriptivo que indique el tema principal</span>
                    </div>
                    
                    <div class="form-floating">
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  style="height: 120px"
                                  placeholder="Descripción detallada">{{ old('descripcion', $capacitacion->descripcion) }}</textarea>
                        <label for="descripcion">Descripción</label>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-help">
                        <i class="fas fa-pen"></i>
                        <span>Describe los objetivos y contenido de la capacitación</span>
                    </div>
                </div>

                <!-- Tipo de Capacitación -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-layer-group"></i>
                        Tipo de Capacitación
                    </h3>
                    
                    <div class="tipo-selector">
                        <div class="tipo-option">
                            <input type="radio" id="tipo_video" name="tipo" value="video" 
                                   {{ old('tipo', $capacitacion->tipo) == 'video' ? 'checked' : '' }} required>
                            <label for="tipo_video" class="tipo-card">
                                <div class="tipo-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <div class="tipo-title">Video</div>
                                <div class="tipo-description">Contenido audiovisual educativo</div>
                            </label>
                        </div>
                        
                        <div class="tipo-option">
                            <input type="radio" id="tipo_documento" name="tipo" value="documento" 
                                   {{ old('tipo', $capacitacion->tipo) == 'documento' ? 'checked' : '' }}>
                            <label for="tipo_documento" class="tipo-card">
                                <div class="tipo-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="tipo-title">Documento</div>
                                <div class="tipo-description">PDF, Word, o texto informativo</div>
                            </label>
                        </div>
                        
                        <div class="tipo-option">
                            <input type="radio" id="tipo_presentacion" name="tipo" value="presentacion" 
                                   {{ old('tipo', $capacitacion->tipo) == 'presentacion' ? 'checked' : '' }}>
                            <label for="tipo_presentacion" class="tipo-card">
                                <div class="tipo-icon">
                                    <i class="fas fa-presentation"></i>
                                </div>
                                <div class="tipo-title">Presentación</div>
                                <div class="tipo-description">Slides o diapositivas</div>
                            </label>
                        </div>
                        
                        <div class="tipo-option">
                            <input type="radio" id="tipo_curso" name="tipo" value="curso" 
                                   {{ old('tipo', $capacitacion->tipo) == 'curso' ? 'checked' : '' }}>
                            <label for="tipo_curso" class="tipo-card">
                                <div class="tipo-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="tipo-title">Curso</div>
                                <div class="tipo-description">Contenido estructurado completo</div>
                            </label>
                        </div>
                    </div>
                    @error('tipo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Archivo Actual -->
                @if($capacitacion->archivo)
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-file-check"></i>
                            Archivo Actual
                        </h3>
                        
                        <div class="current-file-display">
                            <div class="current-file-info">
                                <div class="file-icon-large">
                                    @php
                                        $extension = pathinfo($capacitacion->archivo, PATHINFO_EXTENSION);
                                    @endphp
                                    @switch($extension)
                                        @case('pdf')
                                            <i class="fas fa-file-pdf"></i>
                                            @break
                                        @case('doc')
                                        @case('docx')
                                            <i class="fas fa-file-word"></i>
                                            @break
                                        @case('ppt')
                                        @case('pptx')
                                            <i class="fas fa-file-powerpoint"></i>
                                            @break
                                        @case('mp4')
                                        @case('avi')
                                        @case('mov')
                                            <i class="fas fa-file-video"></i>
                                            @break
                                        @default
                                            <i class="fas fa-file"></i>
                                    @endswitch
                                </div>
                                <div class="file-details">
                                    <h6>{{ basename($capacitacion->archivo) }}</h6>
                                    <small>Tipo: {{ strtoupper($extension) }} | Subido: {{ $capacitacion->updated_at->format('d/m/Y H:i') }}</small>
                                </div>
                            </div>
                            <div class="file-actions">
                                <a href="{{ asset('storage/' . $capacitacion->archivo) }}" 
                                   class="btn-file btn-view" 
                                   target="_blank">
                                    <i class="fas fa-eye"></i>
                                    Ver
                                </a>
                                <a href="{{ asset('storage/' . $capacitacion->archivo) }}" 
                                   class="btn-file btn-download" 
                                   download>
                                    <i class="fas fa-download"></i>
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Nuevo Contenido/Archivo -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-upload"></i>
                        {{ $capacitacion->archivo ? 'Reemplazar Archivo' : 'Subir Nuevo Archivo' }}
                    </h3>
                    
                    <div class="file-upload-area" onclick="document.getElementById('archivo').click()">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">
                            {{ $capacitacion->archivo ? 'Subir Nuevo Archivo (Opcional)' : 'Subir Archivo de Capacitación' }}
                        </div>
                        <div class="upload-hint">
                            Arrastra y suelta o haz clic para seleccionar<br>
                            <small>Formatos: PDF, DOC, DOCX, PPT, PPTX, MP4, AVI (Max: 50MB)</small>
                            @if($capacitacion->archivo)
                                <br><small class="text-muted">Deja vacío para mantener el archivo actual</small>
                            @endif
                        </div>
                    </div>
                    
                    <input type="file" 
                           class="d-none @error('archivo') is-invalid @enderror" 
                           id="archivo" 
                           name="archivo"
                           accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.avi,.mov">
                    
                    <div class="file-preview" id="filePreview">
                        <div class="file-info">
                            <div class="file-icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <div class="file-details">
                                <h6 id="fileName"></h6>
                                <small id="fileSize"></small>
                            </div>
                        </div>
                    </div>
                    
                    @error('archivo')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-help mt-3">
                        <i class="fas fa-info"></i>
                        <span>
                            {{ $capacitacion->archivo ? 'Solo sube un archivo si deseas reemplazar el actual' : 'El archivo será el contenido principal de la capacitación' }}
                        </span>
                    </div>
                </div>

                <!-- URL Alternativa -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-link"></i>
                        Enlace Alternativo (Opcional)
                    </h3>
                    
                    <div class="form-floating">
                        <input type="url" 
                               class="form-control @error('url') is-invalid @enderror" 
                               id="url" 
                               name="url"
                               value="{{ old('url', $capacitacion->url) }}" 
                               placeholder="https://ejemplo.com">
                        <label for="url">URL del Contenido</label>
                        <i class="fas fa-external-link-alt input-icon"></i>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-help">
                        <i class="fas fa-globe"></i>
                        <span>Si el contenido está en línea, proporciona el enlace directo</span>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <div class="d-flex gap-2">
                    <a href="{{ route('capacitaciones.show', $capacitacion) }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>
                    <button type="button" 
                            class="btn-custom btn-danger-custom" 
                            onclick="confirmDelete()">
                        <i class="fas fa-trash"></i>
                        Eliminar
                    </button>
                </div>
                <button type="submit" class="btn-custom btn-primary-custom">
                    <i class="fas fa-save"></i>
                    Actualizar Capacitación
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="mb-2">¿Estás seguro de que deseas eliminar la capacitación:</p>
                <p class="fw-bold text-primary mb-2">"{{ $capacitacion->titulo }}"</p>
                <small class="text-muted">Esta acción no se puede deshacer y se perderá todo el contenido asociado.</small>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form action="{{ route('capacitaciones.destroy', $capacitacion) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Eliminar Capacitación
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('archivo');
    const filePreview = document.getElementById('filePreview');
    const uploadArea = document.querySelector('.file-upload-area');
    
    // Manejo de archivos
    fileInput.addEventListener('change', function(e) {
        handleFile(e.target.files[0]);
    });
    
    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFile(files[0]);
        }
    });
    
    function handleFile(file) {
        if (file) {
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileSize').textContent = formatFileSize(file.size);
            filePreview.style.display = 'block';
            
            // Cambiar icono según tipo de archivo
            const fileIcon = document.querySelector('.file-icon i');
            const extension = file.name.split('.').pop().toLowerCase();
            
            switch(extension) {
                case 'pdf':
                    fileIcon.className = 'fas fa-file-pdf';
                    break;
                case 'doc':
                case 'docx':
                    fileIcon.className = 'fas fa-file-word';
                    break;
                case 'ppt':
                case 'pptx':
                    fileIcon.className = 'fas fa-file-powerpoint';
                    break;
                case 'mp4':
                case 'avi':
                case 'mov':
                    fileIcon.className = 'fas fa-file-video';
                    break;
                default:
                    fileIcon.className = 'fas fa-file';
            }
        }
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Validación del formulario
    document.getElementById('capacitacionForm').addEventListener('submit', function(e) {
        const titulo = document.getElementById('titulo').value.trim();
        const tipo = document.querySelector('input[name="tipo"]:checked');
        
        if (!titulo) {
            e.preventDefault();
            alert('Por favor, ingresa un título para la capacitación.');
            return;
        }
        
        if (!tipo) {
            e.preventDefault();
            alert('Por favor, selecciona un tipo de capacitación.');
            return;
        }
    });
});

function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
>>>>>>> 2350b95 (código 7)

@push('styles')
<style>
    .form-section {
        background: linear-gradient(145deg, #f8f9fa, #ffffff);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .form-section:hover {
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .section-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #dc3545;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(45deg, #dc3545, #c82333);
        border-radius: 2px;
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
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15);
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
        color: #dc3545;
        z-index: 10;
        pointer-events: none;
    }
    
    .price-input {
        background: linear-gradient(145deg, #fff5f5, #ffffff);
    }
    
    .stock-indicator {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.8rem;
        font-weight: bold;
        padding: 2px 8px;
        border-radius: 12px;
        z-index: 10;
    }
    
    .stock-low { background: #ffeaa7; color: #d63031; }
    .stock-medium { background: #fdcb6e; color: #e17055; }
    .stock-high { background: #55a3ff; color: #0984e3; }
    
    .image-upload-area {
        border: 3px dashed #dc3545;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        background: linear-gradient(145deg, #fff5f5, #ffffff);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .image-upload-area:hover {
        border-color: #c82333;
        background: linear-gradient(145deg, #ffebee, #fff5f5);
        transform: scale(1.02);
    }
    
    .image-upload-area.dragover {
        border-color: #28a745;
        background: linear-gradient(145deg, #f8fff9, #ffffff);
    }
    
    .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .image-preview-item {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .image-preview-item:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .remove-image:hover {
        background: #c82333;
        transform: scale(1.1);
    }
    
    .custom-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-right: 1rem;
    }
    
    .custom-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #ccc;
        transition: 0.4s;
        border-radius: 34px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background: white;
        transition: 0.4s;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    input:checked + .slider {
        background: linear-gradient(45deg, #dc3545, #c82333);
    }
    
    input:checked + .slider:before {
        transform: translateX(26px);
    }
    
    .feature-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: linear-gradient(45deg, #f8f9fa, #ffffff);
        border: 2px solid #e9ecef;
        border-radius: 25px;
        margin: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .feature-badge.active {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
        border-color: #dc3545;
        transform: scale(1.05);
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
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .form-section {
        animation: slideInUp 0.6s ease forwards;
    }
    
    .form-section:nth-child(2) { animation-delay: 0.1s; }
    .form-section:nth-child(3) { animation-delay: 0.2s; }
    .form-section:nth-child(4) { animation-delay: 0.3s; }
    
    @media (max-width: 768px) {
        .form-section {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.25rem;
        }
    }
</style>
@endpush

<div class="container-fluid">
    <!-- Sección: Información Básica -->
    <div class="form-section">
        <h4 class="section-title">
            <i class="fas fa-info-circle me-2"></i>
            Información Básica
        </h4>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control" 
                           id="nombre" 
                           name="nombre"
                           value="{{ old('nombre', $producto->nombre ?? '') }}" 
                           placeholder="Nombre del producto"
                           required>
                    <label for="nombre" class="required-field">Nombre del Producto</label>
                    <i class="fas fa-tag input-icon"></i>
                </div>
                <div class="form-help">
                    <i class="fas fa-lightbulb"></i>
                    <span>Usa un nombre descriptivo y atractivo</span>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control" 
                           id="sku" 
                           name="sku"
                           value="{{ old('sku', $producto->sku ?? '') }}" 
                           placeholder="SKU/Código"
                           required>
                    <label for="sku" class="required-field">SKU/Código</label>
                    <i class="fas fa-barcode input-icon"></i>
                </div>
                <div class="form-help">
                    <i class="fas fa-info"></i>
                    <span>Código único para identificar el producto</span>
                </div>
            </div>
        </div>
        
        <div class="form-floating">
            <textarea class="form-control" 
                      id="descripcion" 
                      name="descripcion" 
                      style="height: 120px"
                      placeholder="Descripción del producto">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
            <label for="descripcion">Descripción</label>
        </div>
        <div class="form-help">
            <i class="fas fa-pen"></i>
            <span>Describe las características principales del producto</span>
        </div>
    </div>

    <!-- Sección: Precios y Stock -->
    <div class="form-section">
        <h4 class="section-title">
            <i class="fas fa-dollar-sign me-2"></i>
            Precios y Stock
        </h4>
        
        <div class="row">
            <div class="col-lg-4">
                <div class="form-floating">
                    <input type="number" 
                           step="0.01" 
                           class="form-control price-input" 
                           id="precio" 
                           name="precio"
                           value="{{ old('precio', $producto->precio ?? '') }}" 
                           placeholder="0.00"
                           required>
                    <label for="precio" class="required-field">Precio Regular ($)</label>
                    <i class="fas fa-money-bill-wave input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-floating">
                    <input type="number" 
                           step="0.01" 
                           class="form-control price-input" 
                           id="precio_descuento"
                           name="precio_descuento"
                           value="{{ old('precio_descuento', $producto->precio_descuento ?? '') }}" 
                           placeholder="0.00">
                    <label for="precio_descuento">Precio con Descuento ($)</label>
                    <i class="fas fa-percentage input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-floating position-relative">
                    <input type="number" 
                           class="form-control" 
                           id="stock" 
                           name="stock" 
                           value="{{ old('stock', $producto->stock ?? 0) }}" 
                           min="0" 
                           step="1" 
                           placeholder="0"
                           required>
                    <label for="stock" class="required-field">Stock Disponible</label>
                    <span class="stock-indicator stock-high" id="stockIndicator">Alto</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección: Categorización -->
    <div class="form-section">
        <h4 class="section-title">
            <i class="fas fa-layer-group me-2"></i>
            Categorización
        </h4>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="form-floating">
                    <select class="form-select" id="categoria_id" name="categoria_id" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <label for="categoria_id" class="required-field">Categoría</label>
                    <i class="fas fa-list input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-floating">
                    <select class="form-select" id="marca_id" name="marca_id" required>
                        <option value="">Seleccione una marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" 
                                {{ old('marca_id', $producto->marca_id ?? '') == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <label for="marca_id" class="required-field">Marca</label>
                    <i class="fas fa-award input-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección: Características del Producto -->
    <div class="form-section">
        <h4 class="section-title">
            <i class="fas fa-cogs me-2"></i>
            Características del Producto
        </h4>
        
        <div class="row">
            <div class="col-lg-3">
                <div class="form-floating">
                    <select class="form-select" id="talla" name="talla" required>
                        <option value="">Seleccione talla</option>
                        <option value="XS" {{ old('talla', $producto->talla ?? '') == 'XS' ? 'selected' : '' }}>XS</option>
                        <option value="S" {{ old('talla', $producto->talla ?? '') == 'S' ? 'selected' : '' }}>S</option>
                        <option value="M" {{ old('talla', $producto->talla ?? '') == 'M' ? 'selected' : '' }}>M</option>
                        <option value="L" {{ old('talla', $producto->talla ?? '') == 'L' ? 'selected' : '' }}>L</option>
                        <option value="XL" {{ old('talla', $producto->talla ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
                        <option value="XXL" {{ old('talla', $producto->talla ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
                    </select>
                    <label for="talla" class="required-field">Talla</label>
                    <i class="fas fa-ruler input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control" 
                           id="color" 
                           name="color"
                           value="{{ old('color', $producto->color ?? '') }}" 
                           placeholder="Color"
                           required>
                    <label for="color" class="required-field">Color</label>
                    <i class="fas fa-palette input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="form-floating">
                    <select class="form-select" id="genero" name="genero" required>
                        <option value="">Seleccione género</option>
                        <option value="hombre" {{ old('genero', $producto->genero ?? '') == 'hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="mujer" {{ old('genero', $producto->genero ?? '') == 'mujer' ? 'selected' : '' }}>Mujer</option>
                        <option value="unisex" {{ old('genero', $producto->genero ?? '') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                        <option value="niño" {{ old('genero', $producto->genero ?? '') == 'niño' ? 'selected' : '' }}>Niño</option>
                        <option value="niña" {{ old('genero', $producto->genero ?? '') == 'niña' ? 'selected' : '' }}>Niña</option>
                    </select>
                    <label for="genero" class="required-field">Género</label>
                    <i class="fas fa-venus-mars input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="form-floating">
                    <input type="number" 
                           class="form-control" 
                           id="peso" 
                           name="peso"
                           value="{{ old('peso', $producto->peso ?? 0) }}" 
                           placeholder="0">
                    <label for="peso">Peso (gramos)</label>
                    <i class="fas fa-weight input-icon"></i>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control" 
                           id="material" 
                           name="material"
                           value="{{ old('material', $producto->material ?? '') }}" 
                           placeholder="Material"
                           required>
                    <label for="material" class="required-field">Material</label>
                    <i class="fas fa-leaf input-icon"></i>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-floating">
                    <select class="form-select" id="temporada" name="temporada">
                        <option value="">Seleccione temporada</option>
                        <option value="Primavera/Verano" {{ old('temporada', $producto->temporada ?? '') == 'Primavera/Verano' ? 'selected' : '' }}>Primavera/Verano</option>
                        <option value="Otoño/Invierno" {{ old('temporada', $producto->temporada ?? '') == 'Otoño/Invierno' ? 'selected' : '' }}>Otoño/Invierno</option>
                        <option value="Todo el año" {{ old('temporada', $producto->temporada ?? '') == 'Todo el año' ? 'selected' : '' }}>Todo el año</option>
                    </select>
                    <label for="temporada">Temporada</label>
                    <i class="fas fa-calendar-alt input-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección: Imágenes -->
    <div class="form-section">
        <h4 class="section-title">
            <i class="fas fa-images me-2"></i>
            Galería de Imágenes
        </h4>
        
        <div class="row">
            <div class="col-lg-6">
                <label class="form-label required-field">Imagen Principal</label>
                <div class="image-upload-area" onclick="document.getElementById('imagen_principal').click()">
                    <i class="fas fa-cloud-upload-alt fa-3x text-danger mb-3"></i>
                    <h5>Subir Imagen Principal</h5>
                    <p class="text-muted">Arrastra y suelta o haz clic para seleccionar</p>
                    <small class="text-muted">Formatos: JPG, PNG, GIF (Max: 5MB)</small>
                </div>
                <input type="file" 
                       class="d-none" 
                       id="imagen_principal" 
                       name="imagen_principal"
                       accept="image/*" 
                       required>
                <div id="preview_principal" class="image-preview"></div>
            </div>
            
            <div class="col-lg-6">
                <label class="form-label">Imágenes Adicionales</label>
                <div class="image-upload-area" onclick="document.getElementById('imagenes_adicionales').click()">
                    <i class="fas fa-images fa-3x text-info mb-3"></i>
                    <h5>Subir Imágenes Adicionales</h5>
                    <p class="text-muted">Múltiples imágenes permitidas</p>
                    <small class="text-muted">Hasta 10 imágenes adicionales</small>
                </div>
                <input type="file" 
                       class="d-none" 
                       id="imagenes_adicionales" 
                       name="imagenes_adicionales[]"
                       multiple 
                       accept="image/*">
                <div id="preview_adicionales" class="image-preview"></div>
            </div>
        </div>
    </div>

    <!-- Sección: Configuraciones Especiales -->
    <div class="form-section">
        <h4 class="section-title">
            <i class="fas fa-star me-2"></i>
            Configuraciones Especiales
        </h4>
        
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="feature-badge" id="destacadoBadge">
                    <label class="custom-switch">
                        <input type="hidden" name="es_destacado" value="0">
                        <input type="checkbox" 
                               id="es_destacado" 
                               name="es_destacado" 
                               value="1" 
                               {{ old('es_destacado', $producto->es_destacado ?? false) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                    <div class="ms-3">
                        <strong>Producto Destacado</strong>
                        <div class="form-help">
                            <i class="fas fa-star"></i>
                            <span>Aparecerá en la sección destacados</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="feature-badge" id="nuevoBadge">
                    <label class="custom-switch">
                        <input type="hidden" name="es_nuevo" value="0">
                        <input type="checkbox" 
                               id="es_nuevo" 
                               name="es_nuevo" 
                               value="1" 
                               {{ old('es_nuevo', $producto->es_nuevo ?? false) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                    <div class="ms-3">
                        <strong>Producto Nuevo</strong>
                        <div class="form-help">
                            <i class="fas fa-sparkles"></i>
                            <span>Se mostrará con etiqueta "Nuevo"</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Indicador de stock dinámico
    const stockInput = document.getElementById('stock');
    const stockIndicator = document.getElementById('stockIndicator');
    
    function updateStockIndicator() {
        const stock = parseInt(stockInput.value) || 0;
        stockIndicator.className = 'stock-indicator ';
        
        if (stock <= 10) {
            stockIndicator.className += 'stock-low';
            stockIndicator.textContent = 'Bajo';
        } else if (stock <= 50) {
            stockIndicator.className += 'stock-medium';
            stockIndicator.textContent = 'Medio';
        } else {
            stockIndicator.className += 'stock-high';
            stockIndicator.textContent = 'Alto';
        }
    }
    
    stockInput.addEventListener('input', updateStockIndicator);
    updateStockIndicator();
    
    // Preview de imágenes
    function setupImagePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        
        input.addEventListener('change', function(e) {
            preview.innerHTML = '';
            const files = Array.from(e.target.files);
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'image-preview-item';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-image" onclick="removePreviewImage(this, '${inputId}', ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }
    
    setupImagePreview('imagen_principal', 'preview_principal');
    setupImagePreview('imagenes_adicionales', 'preview_adicionales');
    
    // Drag and drop para imágenes
    document.querySelectorAll('.image-upload-area').forEach(area => {
        area.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        area.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });
        
        area.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const input = this.nextElementSibling;
            if (input && input.type === 'file') {
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change'));
            }
        });
    });
    
    // Animación para switches
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const badge = this.closest('.feature-badge');
            if (badge) {
                badge.classList.toggle('active', this.checked);
            }
        });
        
        // Estado inicial
        const badge = checkbox.closest('.feature-badge');
        if (badge && checkbox.checked) {
            badge.classList.add('active');
        }
    });
    
    // Validación en tiempo real
    document.querySelectorAll('input[required], select[required]').forEach(field => {
        field.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 0.25rem rgba(220, 53, 69, 0.25)';
            } else {
                this.style.borderColor = '#28a745';
                this.style.boxShadow = '0 0 0 0.25rem rgba(40, 167, 69, 0.25)';
            }
        });
    });
});

function removePreviewImage(button, inputId, index) {
    const input = document.getElementById(inputId);
    const preview = button.closest('.image-preview');
    
    // Remover el elemento visual
    button.closest('.image-preview-item').remove();
    
    // Para múltiples archivos, necesitaríamos recrear el FileList
    // Por simplicidad, limpiamos el input si no hay más previews
    if (preview.children.length === 0) {
        input.value = '';
    }
}
</script>
@endpush

<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <!-- Columna izquierda -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="{{ old('nombre', $producto->nombre ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="precio" class="form-label">Precio *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                                value="{{ old('precio', $producto->precio ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="precio_descuento" class="form-label">Precio con Descuento</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="precio_descuento"
                                name="precio_descuento"
                                value="{{ old('precio_descuento', $producto->precio_descuento ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock *</label>
                        <input type="number" class="form-control" id="stock" name="stock" 
                        value="{{ old('stock', $producto->stock ?? 0) }}" min="0" step="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">SKU/Código *</label>
                        <input type="text" class="form-control" id="sku" name="sku"
                            value="{{ old('sku', $producto->sku ?? '') }}" required>
                    </div>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="categoria_id" class="form-label">Categoría *</label>
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            <option value="">Seleccione categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="marca_id" class="form-label">Marca *</label>
                        <select class="form-select" id="marca_id" name="marca_id" required>
                            <option value="">Seleccione marca</option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ old('marca_id' , $producto->marca_id ?? '') == $marca->id ? 'selected' : ''}}>
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="talla" class="form-label">Talla *</label>
                        <select class="form-select" id="talla" name="talla" required>
                            <option value="">Seleccione talla</option>
                            <option value="XS"
                                {{ old('talla', $producto->talla ?? '') == 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ old('talla', $producto->talla ?? '') == 'S' ? 'selected' : '' }}>
                                S</option>
                            <option value="M" {{ old('talla', $producto->talla ?? '') == 'M' ? 'selected' : '' }}>
                                M</option>
                            <option value="L" {{ old('talla', $producto->talla ?? '') == 'L' ? 'selected' : '' }}>
                                L</option>
                            <option value="XL"
                                {{ old('talla', $producto->talla ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL"
                                {{ old('talla', $producto->talla ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="color" class="form-label">Color *</label>
                        <input type="text" class="form-control" id="color" name="color"
                            value="{{ old('color', $producto->color ?? '') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="genero" class="form-label">Género *</label>
                        <select class="form-select" id="genero" name="genero" required>
                            <option value="">Seleccione género</option>
                            <option value="hombre"
                                {{ old('genero', $producto->genero ?? '') == 'hombre' ? 'selected' : '' }}>Hombre
                            </option>
                            <option value="mujer"
                                {{ old('genero', $producto->genero ?? '') == 'mujer' ? 'selected' : '' }}>Mujer
                            </option>
                            <option value="unisex"
                                {{ old('genero', $producto->genero ?? '') == 'unisex' ? 'selected' : '' }}>Unisex
                            </option>
                            <option value="niño"
                                {{ old('genero', $producto->genero ?? '') == 'niño' ? 'selected' : '' }}>Niño</option>
                            <option value="niña"
                                {{ old('genero', $producto->genero ?? '') == 'niña' ? 'selected' : '' }}>Niña</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="material" class="form-label">Material *</label>
                    <input type="text" class="form-control" id="material" name="material"
                        value="{{ old('material', $producto->material ?? '') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="temporada" class="form-label">Temporada</label>
                        <select class="form-select" id="temporada" name="temporada">
                            <option value="">Seleccione temporada</option>
                            <option value="Primavera/Verano"
                                {{ old('temporada', $producto->temporada ?? '') == 'Primavera/Verano' ? 'selected' : '' }}>
                                Primavera/Verano</option>
                            <option value="Otoño/Invierno"
                                {{ old('temporada', $producto->temporada ?? '') == 'Otoño/Invierno' ? 'selected' : '' }}>
                                Otoño/Invierno</option>
                            <option value="Todo el año"
                                {{ old('temporada', $producto->temporada ?? '') == 'Todo el año' ? 'selected' : '' }}>
                                Todo el año</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="peso" class="form-label">Peso (gramos)</label>
                        <input type="number" class="form-control" id="peso" name="peso"
                            value="{{ old('peso', $producto->peso ?? 0) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de imágenes -->
        <div class="mb-3">
            <label for="imagen_principal" class="form-label">Imagen Principal *</label>
            <input type="file" class="form-control" id="imagen_principal" name="imagen_principal"
                accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="imagenes_adicionales" class="form-label">Imágenes Adicionales</label>
            <input type="file" class="form-control" id="imagenes_adicionales" name="imagenes_adicionales[]"
                multiple accept="image/*">
        </div>

        <!-- Checkboxes -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="form-check form-switch">
                    <input type="hidden" name="es_destacado" value="0"> <!-- Campo oculto para valor por defecto -->
                    <input class="form-check-input" type="checkbox" id="es_destacado" name="es_destacado" value="1" 
                           {{ old('es_destacado', $producto->es_destacado ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="es_destacado">Destacado</label>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-check form-switch">
                    <input type="hidden" name="es_nuevo" value="0">
                    <input class="form-check-input" type="checkbox" id="es_nuevo" name="es_nuevo" value="1" 
                           {{ old('es_nuevo', $producto->es_nuevo ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="es_nuevo">Nuevo</label>
                </div>
            </div>
        </div>
    </div>
</div>

<main>
    <h2>[ <?php echo $p->id_producto != null ? 'EDITAR JUEGO' : 'NUEVO JUEGO'; ?> ]</h2>

    <div class="form-box">
        <form action="?c=Producto&a=guardar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_producto" value="<?php echo $p->id_producto; ?>" />
            <input type="hidden" name="imagen_actual" value="<?php echo $p->imagen; ?>" />

            <label class="pixel-label">TÍTULO DEL JUEGO *</label>
            <input type="text" name="nombre" value="<?php echo $p->nombre; ?>" required class="pixel-input">

            <div class="flex-row">
                <div class="flex-item">
                    <label class="pixel-label">CATEGORÍA</label>
                    <select name="categoria" class="pixel-input">
                        <option value="Acción" <?php echo $p->categoria == 'Acción' ? 'selected' : ''; ?>>Acción</option>
                        <option value="Aventura" <?php echo $p->categoria == 'Aventura' ? 'selected' : ''; ?>>Aventura</option>
                        <option value="RPG" <?php echo $p->categoria == 'RPG' ? 'selected' : ''; ?>>RPG</option>
                        <option value="Deportes" <?php echo $p->categoria == 'Deportes' ? 'selected' : ''; ?>>Deportes</option>
                        <option value="Estrategia" <?php echo $p->categoria == 'Estrategia' ? 'selected' : ''; ?>>Estrategia</option>
                        <option value="Terror" <?php echo $p->categoria == 'Terror' ? 'selected' : ''; ?>>Terror</option>
                    </select>
                </div>
                <div class="flex-item">
                    <label class="pixel-label">PLATAFORMA</label>
                    <select name="plataforma" class="pixel-input">
                        <option value="PS5" <?php echo $p->plataforma == 'PS5' ? 'selected' : ''; ?>>PS5</option>
                        <option value="Xbox" <?php echo $p->plataforma == 'Xbox' ? 'selected' : ''; ?>>Xbox</option>
                        <option value="Switch" <?php echo $p->plataforma == 'Switch' ? 'selected' : ''; ?>>Switch</option>
                        <option value="PC" <?php echo $p->plataforma == 'PC' ? 'selected' : ''; ?>>PC</option>
                        <option value="Retro" <?php echo $p->plataforma == 'Retro' ? 'selected' : ''; ?>>Retro</option>
                    </select>
                </div>
            </div>

            <div class="flex-row">
                <div class="flex-item">
                    <label class="pixel-label">PRECIO COMPRA (€)</label>
                    <input type="number" step="0.01" name="precio_compra" value="<?php echo $p->precio_compra; ?>" required class="pixel-input">
                </div>
                <div class="flex-item">
                    <label class="pixel-label">PRECIO VENTA (€)</label>
                    <input type="number" step="0.01" name="precio_venta" value="<?php echo $p->precio_venta; ?>" required class="pixel-input">
                </div>
            </div>

            <label class="pixel-label">PROVEEDOR</label>
            <select name="id_proveedor" class="pixel-input">
                <?php foreach($proveedores as $prov): ?>
                    <option value="<?php echo $prov->id_proveedor; ?>" <?php echo $p->id_proveedor == $prov->id_proveedor ? 'selected' : ''; ?>>
                        <?php echo $prov->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="pixel-label">PORTADA DEL JUEGO</label>
            
            <div class="upload-container">
                <input type="file" name="imagen" id="file-input" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                
                <label for="file-input" class="upload-zone <?php echo $p->imagen ? 'has-image' : ''; ?>" id="upload-zone">
                    
                    <div class="upload-content" id="upload-content">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <div class="upload-text">HAZ CLICK PARA SUBIR</div>
                        <div class="upload-hint">o arrastra tu imagen aquí</div>
                    </div>

                    <?php 
                        $rutaImagen = $p->imagen ? "Assets/img/uploads/" . $p->imagen : "";
                        $display = $p->imagen ? "block" : "none";
                    ?>
                    <img id="image-preview" src="<?php echo $rutaImagen; ?>" class="preview-image" style="display: <?php echo $display; ?>;">
                
                </label>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-arcade btn-primary flex-grow-2">GUARDAR JUEGO</button>
                <a href="?c=Producto" class="btn-arcade btn-danger flex-grow-1">CANCELAR</a>
            </div>
        </form>
    </div>
</main>
<main>
    <h2>
        [ <?php echo $p->id_proveedor != null ? 'EDITAR PROVEEDOR' : 'NUEVO PROVEEDOR'; ?> ]
    </h2>

    <div class="form-box">
        <form action="?c=Proveedor&a=guardar" method="post">
            <input type="hidden" name="id_proveedor" value="<?php echo $p->id_proveedor; ?>" />

            <label class="pixel-label">NOMBRE EMPRESA / PROVEEDOR *</label>
            <input type="text" name="nombre" value="<?php echo $p->nombre; ?>" required class="pixel-input">

            <div class="flex-row">
                <div class="flex-item">
                    <label class="pixel-label">CORREO ELECTRÓNICO *</label>
                    <input type="email" name="correo" value="<?php echo $p->correo; ?>" required class="pixel-input">
                </div>
                <div class="flex-item">
                    <label class="pixel-label">TELÉFONO *</label>
                    <input type="text" name="telefono" value="<?php echo $p->telefono; ?>" required class="pixel-input">
                </div>
            </div>

            <label class="pixel-label">CALLE / DIRECCIÓN *</label>
            <input type="text" name="calle" value="<?php echo $p->calle; ?>" required class="pixel-input">

            <div class="flex-row">
                <div class="flex-item">
                    <label class="pixel-label">NÚMERO *</label>
                    <input type="text" name="numero" value="<?php echo $p->numero; ?>" required class="pixel-input">
                </div>
                <div class="flex-item">
                    <label class="pixel-label">CÓDIGO POSTAL *</label>
                    <input type="text" name="c_postal" value="<?php echo $p->c_postal; ?>" required class="pixel-input">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-arcade btn-primary flex-grow-2">
                    GUARDAR DATOS
                </button>
                <a href="?c=Proveedor" class="btn-arcade btn-danger flex-grow-1">
                    CANCELAR
                </a>
            </div>
        </form>
    </div>
</main>
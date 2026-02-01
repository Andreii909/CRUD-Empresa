<main>
    <h2>
        [ <?php echo $p->id_cliente != null ? 'EDITAR CLIENTE' : 'NUEVO CLIENTE'; ?> ]
    </h2>

    <div class="form-box">
        <form action="?c=Cliente&a=guardar" method="post">
            <input type="hidden" name="id_cliente" value="<?php echo $p->id_cliente; ?>" />

            <label class="pixel-label">NOMBRE COMPLETO *</label>
            <input type="text" name="nombre" value="<?php echo $p->nombre; ?>" required class="pixel-input">

            <div style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label class="pixel-label">CORREO ELECTRÓNICO *</label>
                    <input type="email" name="correo" value="<?php echo $p->correo; ?>" required class="pixel-input">
                </div>
                <div style="flex: 1;">
                    <label class="pixel-label">TELÉFONO *</label>
                    <input type="text" name="telefono" value="<?php echo $p->telefono; ?>" required class="pixel-input">
                </div>
            </div>

            <label class="pixel-label">CALLE / DIRECCIÓN *</label>
            <input type="text" name="calle" value="<?php echo $p->calle; ?>" required class="pixel-input">

            <div style="display: flex; gap: 20px; margin-bottom: 10px;">
                <div style="flex: 1;">
                    <label class="pixel-label">NÚMERO *</label>
                    <input type="text" name="numero" value="<?php echo $p->numero; ?>" required class="pixel-input">
                </div>
                <div style="flex: 1;">
                    <label class="pixel-label">CÓDIGO POSTAL *</label>
                    <input type="text" name="c_postal" value="<?php echo $p->c_postal; ?>" required class="pixel-input">
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-arcade" style="flex: 2; background: #00ffcc; color: #000; border: none;">
                    GUARDAR DATOS
                </button>
                <a href="?c=Cliente" class="btn-arcade" style="flex: 1; background: #ff3333; color: #fff; text-align: center; border: none;">
                    CANCELAR
                </a>
            </div>
        </form>
    </div>
</main>
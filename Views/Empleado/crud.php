<main>
    <h2>
        [ <?php echo $p->id_empleado != null ? 'EDITAR EMPLEADO' : 'NUEVO EMPLEADO'; ?> ]
    </h2>

    <div class="form-box">
        <form action="?c=Empleado&a=guardar" method="post">
            <input type="hidden" name="id_empleado" value="<?php echo $p->id_empleado; ?>" />

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

            <label class="pixel-label">PUESTO / CARGO *</label>
            <input type="text" name="puesto" value="<?php echo $p->puesto; ?>" required class="pixel-input" placeholder="EJ: GERENTE, VENDEDOR...">

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-arcade" style="flex: 2; background: #00ffcc; color: #000; border: none;">
                    GUARDAR DATOS
                </button>
                <a href="?c=Empleado" class="btn-arcade" style="flex: 1; background: #ff3333; color: #fff; text-align: center; border: none;">
                    CANCELAR
                </a>
            </div>
        </form>
    </div>
</main>
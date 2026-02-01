<?php if(isset($_SESSION['mensaje'])): ?>
    <?php 
        $claseColor = (isset($_SESSION['color']) && $_SESSION['color'] == 'rojo') ? 'flash-error' : 'flash-success';
        $icono = (isset($_SESSION['color']) && $_SESSION['color'] == 'rojo') ? 'fa-trash' : 'fa-check-circle';
    ?>
    <div id="alerta-flash" class="flash-message <?php echo $claseColor; ?>">
        <i class="fas <?php echo $icono; ?>" style="font-size: 1rem;"></i>
        <span style="text-transform: uppercase; font-weight: bold;"><?php echo $_SESSION['mensaje']; ?></span>
    </div>
    <?php unset($_SESSION['mensaje']); unset($_SESSION['color']); ?>
<?php endif; ?>

<main>
    <div class="back-link-container">
        <a href="index.php?c=Home" class="btn-back">
            <i class="fas fa-arrow-left"></i> VOLVER AL DASHBOARD
        </a>
    </div>

    <h1>GESTIÓN DE CLIENTES</h1>
    
    <div class="toolbar">
        <a href="?c=Cliente&a=crud" class="btn-arcade btn-primary">+ NUEVO CLIENTE</a>
        
        <form action="index.php" method="get" class="search-form">
            <input type="hidden" name="c" value="Cliente">
            <input type="text" name="q" placeholder="Buscar..." class="search-input" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
            <button type="submit" class="btn-arcade">BUSCAR</button>
        </form>
    </div>

    <div class="table-container">
        <table class="pixel-table">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>NOMBRE</th>
                    <th>CONTACTO</th>
                    <th>DIRECCIÓN</th>
                    <th class="text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // 1. Obtenemos los datos primero
                $resultados = $this->model->Listar($busqueda); 
                ?>

                <?php if(count($resultados) == 0): ?>
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 30px; color: #555;">
                            NO SE ENCONTRARON CLIENTES
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($resultados as $r): ?>
                    <tr>
                        <td class="text-center font-mono">
                            #<?php echo str_pad($r->id_cliente, 3, "0", STR_PAD_LEFT); ?>
                        </td>
                        
                        <td class="font-bold">
                            <?php echo $r->nombre; ?>
                        </td>
                        
                        <td>
                            <div class="text-primary"><?php echo $r->correo; ?></div>
                            <div class="text-muted"><?php echo $r->telefono; ?></div>
                        </td>
                        
                        <td>
                            <?php echo $r->calle . ' ' . $r->numero; ?><br>
                            <span class="text-secondary">CP: <?php echo $r->c_postal; ?></span>
                        </td>
                        
                        <td class="text-center">
                            <div class="flex-center">
                                <a href="?c=Cliente&a=crud&id=<?php echo $r->id_cliente; ?>" class="btn-small btn-edit">EDITAR</a>

                                <a href="?c=Cliente&a=eliminar&id=<?php echo $r->id_cliente; ?>" 
                                   onclick="return confirm('Vas a eliminar al cliente #<?php echo str_pad($r->id_cliente, 3, "0", STR_PAD_LEFT); ?>. ¿Seguro?');" 
                                   class="btn-small btn-delete">BORRAR</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
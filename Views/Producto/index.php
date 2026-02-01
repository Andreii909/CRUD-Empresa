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
        <a href="index.php?c=Home" class="btn-back"><i class="fas fa-arrow-left"></i> VOLVER AL DASHBOARD</a>
    </div>

    <h1>CATÁLOGO DE JUEGOS</h1>
    
    <div class="toolbar">
        <a href="?c=Producto&a=crud" class="btn-arcade btn-primary">+ NUEVO JUEGO</a>
        
        <form action="index.php" method="get" class="search-form">
            <input type="hidden" name="c" value="Producto">
            <input type="text" name="q" placeholder="Buscar juego..." class="search-input" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
            <button type="submit" class="btn-arcade">BUSCAR</button>
        </form>
    </div>

    <div class="card-grid">
        <?php 
        $productos = $this->model->Listar($busqueda); 
        if(count($productos) > 0):
            foreach($productos as $r): 
                // Si no tiene imagen, ponemos una por defecto
                $img = $r->imagen != null ? "Assets/img/uploads/".$r->imagen : "Assets/img/no-cover.png";
        ?>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="<?php echo $img; ?>" alt="<?php echo $r->nombre; ?>">
                    <span class="platform-badge"><?php echo $r->plataforma; ?></span>
                </div>
                
                <div class="card-details">
                    <h3 class="card-title"><?php echo $r->nombre; ?></h3>
                    <p class="card-category"><?php echo $r->categoria; ?></p>
                    
                    <div class="card-price-row">
                        <span class="price-tag"><?php echo number_format($r->precio_venta, 2); ?> €</span>
                        <span class="stock-info">Prov: <?php echo $r->nombre_proveedor ?? 'N/A'; ?></span>
                    </div>

                    <div class="card-actions">
                        <a href="?c=Producto&a=crud&id=<?php echo $r->id_producto; ?>" class="btn-small btn-edit" style="flex:1; text-align:center;">EDITAR</a>
                        <a href="?c=Producto&a=eliminar&id=<?php echo $r->id_producto; ?>" 
                           onclick="return confirm('¿Borrar juego?');" 
                           class="btn-small btn-delete" style="flex:1; text-align:center;">BORRAR</a>
                    </div>
                </div>
            </div>
        <?php endforeach; else: ?>
            <div style="width: 100%; text-align: center; color: #777; grid-column: 1 / -1;">
                NO HAY JUEGOS REGISTRADOS EN EL SISTEMA
            </div>
        <?php endif; ?>
    </div>
</main>
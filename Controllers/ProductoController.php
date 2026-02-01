<?php
require_once 'Models/ProductoModel.php';
require_once 'Models/ProveedorModel.php'; // Necesario para el desplegable

class ProductoController {
    
    private $model;
    private $proveedorModel;
    
    public function __construct(){
        $this->model = new Producto();
        $this->proveedorModel = new Proveedor(); // Instancia para listar proveedores
    }
    
    public function index(){
        $busqueda = isset($_REQUEST['q']) ? $_REQUEST['q'] : "";
        require_once 'Views/Shared/header.php';
        require_once 'Views/Producto/index.php';
        require_once 'Views/Shared/footer.php';
    }
    
    public function crud(){
        $p = new Producto();
        
        if(isset($_REQUEST['id'])){
            $p = $this->model->Obtener($_REQUEST['id']);
        }
        
        // Obtenemos la lista de proveedores para el <select>
        $proveedores = $this->proveedorModel->Listar();
        
        require_once 'Views/Shared/header.php';
        require_once 'Views/Producto/crud.php';
        require_once 'Views/Shared/footer.php';
    }
    
    public function guardar(){
        $p = new Producto();
        
        $p->id_producto   = $_REQUEST['id_producto'];
        $p->nombre        = $_REQUEST['nombre'];
        $p->categoria     = $_REQUEST['categoria'];
        $p->plataforma    = $_REQUEST['plataforma'];
        $p->precio_venta  = $_REQUEST['precio_venta'];
        $p->precio_compra = $_REQUEST['precio_compra'];
        $p->id_proveedor  = $_REQUEST['id_proveedor'];
        
        // --- LÓGICA DE SUBIDA DE IMAGEN ---
        $p->imagen = $_REQUEST['imagen_actual']; // Por defecto mantenemos la vieja

        if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != ""){
            $archivo = $_FILES['imagen'];
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            // Generamos nombre único: prod_TIME.jpg
            $nombre_foto = "prod_" . time() . "." . $extension; 
            
            // Movemos la foto a la carpeta
            if(move_uploaded_file($archivo['tmp_name'], "Assets/img/uploads/" . $nombre_foto)){
                $p->imagen = $nombre_foto;
            }
        }
        // ----------------------------------

        $guardado = $p->id_producto > 0 
            ? $this->model->Actualizar($p)
            : $this->model->Registrar($p);
        
        $_SESSION['mensaje'] = "PRODUCTO GUARDADO EXITOSAMENTE";
        $_SESSION['color'] = "verde";
        
        header('Location: index.php?c=Producto');
    }
    
    public function eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        $_SESSION['mensaje'] = "PRODUCTO ELIMINADO";
        $_SESSION['color'] = "rojo";
        header('Location: index.php?c=Producto');
    }
}
?>
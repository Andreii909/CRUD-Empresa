<?php
// Controllers/ProveedorController.php

// Cargamos el modelo correspondiente
require_once 'Models/ProveedorModel.php';

class ProveedorController {
    
    private $model;
    
    public function __construct(){
        // Instanciamos el modelo Proveedor
        $this->model = new Proveedor();
    }
    
    // 1. PANTALLA PRINCIPAL (LISTA)
    public function index(){
        // Capturamos si hay una búsqueda
        $busqueda = isset($_REQUEST['q']) ? $_REQUEST['q'] : "";
        
        // Cargamos las vistas
        require_once 'Views/Shared/header.php';
        require_once 'Views/Proveedor/index.php';
        require_once 'Views/Shared/footer.php';
    }
    
    // 2. PANTALLA DE FORMULARIO (NUEVO / EDITAR)
    public function crud(){
        $p = new Proveedor();
        
        // Si nos pasan un ID, es que queremos EDITAR
        if(isset($_REQUEST['id'])){
            $p = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'Views/Shared/header.php';
        require_once 'Views/Proveedor/crud.php';
        require_once 'Views/Shared/footer.php';
    }
    
    // 3. GUARDAR DATOS (INSERTAR O ACTUALIZAR)
    public function guardar(){
        $p = new Proveedor();
        
        // Recogemos los datos del formulario (names del HTML)
        $p->id_proveedor = $_REQUEST['id_proveedor'];
        $p->nombre       = $_REQUEST['nombre'];
        $p->correo       = $_REQUEST['correo'];
        $p->telefono     = $_REQUEST['telefono'];
        $p->calle        = $_REQUEST['calle'];
        $p->numero       = $_REQUEST['numero'];
        $p->c_postal     = $_REQUEST['c_postal'];

        // Si el ID > 0 es ACTUALIZAR, si no es REGISTRAR
        // Guardamos el resultado (true o false) en una variable
        $guardado = $p->id_proveedor > 0 
            ? $this->model->Actualizar($p)
            : $this->model->Registrar($p);
        
        // LÓGICA DE NOTIFICACIONES
        if ($guardado) {
            // ÉXITO -> VERDE
            $_SESSION['mensaje'] = "DATOS DEL PROVEEDOR GUARDADOS CORRECTAMENTE.";
            $_SESSION['color'] = "verde";
        } else {
            // ERROR (DUPLICADO) -> ROJO
            $_SESSION['mensaje'] = "ERROR: EL CORREO YA PERTENECE A OTRO PROVEEDOR.";
            $_SESSION['color'] = "rojo";
        }
        
        // Redirigimos a la lista de proveedores
        header('Location: index.php?c=Proveedor');
    }
    
    // 4. ELIMINAR PROVEEDOR
    public function eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        
        // MENSAJE DE ELIMINACIÓN -> ROJO
        $_SESSION['mensaje'] = "EL PROVEEDOR HA SIDO ELIMINADO DEL SISTEMA.";
        $_SESSION['color'] = "rojo";
        
        header('Location: index.php?c=Proveedor');
    }
}
?>
<?php
// Controllers/ClienteController.php

// Asegúrate de que tu archivo en la carpeta Models se llame Cliente.php
// Si se llama ClienteModel.php, cámbialo aquí también.
require_once 'Models/ClienteModel.php';

class ClienteController {
    
    private $model;
    
    public function __construct(){
        $this->model = new Cliente();
    }
    
    public function index(){
        $busqueda = isset($_REQUEST['q']) ? $_REQUEST['q'] : "";
        
        require_once 'Views/Shared/header.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Shared/footer.php';
    }
    
    public function crud(){
        $p = new Cliente();
        
        if(isset($_REQUEST['id'])){
            $p = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'Views/Shared/header.php';
        require_once 'Views/Cliente/crud.php';
        require_once 'Views/Shared/footer.php';
    }
    
    public function guardar(){
        $p = new Cliente();
        
        $p->id_cliente = $_REQUEST['id_cliente'];
        $p->nombre     = $_REQUEST['nombre'];
        $p->correo     = $_REQUEST['correo'];
        $p->telefono   = $_REQUEST['telefono'];
        $p->calle      = $_REQUEST['calle'];
        $p->numero     = $_REQUEST['numero'];
        $p->c_postal   = $_REQUEST['c_postal'];

        // Intentamos guardar y capturamos el resultado (true o false)
        $guardado = $p->id_cliente > 0 
            ? $this->model->Actualizar($p)
            : $this->model->Registrar($p);
        
        // --- LÓGICA DE MENSAJES ---
        if ($guardado) {
            // Si devuelve TRUE -> Éxito (Verde)
            $_SESSION['mensaje'] = "DATOS GUARDADOS CORRECTAMENTE.";
            $_SESSION['color'] = "verde";
        } else {
            // Si devuelve FALSE -> Error Duplicado (Rojo)
            $_SESSION['mensaje'] = "ERROR: EL CORREO YA PERTENECE A OTRO CLIENTE.";
            $_SESSION['color'] = "rojo";
        }
        
        header('Location: index.php?c=Cliente');
    }
    
    // --- CAMBIOS AQUÍ: MENSAJE ROJO ---
    public function eliminar(){
        $this->model->Eliminar($_REQUEST['id']);

        $_SESSION['mensaje'] = "EL CLIENTE HA SIDO ELIMINADO.";
        $_SESSION['color'] = "rojo";
        
        header('Location: index.php?c=Cliente');
    }
}
?>
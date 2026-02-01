<?php
require_once 'Models/EmpleadoModel.php';

class EmpleadoController {
    
    private $model;
    
    public function __construct(){
        $this->model = new Empleado();
    }
    
    public function index(){
        $busqueda = isset($_REQUEST['q']) ? $_REQUEST['q'] : "";
        
        require_once 'Views/Shared/header.php';
        require_once 'Views/Empleado/index.php';
        require_once 'Views/Shared/footer.php';
    }
    
    public function crud(){
        $p = new Empleado();
        
        if(isset($_REQUEST['id'])){
            $p = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'Views/Shared/header.php';
        require_once 'Views/Empleado/crud.php';
        require_once 'Views/Shared/footer.php';
    }
    
    public function guardar(){
        $p = new Empleado();
        
        $p->id_empleado = $_REQUEST['id_empleado'];
        $p->nombre      = strtoupper($_REQUEST['nombre']);
        $p->correo      = $_REQUEST['correo'];
        $p->telefono    = $_REQUEST['telefono'];
        $p->puesto      = strtoupper($_REQUEST['puesto']);

        $guardado = $p->id_empleado > 0 
            ? $this->model->Actualizar($p)
            : $this->model->Registrar($p);
        
        if ($guardado) {
            $_SESSION['mensaje'] = "DATOS GUARDADOS CORRECTAMENTE.";
            $_SESSION['color'] = "verde";
        } else {
            $_SESSION['mensaje'] = "ERROR: EL CORREO YA PERTENECE A OTRO EMPLEADO.";
            $_SESSION['color'] = "rojo";
        }
        
        header('Location: index.php?c=Empleado');
    }

    public function eliminar(){
        $this->model->Eliminar($_REQUEST['id']);

        $_SESSION['mensaje'] = "EL EMPLEADO HA SIDO ELIMINADO.";
        $_SESSION['color'] = "rojo";
        
        header('Location: index.php?c=Empleado');
    }
}
?>
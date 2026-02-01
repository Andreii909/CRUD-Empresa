<?php
require_once 'Models/LoginModel.php';

class LoginController {
    
    private $model;
    
    public function __construct(){
        $this->model = new Usuario();
    }
    
    // Muestra el formulario
    public function index(){
        // Si ya estás dentro, te manda al Home
        if(isset($_SESSION['usuario'])){
            header('Location: index.php?c=Home');
            exit();
        }
        require_once 'Views/Login/index.php';
    }
    
    // Procesa el login
    public function autenticar(){
        // Recogemos lo que escribe el usuario
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena']; // name="contrasena" del HTML
        
        // Preguntamos a la base de datos
        $usuario = $this->model->Entrar($correo, $contrasena);
        
        if($usuario){
            // ¡EXITO! Guardamos al usuario en la sesión
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php?c=Home');
        } else {
            // ¡FALLO! Guardamos el error y volvemos al login
            $_SESSION['error_login'] = "Credenciales incorrectas. Intenta de nuevo.";
            header('Location: index.php?c=Login');
        }
    }
    
    // Cierra sesión
    public function salir(){
        session_destroy();
        header('Location: index.php?c=Login');
    }
}
?>
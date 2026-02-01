<?php
session_start(); 

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Db/conexion.php';

$controller = isset($_GET['c']) ? $_GET['c'] : 'Home';
$accion = isset($_GET['a']) ? $_GET['a'] : 'index';

$controllerName = $controller . 'Controller';
$rutaArchivo = "Controllers/" . $controllerName . ".php";

if(file_exists($rutaArchivo)){
    require_once $rutaArchivo;
    
    if(class_exists($controllerName)){
        $controlador = new $controllerName();
        
        if(method_exists($controlador, $accion)){
                
            call_user_func(array($controlador, $accion));
        } else {
            echo "Error: La acción '$accion' no existe.";
        }
    } else {
        echo "Error: La clase $controllerName no está definida en el archivo.";
    }
} else {
    echo "Error: No se encuentra el archivo $rutaArchivo";
}
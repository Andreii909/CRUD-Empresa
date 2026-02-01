<?php
class Conex1 {
    public static function con1() {
        $host = '127.0.0.1'; 
        $port = 3306;       
        $db   = 'arcadia';       
        $user = 'root';
        $pass = '';

        $mysqli = new mysqli($host, $user, $pass, $db, $port);

        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }

        $mysqli->set_charset("utf8mb4");
        return $mysqli;
    }
}
?>
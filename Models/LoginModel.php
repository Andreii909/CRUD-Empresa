<?php
class Usuario {
    private $db;
    
    public $id_usuario;
    public $nombre;
    public $correo;
    public $contrasena; // Importante: mismo nombre que en la BD
    public $rol;

    public function __construct(){
        try {
            $this->db = Conex1::con1();     
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Entrar($correo, $contrasena){
        try {
            // Buscamos coincidencia exacta de correo y contraseña
            $sql = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ss", $correo, $contrasena);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            // Devuelve los datos del usuario si existe, o false si no
            return $result->fetch_object();
            
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
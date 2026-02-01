<?php
class Proveedor {
    private $db;
    
    public $id_proveedor;
    public $nombre;
    public $correo;
    public $telefono;
    public $calle;
    public $numero;
    public $c_postal;

    public function __construct(){
        try {
            // Usamos la conexión existente en tu sistema
            $this->db = Conex1::con1();     
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    // --- LISTAR PROVEEDORES (MySQLi) ---
    public function Listar($busqueda = ""){
        try {
            $sql = "SELECT * FROM proveedores WHERE nombre LIKE ? OR correo LIKE ?";
            $stmt = $this->db->prepare($sql);
            
            // Preparamos los parámetros de búsqueda con %
            $termino = "%" . $busqueda . "%";
            
            // "ss" significa que pasamos 2 Strings (nombre y correo)
            $stmt->bind_param("ss", $termino, $termino);
            
            $stmt->execute();
            
            // Obtenemos el resultado
            $result = $stmt->get_result();
            
            // Convertimos el resultado en una lista de objetos
            $datos = [];
            while ($row = $result->fetch_object()) {
                $datos[] = $row;
            }
            return $datos;

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    // --- OBTENER UN PROVEEDOR POR ID (MySQLi) ---
    public function Obtener($id){
        try {
            $sql = "SELECT * FROM proveedores WHERE id_proveedor = ?";
            $stmt = $this->db->prepare($sql);
            
            // "i" significa que el ID es un Integer (entero)
            $stmt->bind_param("i", $id);
            
            $stmt->execute();
            
            $result = $stmt->get_result();
            return $result->fetch_object();
            
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    // --- ELIMINAR (MySQLi) ---
    public function Eliminar($id){
        try {
            $sql = "DELETE FROM proveedores WHERE id_proveedor = ?";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    // --- ACTUALIZAR (MySQLi) ---
    public function Actualizar($data){
        try {
            $sql = "UPDATE proveedores SET 
                    nombre = ?, 
                    correo = ?, 
                    telefono = ?, 
                    calle = ?, 
                    numero = ?, 
                    c_postal = ? 
                    WHERE id_proveedor = ?";
            
            $stmt = $this->db->prepare($sql);
            
            // "ssssssi": 6 Strings + 1 Integer (el ID al final)
            $stmt->bind_param("ssssssi", 
                $data->nombre, 
                $data->correo, 
                $data->telefono,
                $data->calle,
                $data->numero,
                $data->c_postal,
                $data->id_proveedor
            );
            
            $stmt->execute();
            return true;

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) return false; // Error duplicado
            else die($e->getMessage());
        }
    }

    // --- REGISTRAR (MySQLi) ---
    public function Registrar($data){
        try {
            $sql = "INSERT INTO proveedores (nombre, correo, telefono, calle, numero, c_postal) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            
            // "ssssss": 6 Strings
            $stmt->bind_param("ssssss", 
                $data->nombre, 
                $data->correo, 
                $data->telefono,
                $data->calle,
                $data->numero,
                $data->c_postal
            );
            
            $stmt->execute();
            return true;

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) return false; // Error duplicado
            else die($e->getMessage());
        }
    }
}
?>
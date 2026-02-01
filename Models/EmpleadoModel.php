<?php
class Empleado {
    private $db;

    public $id_empleado;
    public $nombre;
    public $correo;
    public $telefono;
    public $puesto;

    public function __construct() {
        $this->db = Conex1::con1();     
    }

    public function Listar($busqueda = "") {
        if ($busqueda != "") {
            $sql = "SELECT * FROM empleados WHERE nombre LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR puesto LIKE '%$busqueda%'";
        } else {
            $sql = "SELECT * FROM empleados";
        }

        $resultado = $this->db->query($sql);

        $datos = [];
        while ($fila = $resultado->fetch_object()) {
            $datos[] = $fila;
        }
        return $datos;
    }

    public function Obtener($id) {
        $stmt = $this->db->prepare("SELECT * FROM empleados WHERE id_empleado = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        return $resultado->fetch_object();
    }

    public function Eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM empleados WHERE id_empleado = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function Actualizar($data) {
        try {
            $sql = "UPDATE empleados SET 
                    nombre = ?, 
                    correo = ?, 
                    telefono = ?, 
                    puesto = ? 
                    WHERE id_empleado = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssi", 
                $data->nombre, 
                $data->correo, 
                $data->telefono,
                $data->puesto,
                $data->id_empleado
            );
            
            $stmt->execute();
            return true; 

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                return false;
            } else {
                die("Error: " . $e->getMessage()); 
            }
        }
    }

    public function Registrar($data) {
        try {
            $sql = "INSERT INTO empleados (nombre, correo, telefono, puesto) 
                    VALUES (?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssss", 
                $data->nombre, 
                $data->correo, 
                $data->telefono,
                $data->puesto
            );
            
            $stmt->execute();
            return true;

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                return false;
            } else {
                die("Error: " . $e->getMessage());
            }
        }
    }
}
?>
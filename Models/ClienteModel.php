<?php
class Cliente {
    private $db;

    public $id_cliente;
    public $nombre;
    public $correo;
    public $telefono;
    public $calle;
    public $numero;
    public $c_postal;

    public function __construct() {
        $this->db = Conex1::con1();     
    }

    public function Listar($busqueda = "") {
        if ($busqueda != "") {
            $sql = "SELECT * FROM clientes WHERE nombre LIKE '%$busqueda%' OR correo LIKE '%$busqueda%'";
        } else {
            $sql = "SELECT * FROM clientes";
        }

        $resultado = $this->db->query($sql);

        $datos = [];
        while ($fila = $resultado->fetch_object()) {
            $datos[] = $fila;
        }
        return $datos;
    }

    public function Obtener($id) {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        return $resultado->fetch_object();
    }

    public function Eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM clientes WHERE id_cliente = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

// --- FUNCIÓN ACTUALIZAR PROTEGIDA ---
    public function Actualizar($data) {
        try {
            $sql = "UPDATE clientes SET 
                    nombre = ?, 
                    correo = ?, 
                    telefono = ?, 
                    calle = ?, 
                    numero = ?, 
                    c_postal = ? 
                    WHERE id_cliente = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssssi", 
                $data->nombre, 
                $data->correo, 
                $data->telefono,
                $data->calle,
                $data->numero,
                $data->c_postal,
                $data->id_cliente
            );
            
            $stmt->execute();
            return true; // ¡Todo salió bien!

        } catch (mysqli_sql_exception $e) {
            // Error 1062 significa "Entrada Duplicada" en MySQL
            if ($e->getCode() == 1062) {
                return false; // Avisamos de que falló por duplicado
            } else {
                die("Error desconocido: " . $e->getMessage()); // Otro error
            }
        }
    }

    public function Registrar($data) {
        try {
            $sql = "INSERT INTO clientes (nombre, correo, telefono, calle, numero, c_postal) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
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
            if ($e->getCode() == 1062) {
                return false;
            } else {
                die("Error desconocido: " . $e->getMessage());
            }
        }
    }

    }
?>
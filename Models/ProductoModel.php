<?php
class Producto {
    private $db;
    
    public $id_producto;
    public $nombre;
    public $categoria;
    public $plataforma;
    public $precio_venta;
    public $precio_compra;
    public $id_proveedor;
    public $imagen;
    
    // Propiedad extra para mostrar el nombre del proveedor en la tarjeta
    public $nombre_proveedor; 

    public function __construct(){
        try {
            $this->db = Conex1::con1();     
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar($busqueda = ""){
        try {
            // Hacemos JOIN para obtener también el nombre del proveedor
            $sql = "SELECT p.*, prov.nombre as nombre_proveedor 
                    FROM productos p 
                    LEFT JOIN proveedores prov ON p.id_proveedor = prov.id_proveedor
                    WHERE p.nombre LIKE ? OR p.categoria LIKE ? OR p.plataforma LIKE ?";
            
            $stmt = $this->db->prepare($sql);
            $termino = "%" . $busqueda . "%";
            $stmt->bind_param("sss", $termino, $termino, $termino);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $datos = [];
            while ($row = $result->fetch_object()) {
                $datos[] = $row;
            }
            return $datos;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id){
        try {
            $sql = "SELECT * FROM productos WHERE id_producto = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_object();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id){
        try {
            $sql = "DELETE FROM productos WHERE id_producto = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar($data){
        try {
            $sql = "INSERT INTO productos (nombre, categoria, plataforma, precio_venta, precio_compra, id_proveedor, imagen) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssddis", 
                $data->nombre, $data->categoria, $data->plataforma, 
                $data->precio_venta, $data->precio_compra, $data->id_proveedor, $data->imagen
            );
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data){
        try {
            $sql = "UPDATE productos SET 
                    nombre = ?, categoria = ?, plataforma = ?, 
                    precio_venta = ?, precio_compra = ?, id_proveedor = ?, imagen = ?
                    WHERE id_producto = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssddisi", 
                $data->nombre, $data->categoria, $data->plataforma, 
                $data->precio_venta, $data->precio_compra, $data->id_proveedor, $data->imagen,
                $data->id_producto
            );
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
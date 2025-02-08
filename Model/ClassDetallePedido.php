<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassDetallePedido {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getDetallesPedido() {
        $query = "SELECT * FROM detalles_pedido";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetallePedidoById($id) {
        $query = "SELECT * FROM detalles_pedido WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setDetallePedido($id_pedido, $id_producto, $cantidad, $precio_unitario) {
        $query = "INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) 
                  VALUES (:id_pedido, :id_producto, :cantidad, :precio_unitario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        $stmt->execute();
    }

    public function updateDetallePedido($id, $id_pedido, $id_producto, $cantidad, $precio_unitario) {
        $query = "UPDATE detalles_pedido SET id_pedido = :id_pedido, id_producto = :id_producto, 
                  cantidad = :cantidad, precio_unitario = :precio_unitario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteDetallePedido($id) {
        $query = "DELETE FROM detalles_pedido WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function crearDetallePedido($id_pedido, $id_producto, $cantidad, $precio_unitario) {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario)
                VALUES (:id_pedido, :id_producto, :cantidad, :precio_unitario)
            ");
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':precio_unitario', $precio_unitario, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }    
}
?>
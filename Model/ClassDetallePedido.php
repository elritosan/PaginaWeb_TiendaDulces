<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassDetallePedido {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getDetallesPedido() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM detalles_pedido");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getDetallePedidoById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM detalles_pedido WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function setDetallePedido($id_pedido, $id_producto, $cantidad, $precio_unitario) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) 
                                          VALUES (:id_pedido, :id_producto, :cantidad, :precio_unitario)");
            $stmt->bindParam(':id_pedido', $id_pedido);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio_unitario', $precio_unitario);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function updateDetallePedido($id, $cantidad, $precio_unitario) {
        try {
            $stmt = $this->conn->prepare("UPDATE detalles_pedido SET cantidad = :cantidad, precio_unitario = :precio_unitario WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio_unitario', $precio_unitario);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deleteDetallePedido($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM detalles_pedido WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
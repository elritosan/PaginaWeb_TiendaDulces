<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassPedido {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getPedidos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM pedidos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getPedidoById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM pedidos WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function setPedido($id_usuario, $total) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO pedidos (id_usuario, total) VALUES (:id_usuario, :total)");
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':total', $total);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function updatePedido($id, $estado) {
        try {
            $stmt = $this->conn->prepare("UPDATE pedidos SET estado = :estado WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':estado', $estado);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deletePedido($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM pedidos WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
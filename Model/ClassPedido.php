<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassPedido {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getPedidos() {
        $query = "SELECT * FROM pedidos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPedidoById($id) {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setPedido($id_usuario, $total, $estado) {
        $query = "INSERT INTO pedidos (id_usuario, total, estado, fecha_pedido) 
                  VALUES (:id_usuario, :total, :estado, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }

    public function updatePedido($id, $id_usuario, $total, $estado) {
        $query = "UPDATE pedidos SET id_usuario = :id_usuario, total = :total, estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deletePedido($id) {
        $query = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function crearPedido($id_usuario, $total) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO pedidos (id_usuario, total) VALUES (:id_usuario, :total)");
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':total', $total, PDO::PARAM_STR);
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function listarPedido($busqueda = '') {
        try {
            if ($busqueda) {
                $stmt = $this->conn->prepare("SELECT * FROM pedidos WHERE id LIKE :busqueda");
                $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM pedidos");
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
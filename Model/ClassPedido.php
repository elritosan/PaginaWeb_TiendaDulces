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
}
?>
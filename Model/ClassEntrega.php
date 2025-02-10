<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassEntrega {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getEntregas() {
        $query = "SELECT * FROM entregas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEntregaById($id) {
        $query = "SELECT * FROM entregas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setEntrega($id_pedido, $direccion_entrega, $fecha_estimada, $estado) {
        $query = "INSERT INTO entregas (id_pedido, direccion_entrega, fecha_estimada, estado) 
                  VALUES (:id_pedido, :direccion_entrega, :fecha_estimada, :estado)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':direccion_entrega', $direccion_entrega);
        $stmt->bindParam(':fecha_estimada', $fecha_estimada);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }

    public function updateEntrega($id, $id_pedido, $direccion_entrega, $fecha_estimada, $estado) {
        $query = "UPDATE entregas SET id_pedido = :id_pedido, direccion_entrega = :direccion_entrega, 
                  fecha_estimada = :fecha_estimada, estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':direccion_entrega', $direccion_entrega);
        $stmt->bindParam(':fecha_estimada', $fecha_estimada);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteEntrega($id) {
        $query = "DELETE FROM entregas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function crearEntrega($id_pedido, $direccion_entrega) {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO entregas (id_pedido, direccion_entrega, estado) 
                VALUES (:id_pedido, :direccion_entrega, 'pendiente')
            ");
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmt->bindParam(':direccion_entrega', $direccion_entrega, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }    
}
?>
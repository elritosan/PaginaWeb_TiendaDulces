<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassEntrega {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    // Obtener todas las entregas
    public function getEntregas() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM entregas");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Obtener una entrega por ID
    public function getEntregaById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM entregas WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Registrar una nueva entrega
    public function setEntrega($id_pedido, $direccion_entrega, $fecha_estimada) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO entregas (id_pedido, direccion_entrega, fecha_estimada) 
                                          VALUES (:id_pedido, :direccion_entrega, :fecha_estimada)");
            $stmt->bindParam(':id_pedido', $id_pedido);
            $stmt->bindParam(':direccion_entrega', $direccion_entrega);
            $stmt->bindParam(':fecha_estimada', $fecha_estimada);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Actualizar el estado de la entrega
    public function updateEntrega($id, $estado, $fecha_estimada) {
        try {
            $stmt = $this->conn->prepare("UPDATE entregas SET estado = :estado, fecha_estimada = :fecha_estimada WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':fecha_estimada', $fecha_estimada);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar una entrega
    public function deleteEntrega($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM entregas WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>

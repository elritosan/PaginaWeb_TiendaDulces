<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassPromocion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getPromociones() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM promociones");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getPromocionById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM promociones WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function setPromocion($id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO promociones (id_producto, descuento, fecha_inicio, fecha_fin) 
                                          VALUES (:id_producto, :descuento, :fecha_inicio, :fecha_fin)");
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':descuento', $descuento);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function updatePromocion($id, $descuento, $fecha_inicio, $fecha_fin) {
        try {
            $stmt = $this->conn->prepare("UPDATE promociones SET descuento = :descuento, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':descuento', $descuento);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deletePromocion($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM promociones WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
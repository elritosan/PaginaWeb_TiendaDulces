<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassPromocion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getPromociones() {
        $query = "SELECT * FROM promociones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromocionById($id) {
        $query = "SELECT * FROM promociones WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setPromocion($id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        $query = "INSERT INTO promociones (id_producto, descuento, fecha_inicio, fecha_fin) 
                  VALUES (:id_producto, :descuento, :fecha_inicio, :fecha_fin)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':descuento', $descuento);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->execute();
    }

    public function updatePromocion($id, $id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        $query = "UPDATE promociones SET id_producto = :id_producto, descuento = :descuento, 
                  fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':descuento', $descuento);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deletePromocion($id) {
        $query = "DELETE FROM promociones WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function obtenerDescuento($id_producto) {
        try {
            $stmt = $this->conn->prepare("
                SELECT descuento FROM promociones 
                WHERE id_producto = :id_producto 
                AND CURDATE() BETWEEN fecha_inicio AND fecha_fin
            ");
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['descuento'] : 0;
        } catch (PDOException $e) {
            return 0;
        }
    }   
}
?>
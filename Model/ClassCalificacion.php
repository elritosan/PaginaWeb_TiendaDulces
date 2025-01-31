<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassCalificacion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getCalificaciones() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM calificaciones");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getCalificacionById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM calificaciones WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function setCalificacion($id_usuario, $id_producto, $calificacion, $comentario) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO calificaciones (id_usuario, id_producto, calificacion, comentario) 
                                          VALUES (:id_usuario, :id_producto, :calificacion, :comentario)");
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':calificacion', $calificacion);
            $stmt->bindParam(':comentario', $comentario);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deleteCalificacion($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM calificaciones WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>

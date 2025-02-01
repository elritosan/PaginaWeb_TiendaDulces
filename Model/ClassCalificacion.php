<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassCalificacion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getCalificaciones() {
        $query = "SELECT * FROM calificaciones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCalificacionById($id) {
        $query = "SELECT * FROM calificaciones WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCalificacion($id_usuario, $id_producto, $calificacion, $comentario) {
        $query = "INSERT INTO calificaciones (id_usuario, id_producto, calificacion, comentario, fecha) 
                  VALUES (:id_usuario, :id_producto, :calificacion, :comentario, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':calificacion', $calificacion);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->execute();
    }

    public function updateCalificacion($id, $id_usuario, $id_producto, $calificacion, $comentario) {
        $query = "UPDATE calificaciones SET id_usuario = :id_usuario, id_producto = :id_producto, 
                  calificacion = :calificacion, comentario = :comentario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':calificacion', $calificacion);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteCalificacion($id) {
        $query = "DELETE FROM calificaciones WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
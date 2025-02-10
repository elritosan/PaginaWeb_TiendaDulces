<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassRol {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getRoles() {
        $stmt = $this->conn->prepare("SELECT * FROM roles");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRolById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setRol($nombrerol, $descripcion) {
        $stmt = $this->conn->prepare("INSERT INTO roles (nombrerol, descripcion) VALUES (:nombrerol, :descripcion)");
        $stmt->bindParam(':nombrerol', $nombrerol);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function updateRol($id, $nombrerol, $descripcion) {
        $stmt = $this->conn->prepare("UPDATE roles SET nombrerol = :nombrerol, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombrerol', $nombrerol);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function deleteRol($id) {
        $stmt = $this->conn->prepare("DELETE FROM roles WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
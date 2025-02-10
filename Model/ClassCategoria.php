<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassCategoria {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getCategorias() {
        $query = "SELECT * FROM categorias";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoriaById($id) {
        $query = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCategoria($nombre) {
        $query = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
    }

    public function updateCategoria($id, $nombre) {
        $query = "UPDATE categorias SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteCategoria($id) {
        $query = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function listarCategoria($busqueda = '') {
        try {
            if ($busqueda) {
                $stmt = $this->conn->prepare("SELECT * FROM categorias WHERE nombre LIKE :busqueda OR correo LIKE :busqueda");
                $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM categorias");
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
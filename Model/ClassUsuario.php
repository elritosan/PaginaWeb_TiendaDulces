<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassUsuario {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    // Obtener todos los usuarios
    public function getUsuarios() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Obtener usuario por ID
    public function getUsuarioById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Crear un nuevo usuario
    public function setUsuario($nombre, $correo, $contrasena, $tipo_usuario = 'cliente') {
        try {
            $hash_pass = password_hash($contrasena, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, tipo_usuario) 
                                          VALUES (:nombre, :correo, :contrasena, :tipo_usuario)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $hash_pass);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }    

    // Actualizar un usuario
    public function updateUsuario($id, $nombre, $correo, $tipo_usuario) {
        try {
            $stmt = $this->conn->prepare("UPDATE usuarios SET nombre = :nombre, correo = :correo, tipo_usuario = :tipo_usuario WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar un usuario
    public function deleteUsuario($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
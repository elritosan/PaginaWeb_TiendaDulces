<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassIniciarSesion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function verificarCredenciales($email, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE correo = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".$usuario['contrasena'];
            

            if ($usuario && password_verify($password, $usuario['contrasena'])) {
                return $usuario; // Devuelve los datos del usuario en lugar de un mensaje
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }
}

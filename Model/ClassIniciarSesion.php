<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassIniciarSesion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function validarCredenciales($correo, $contrasena) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE correo = :correo");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                return $usuario; // Retorna los datos del usuario
            } else {
                return null; // Credenciales incorrectas
            }
        } catch (PDOException $e) {
            return null;
        }
    }
}
?>
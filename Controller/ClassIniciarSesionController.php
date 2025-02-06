<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassIniciarSesion.php';

// Verifica si la sesión no está iniciada antes de llamarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ClassIniciarSesionController {
    private $auth;

    public function __construct() {
        $this->auth = new ClassIniciarSesion();
    }

    public function iniciarSesion($correo, $contrasena) {
        $usuario = $this->auth->validarCredenciales($correo, $contrasena);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit();
        } else {
            header("Location: index.php?entity=Login&action=login&error=1");
            exit();
        }
    }

    public function cerrarSesion() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
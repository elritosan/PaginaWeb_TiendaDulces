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

        if (!$this->auth) {
            die("Error: No se pudo cargar ClassIniciarSesion.");
        }
    }

    public function iniciarSesion($correo, $contrasena) {
        ob_start(); // Inicia el buffer de salida para evitar errores con header()

        $usuario = $this->auth->validarCredenciales($correo, $contrasena);
        
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            ob_end_clean(); // Limpia el buffer antes de redireccionar
            header("Location: index.php");
            exit();
        } else {
            ob_end_clean(); // Limpia el buffer antes de redireccionar
            header("Location: index.php?entity=Login&action=login&error=1");
            exit();
        }
    }

    public function cerrarSesion() {
        ob_start();
        session_destroy();
        ob_end_clean(); // Limpia el buffer antes de redireccionar
        header("Location: index.php");
        exit();
    }
}
?>

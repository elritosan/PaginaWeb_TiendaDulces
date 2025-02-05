<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassIniciarSesion.php';
session_start();

class ClassIniciarSesionController {
    private $modelo;

    public function __construct() {
        $this->modelo = new ClassIniciarSesion();
    }

    public function iniciarSesion($email, $password) {
        $usuario = $this->modelo->verificarCredenciales($email, $password);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            return $usuario;
        }
        return null;
    }

    public function cerrarSesion() {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
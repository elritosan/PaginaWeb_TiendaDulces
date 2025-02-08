<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

class ClassUsuarioController {

    public function getUsuarioController() {
        $usuarioModel = new ClassUsuario();
        return $usuarioModel->getUsuarios();
    }

    public function getUsuarioByIdController($id) {
        $usuarioModel = new ClassUsuario();
        return $usuarioModel->getUsuarioById($id);
    }

    public function setUsuarioController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $correo = $_POST['correo'] ?? null;
            $contrasena = $_POST['contrasena'] ?? null;
            $direccion = $_POST['direccion'] ?? null;
            $telefono = $_POST['telefono'] ?? null;
            $id_rol = $_POST['id_rol'] ?? null;
    
            $usuarioModel = new ClassUsuario();
            $usuarioModel->setUsuario($nombre, $correo, $contrasena, $direccion, $telefono, $id_rol);
            echo "<script>window.location.href = 'index.php?entity=Usuario&action=listar';</script>";
        }
    }    

    public function updateUsuarioController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'] ?? ''; // Si está vacío, se mantiene la actual
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $id_rol = $_POST['id_rol'];
    
            $usuarioModel = new ClassUsuario();
            $usuarioModel->updateUsuario($id, $nombre, $correo, $contrasena, $direccion, $telefono, $id_rol);
            echo "<script>window.location.href = 'index.php?entity=Usuario&action=listar';</script>";
        }
    }
    

    public function deleteUsuarioController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            
            $usuarioModel = new ClassUsuario();
            $usuarioModel->deleteUsuario($id);
            echo "<script>window.location.href = 'index.php?entity=Usuario&action=listar';</script>";
        }
    }    
}
?>
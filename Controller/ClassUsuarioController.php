<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

class ClassUsuarioController {

    public function getUsuarioController() {
        $usuarioModel = new ClassUsuario();
        $usuarios = $usuarioModel->getUsuarios();

        return $usuarios;
    }

    public function getUsuarioByIdController($id) {
        $usuarioModel = new ClassUsuario();
        $usuario = $usuarioModel->getUsuarioById($id);

        return $usuario;
    }

    public function setUsuarioController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $correo = $_POST['correo'] ?? null;
            $contrasena = $_POST['contrasena'] ?? null;
            $direccion = $_POST['direccion'] ?? null;
            $telefono = $_POST['telefono'] ?? null;
            $tipo_usuario = $_POST['tipo_usuario'] ?? 'cliente';
    
            if (!$nombre || !$correo || !$contrasena || !$direccion || !$telefono) {
                echo "Todos los campos son obligatorios.";
                return;
            }
    
            $usuarioModel = new ClassUsuario();
            $resultado = $usuarioModel->setUsuario($nombre, $correo, $contrasena, $direccion, $telefono, $tipo_usuario);
    
            if ($resultado === true) {
                echo "Usuario insertado con éxito!";
            } else {
                echo "Error al insertar usuario: " . $resultado;
            }
        }
    
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Usuario' . DIRECTORY_SEPARATOR . 'FormUsuario.php';
    }    

    public function updateUsuarioController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $tipo_usuario = $_POST['tipo_usuario'];

            $usuarioModel = new ClassUsuario();
            $usuarioModel->updateUsuario($id, $nombre, $correo, $tipo_usuario);
            echo "Usuario actualizado con éxito!";
        }
    }

    public function deleteUsuarioController($id) {
            $usuarioModel = new ClassUsuario();
            $usuarioModel->deleteUsuario($id);
            echo "Usuario Eliminado con éxito!";
    }   
}
?>
<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

class ClassUsuarioController {

    public function getUsuariosController() {
        $usuarioModel = new ClassUsuario();
        $usuarios = $usuarioModel->getUsuarios();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Usuario' . DIRECTORY_SEPARATOR . 'ListaUsuario.php';
    }

    public function getUsuarioByIdController($id) {
        $usuarioModel = new ClassUsuario();
        $usuario = $usuarioModel->getUsuarioById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Usuario' . DIRECTORY_SEPARATOR . 'DetalleUsuario.php';
    }

    public function setUsuariosController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $tipo_usuario = $_POST['tipo_usuario'] ?? 'cliente';

            $usuarioModel = new ClassUsuario();
            $usuarioModel->setUsuario($nombre, $correo, $contrasena, $tipo_usuario);
            echo "Usuario insertado con éxito!";
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

    public function deleteUsuarioController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $usuarioModel = new ClassUsuario();
            $usuarioModel->deleteUsuario($id);
            echo "Usuario eliminado con éxito!";
        }
    }
}
?>
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
    
            // Eliminar el usuario usando el modelo
            $usuarioModel = new ClassUsuario();
            $usuarioModel->deleteUsuario($id);
            $usuario = $_SESSION['usuario'] ?? null; // Recuperamos el usuario de la sesión
            $usuarioRol = $usuario['id_rol'] ?? 'guest';

            if ($usuarioRol == '2'){
                // Cerrar sesión
                session_start();
                session_unset();  // Elimina todas las variables de sesión
                session_destroy(); // Destruye la sesión
                
                // Redirigir al inicio (puedes modificar la URL según tu página de inicio)
                echo "<script>window.location.href = 'index.php';</script>";  // Redirige a la página principal
            }
            
            // Redirigir al inicio (puedes modificar la URL según tu página de inicio)
            echo "<script>window.location.href = 'index.php?entity=Usuario&action=listar';</script>"; 
        }
    }
    
    
    public function listarUsuariosController($busqueda = '') {
        // Instanciamos el modelo de usuario correctamente
        $usuarioModel = new ClassUsuario();
        
        // Ahora llamamos al método listarUsuarios en el modelo
        $usuarios = $usuarioModel->listarUsuarios($busqueda);
        
        return $usuarios;
    }
    
    
    
}
?>
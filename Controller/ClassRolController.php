<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassRol.php';

class ClassRolController {
    private $rolModel;

    public function __construct() {
        $this->rolModel = new ClassRol();
    }

    public function getRolController() {
        return $this->rolModel->getRoles();
    }

    public function getRolByIdController($id) {
        return $this->rolModel->getRolById($id);
    }

    public function setRolController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombrerol = $_POST['nombrerol'] ?? null;
            $descripcion = $_POST['descripcion'] ?? null;

            if (!$nombrerol) {
                echo "El nombre del rol es obligatorio.";
                return;
            }

            $this->rolModel->setRol($nombrerol, $descripcion);
            echo "<script>window.location.href = 'index.php?entity=Rol&action=listar';</script>";
        }
    }

    public function updateRolController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nombrerol = $_POST['nombrerol'] ?? null;
            $descripcion = $_POST['descripcion'] ?? null;

            if (!$id || !$nombrerol) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            $this->rolModel->updateRol($id, $nombrerol, $descripcion);
            echo "<script>window.location.href = 'index.php?entity=Rol&action=listar';</script>";
        }
    }

    public function deleteRolController($id) {
        $this->rolModel->deleteRol($id);
        echo "<script>window.location.href = 'index.php?entity=Rol&action=listar';</script>";
    }
}
?>
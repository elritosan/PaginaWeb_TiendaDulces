<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassCalificacion.php';

class ClassCalificacionController {

    public function getCalificacionController() {
        $calificacionModel = new ClassCalificacion();
        return $calificacionModel->getCalificaciones();
    }

    public function getCalificacionByIdController($id) {
        $calificacionModel = new ClassCalificacion();
        return $calificacionModel->getCalificacionById($id);
    }

    public function setCalificacionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_producto = $_POST['id_producto'];
            $calificacion = $_POST['calificacion'];
            $comentario = $_POST['comentario'];

            $calificacionModel = new ClassCalificacion();
            $calificacionModel->setCalificacion($id_usuario, $id_producto, $calificacion, $comentario);
            echo "<script>window.location.href = 'index.php?entity=Calificacion&action=listar';</script>";
        }
    }

    public function updateCalificacionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id_usuario = $_POST['id_usuario'];
            $id_producto = $_POST['id_producto'];
            $calificacion = $_POST['calificacion'];
            $comentario = $_POST['comentario'];

            $calificacionModel = new ClassCalificacion();
            $calificacionModel->updateCalificacion($id, $id_usuario, $id_producto, $calificacion, $comentario);
            echo "<script>window.location.href = 'index.php?entity=Calificacion&action=listar';</script>";
        }
    }

    public function deleteCalificacionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $calificacionModel = new ClassCalificacion();
            $calificacionModel->deleteCalificacion($id);
            echo "<script>window.location.href = 'index.php?entity=Calificacion&action=listar';</script>";
        }
    }
}
?>
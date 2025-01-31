<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassCalificacion.php';

class ClassCalificacionController {

    public function getCalificacionesController() {
        $calificacionModel = new ClassCalificacion();
        $calificaciones = $calificacionModel->getCalificaciones();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Calificacion' . DIRECTORY_SEPARATOR . 'ListaCalificacion.php';
    }

    public function getCalificacionByIdController($id) {
        $calificacionModel = new ClassCalificacion();
        $calificacion = $calificacionModel->getCalificacionById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Calificacion' . DIRECTORY_SEPARATOR . 'DetalleCalificacion.php';
    }

    public function setCalificacionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_producto = $_POST['id_producto'];
            $calificacion = $_POST['calificacion'];
            $comentario = $_POST['comentario'];

            $calificacionModel = new ClassCalificacion();
            $calificacionModel->setCalificacion($id_usuario, $id_producto, $calificacion, $comentario);
            echo "Calificación insertada con éxito!";
        }
    }

    public function deleteCalificacionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $calificacionModel = new ClassCalificacion();
            $calificacionModel->deleteCalificacion($id);
            echo "Calificación eliminada con éxito!";
        }
    }
}
?>
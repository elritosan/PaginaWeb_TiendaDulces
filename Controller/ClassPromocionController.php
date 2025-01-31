<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPromocion.php';

class ClassPromocionController {

    public function getPromocionesController() {
        $promocionModel = new ClassPromocion();
        $promociones = $promocionModel->getPromociones();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Promocion' . DIRECTORY_SEPARATOR . 'ListaPromocion.php';
    }

    public function getPromocionByIdController($id) {
        $promocionModel = new ClassPromocion();
        $promocion = $promocionModel->getPromocionById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Promocion' . DIRECTORY_SEPARATOR . 'DetallePromocion.php';
    }

    public function setPromocionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $descuento = $_POST['descuento'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $promocionModel = new ClassPromocion();
            $promocionModel->setPromocion($id_producto, $descuento, $fecha_inicio, $fecha_fin);
            echo "Promoción insertada con éxito!";
        }
    }

    public function updatePromocionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $descuento = $_POST['descuento'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $promocionModel = new ClassPromocion();
            $promocionModel->updatePromocion($id, $descuento, $fecha_inicio, $fecha_fin);
            echo "Promoción actualizada con éxito!";
        }
    }

    public function deletePromocionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $promocionModel = new ClassPromocion();
            $promocionModel->deletePromocion($id);
            echo "Promoción eliminada con éxito!";
        }
    }
}
?>
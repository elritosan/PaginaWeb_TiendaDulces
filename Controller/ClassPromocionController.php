<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPromocion.php';

class ClassPromocionController {

    public function getPromocionController() {
        $promocionModel = new ClassPromocion();
        return $promocionModel->getPromociones();
    }

    public function getPromocionByIdController($id) {
        $promocionModel = new ClassPromocion();
        return $promocionModel->getPromocionById($id);
    }

    public function setPromocionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $descuento = $_POST['descuento'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $promocionModel = new ClassPromocion();
            $promocionModel->setPromocion($id_producto, $descuento, $fecha_inicio, $fecha_fin);
            echo "<script>window.location.href = 'index.php?entity=Promocion&action=listar';</script>";
        }
    }

    public function updatePromocionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id_producto = $_POST['id_producto'];
            $descuento = $_POST['descuento'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $promocionModel = new ClassPromocion();
            $promocionModel->updatePromocion($id, $id_producto, $descuento, $fecha_inicio, $fecha_fin);
            echo "<script>window.location.href = 'index.php?entity=Promocion&action=listar';</script>";
        }
    }

    public function deletePromocionController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $promocionModel = new ClassPromocion();
            $promocionModel->deletePromocion($id);
            echo "<script>window.location.href = 'index.php?entity=Promocion&action=listar';</script>";
        }
    }

    public function listarPromocionController($busqueda = '') {
        // Instanciamos el modelo de usuario correctamente
        $promocionModel = new ClassPromocion();
        
        // Ahora llamamos al método listarUsuarios en el modelo
        $promocion = $promocionModel->listarPromocion($busqueda);
        
        return $promocion;
    }
}
?>
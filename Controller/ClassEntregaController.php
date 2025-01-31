<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassEntrega.php';

class ClassEntregaController {

    public function getEntregasController() {
        $entregaModel = new ClassEntrega();
        $entregas = $entregaModel->getEntregas();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Entrega' . DIRECTORY_SEPARATOR . 'ListaEntrega.php';
    }

    public function getEntregaByIdController($id) {
        $entregaModel = new ClassEntrega();
        $entrega = $entregaModel->getEntregaById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Entrega' . DIRECTORY_SEPARATOR . 'DetalleEntrega.php';
    }

    public function setEntregaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pedido = $_POST['id_pedido'];
            $direccion_entrega = $_POST['direccion_entrega'];
            $fecha_estimada = $_POST['fecha_estimada'];

            $entregaModel = new ClassEntrega();
            $entregaModel->setEntrega($id_pedido, $direccion_entrega, $fecha_estimada);
            echo "Entrega registrada con éxito!";
        }
    }

    public function updateEntregaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $estado = $_POST['estado'];
            $fecha_estimada = $_POST['fecha_estimada'];

            $entregaModel = new ClassEntrega();
            $entregaModel->updateEntrega($id, $estado, $fecha_estimada);
            echo "Estado de entrega actualizado con éxito!";
        }
    }

    public function deleteEntregaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $entregaModel = new ClassEntrega();
            $entregaModel->deleteEntrega($id);
            echo "Entrega eliminada con éxito!";
        }
    }
}
?>
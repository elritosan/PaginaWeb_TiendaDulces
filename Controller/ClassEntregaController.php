<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassEntrega.php';

class ClassEntregaController {

    public function getEntregaController() {
        $entregaModel = new ClassEntrega();
        return $entregaModel->getEntregas();
    }

    public function getEntregaByIdController($id) {
        $entregaModel = new ClassEntrega();
        return $entregaModel->getEntregaById($id);
    }

    public function setEntregaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pedido = $_POST['id_pedido'];
            $direccion_entrega = $_POST['direccion_entrega'];
            $fecha_estimada = $_POST['fecha_estimada'];
            $estado = $_POST['estado'];

            $entregaModel = new ClassEntrega();
            $entregaModel->setEntrega($id_pedido, $direccion_entrega, $fecha_estimada, $estado);
            echo "<script>window.location.href = 'index.php?entity=Entrega&action=listar';</script>";
        }
    }

    public function updateEntregaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id_pedido = $_POST['id_pedido'];
            $direccion_entrega = $_POST['direccion_entrega'];
            $fecha_estimada = $_POST['fecha_estimada'];
            $estado = $_POST['estado'];

            $entregaModel = new ClassEntrega();
            $entregaModel->updateEntrega($id, $id_pedido, $direccion_entrega, $fecha_estimada, $estado);
            echo "<script>window.location.href = 'index.php?entity=Entrega&action=listar';</script>";
        }
    }

    public function deleteEntregaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $entregaModel = new ClassEntrega();
            $entregaModel->deleteEntrega($id);
            echo "<script>window.location.href = 'index.php?entity=Entrega&action=listar';</script>";
        }
    }
}
?>
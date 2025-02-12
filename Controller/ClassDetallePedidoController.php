<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassDetallePedido.php';

class ClassDetallePedidoController {

    public function getDetallePedidoController() {
        $detallePedidoModel = new ClassDetallePedido();
        return $detallePedidoModel->getDetallesPedido();
    }

    public function getDetallePedidoByIdController($id) {
        $detallePedidoModel = new ClassDetallePedido();
        return $detallePedidoModel->getDetallePedidoById($id);
    }

    public function setDetallePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];

            $detallePedidoModel = new ClassDetallePedido();
            $detallePedidoModel->setDetallePedido($id_pedido, $id_producto, $cantidad, $precio_unitario);
            echo "<script>window.location.href = 'index.php?entity=DetallePedido&action=listar';</script>";
        }
    }

    public function updateDetallePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];

            $detallePedidoModel = new ClassDetallePedido();
            $detallePedidoModel->updateDetallePedido($id, $id_pedido, $id_producto, $cantidad, $precio_unitario);
            echo "<script>window.location.href = 'index.php?entity=DetallePedido&action=listar';</script>";
        }
    }

    public function deleteDetallePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $detallePedidoModel = new ClassDetallePedido();
            $detallePedidoModel->deleteDetallePedido($id);
            echo "<script>window.location.href = 'index.php?entity=DetallePedido&action=listar';</script>";
        }
    }
    public function listarDetallePedidoController($busqueda = '') {
        // Instanciamos el modelo de usuario correctamente
        $detallePedidoModel = new ClassDetallePedido();
        
        // Ahora llamamos al método listarUsuarios en el modelo
        $detallePedido = $detallePedidoModel->listarDetallePedido($busqueda);
        
        return $detallePedido;
    }
}
?>
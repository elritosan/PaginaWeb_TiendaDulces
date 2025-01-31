<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassDetallePedido.php';

class ClassDetallePedidoController {

    public function getDetallesPedidoController() {
        $detalleModel = new ClassDetallePedido();
        $detalles = $detalleModel->getDetallesPedido();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'DetallePedido' . DIRECTORY_SEPARATOR . 'ListaDetallePedido.php';
    }

    public function getDetallePedidoByIdController($id) {
        $detalleModel = new ClassDetallePedido();
        $detalle = $detalleModel->getDetallePedidoById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'DetallePedido' . DIRECTORY_SEPARATOR . 'DetalleDetallePedido.php';
    }

    public function setDetallePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];

            $detalleModel = new ClassDetallePedido();
            $detalleModel->setDetallePedido($id_pedido, $id_producto, $cantidad, $precio_unitario);
            echo "Detalle de pedido insertado con éxito!";
        }
    }

    public function updateDetallePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];

            $detalleModel = new ClassDetallePedido();
            $detalleModel->updateDetallePedido($id, $cantidad, $precio_unitario);
            echo "Detalle de pedido actualizado con éxito!";
        }
    }

    public function deleteDetallePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $detalleModel = new ClassDetallePedido();
            $detalleModel->deleteDetallePedido($id);
            echo "Detalle de pedido eliminado con éxito!";
        }
    }
}
?>
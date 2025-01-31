<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPedido.php';

class ClassPedidoController {

    public function getPedidosController() {
        $pedidoModel = new ClassPedido();
        $pedidos = $pedidoModel->getPedidos();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Pedido' . DIRECTORY_SEPARATOR . 'ListaPedido.php';
    }

    public function getPedidoByIdController($id) {
        $pedidoModel = new ClassPedido();
        $pedido = $pedidoModel->getPedidoById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Pedido' . DIRECTORY_SEPARATOR . 'DetallePedido.php';
    }

    public function setPedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $total = $_POST['total'];

            $pedidoModel = new ClassPedido();
            $pedidoModel->setPedido($id_usuario, $total);
            echo "Pedido registrado con éxito!";
        }
    }

    public function updatePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $estado = $_POST['estado'];

            $pedidoModel = new ClassPedido();
            $pedidoModel->updatePedido($id, $estado);
            echo "Pedido actualizado con éxito!";
        }
    }

    public function deletePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $pedidoModel = new ClassPedido();
            $pedidoModel->deletePedido($id);
            echo "Pedido eliminado con éxito!";
        }
    }
}
?>
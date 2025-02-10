<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPedido.php';

class ClassPedidoController {

    public function getPedidoController() {
        $pedidoModel = new ClassPedido();
        return $pedidoModel->getPedidos();
    }

    public function getPedidoByIdController($id) {
        $pedidoModel = new ClassPedido();
        return $pedidoModel->getPedidoById($id);
    }

    public function setPedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $total = $_POST['total'];
            $estado = $_POST['estado'];

            $pedidoModel = new ClassPedido();
            $pedidoModel->setPedido($id_usuario, $total, $estado);
            echo "<script>window.location.href = 'index.php?entity=Pedido&action=listar';</script>";
        }
    }

    public function updatePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id_usuario = $_POST['id_usuario'];
            $total = $_POST['total'];
            $estado = $_POST['estado'];

            $pedidoModel = new ClassPedido();
            $pedidoModel->updatePedido($id, $id_usuario, $total, $estado);
            echo "<script>window.location.href = 'index.php?entity=Pedido&action=listar';</script>";
        }
    }

    public function deletePedidoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $pedidoModel = new ClassPedido();
            $pedidoModel->deletePedido($id);
            echo "<script>window.location.href = 'index.php?entity=Pedido&action=listar';</script>";
        }
    }

    public function listarPedidoController($busqueda = '') {
        // Instanciamos el modelo de usuario correctamente
        $pedidoModel = new ClassPedido();
        
        // Ahora llamamos al método listarUsuarios en el modelo
        $pedidos = $marcaModel->listarPedido($busqueda);
        
        return $pedidos;
    }
}
?>
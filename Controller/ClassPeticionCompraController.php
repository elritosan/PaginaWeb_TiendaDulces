<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPeticionCompra.php';

class ClassPeticionCompraController {
    private $compraModel;

    public function __construct() {
        $this->compraModel = new ClassPeticionCompra();
    }

    public function procesarCompraController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $id_usuario = $_SESSION['usuario']['id'];
            $productos = json_decode(file_get_contents('php://input'), true)['carrito'] ?? [];
            $direccion_entrega = json_decode(file_get_contents('php://input'), true)['direccion'] ?? '';

            $resultado = $this->compraModel->procesarCompra($id_usuario, $productos, $direccion_entrega);

            header('Content-Type: application/json');
            echo json_encode($resultado);
        }
    }
}
?>
<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassDetallePedido.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPedido.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassEntrega.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPromocion.php';

class ClassPeticionCompra {
    private $detallePedidoModel;
    private $pedidoModel;
    private $entregaModel;
    private $productoModel;
    private $promocionModel;
    private $iva = 21; // IVA del 21%

    public function __construct() {
        $this->detallePedidoModel = new ClassDetallePedido();
        $this->pedidoModel = new ClassPedido();
        $this->entregaModel = new ClassEntrega();
        $this->productoModel = new ClassProducto();
        $this->promocionModel = new ClassPromocion();
    }

    public function procesarCompra($id_usuario, $productos, $direccion_entrega) {
        if (empty($productos)) {
            return ["status" => "error", "message" => "No hay productos en el carrito."];
        }

        $subtotal = 0;

        // Verificar stock y calcular precios
        foreach ($productos as $producto) {
            $stock_actual = $this->productoModel->obtenerStock($producto['id']);
            if ($producto['cantidad'] > $stock_actual) {
                return ["status" => "error", "message" => "Stock insuficiente para el producto: " . $producto['nombre']];
            }

            $descuento = $this->promocionModel->obtenerDescuento($producto['id']);
            $precio_final = $producto['precio'] * ((100 - $descuento) / 100);
            $subtotal += $precio_final * $producto['cantidad'];

            // Actualizar stock
            if (!$this->productoModel->actualizarStock($producto['id'], -$producto['cantidad'])) {
                return ["status" => "error", "message" => "Error al actualizar stock del producto: " . $producto['nombre']];
            }
        }

        // Calcular total con IVA
        $iva_monto = $subtotal * ($this->iva / 100);
        $total = $subtotal + $iva_monto;

        // Crear el pedido
        $id_pedido = $this->pedidoModel->crearPedido($id_usuario, $total);
        if (!$id_pedido) {
            return ["status" => "error", "message" => "Error al crear el pedido."];
        }

        // Insertar detalles del pedido
        foreach ($productos as $producto) {
            $this->detallePedidoModel->crearDetallePedido($id_pedido, $producto['id'], $producto['cantidad'], $producto['precio']);
        }

        // Crear la entrega
        $this->entregaModel->crearEntrega($id_pedido, $direccion_entrega);

        return ["status" => "success", "message" => "Compra realizada con éxito.", "total" => $total];
    }
}
?>
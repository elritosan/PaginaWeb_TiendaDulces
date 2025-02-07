<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassReporte {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getProductosMasVendidos() {
        $stmt = $this->conn->prepare("
            SELECT p.nombre AS producto, SUM(dp.cantidad) AS total_vendido
            FROM productos p
            JOIN detalles_pedido dp ON p.id = dp.id_producto
            GROUP BY p.id
            ORDER BY total_vendido DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPedidosPorEstado() {
        $stmt = $this->conn->prepare("
            SELECT p.estado AS estado_pedido, COUNT(*) AS cantidad
            FROM pedidos p
            GROUP BY p.estado
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVentasPorUsuario() {
        $stmt = $this->conn->prepare("
            SELECT u.nombre, SUM(p.total) AS total_compras
            FROM pedidos p
            JOIN usuarios u ON p.id_usuario = u.id
            WHERE p.estado = 'entregado'
            GROUP BY u.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductosEnPromocion() {
        $stmt = $this->conn->prepare("
            SELECT p.nombre AS producto, pr.descuento, pr.fecha_inicio, pr.fecha_fin
            FROM promociones pr
            JOIN productos p ON pr.id_producto = p.id
            WHERE CURDATE() BETWEEN pr.fecha_inicio AND pr.fecha_fin
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductosStockBajo() {
        $stmt = $this->conn->prepare("
            SELECT nombre, stock
            FROM productos
            WHERE stock < 10
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCalificacionesPorProducto() {
        $stmt = $this->conn->prepare("
            SELECT p.nombre AS producto, AVG(c.calificacion) AS calificacion_promedio, COUNT(c.id) AS cantidad_calificaciones
            FROM calificaciones c
            JOIN productos p ON c.id_producto = p.id
            GROUP BY p.id
            ORDER BY calificacion_promedio DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEntregasPorEstado() {
        $stmt = $this->conn->prepare("
            SELECT e.estado AS estado_entrega, COUNT(*) AS cantidad
            FROM entregas e
            GROUP BY e.estado
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPedidosPorFecha() {
        $stmt = $this->conn->prepare("
            SELECT DATE(fecha_pedido) AS fecha, COUNT(*) AS cantidad_pedidos, SUM(total) AS total_ventas
            FROM pedidos
            GROUP BY DATE(fecha_pedido)
            ORDER BY fecha DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductosMasCaros() {
        $stmt = $this->conn->prepare("
            SELECT nombre, precio
            FROM productos
            ORDER BY precio DESC
            LIMIT 10
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuariosMasCompras() {
        $stmt = $this->conn->prepare("
            SELECT u.nombre, SUM(p.total) AS total_compras
            FROM pedidos p
            JOIN usuarios u ON p.id_usuario = u.id
            WHERE p.estado = 'entregado'
            GROUP BY u.id
            ORDER BY total_compras DESC
            LIMIT 10
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
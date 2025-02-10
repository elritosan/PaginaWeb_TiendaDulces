<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassReporte.php';

class ClassReporteController {
    private $reporteModel;

    public function __construct() {
        $this->reporteModel = new ClassReporte();
    }

    public function getProductosMasVendidos() {
        return $this->reporteModel->getProductosMasVendidos();
    }

    public function getPedidosPorEstado() {
        return $this->reporteModel->getPedidosPorEstado();
    }

    public function getVentasPorUsuario() {
        return $this->reporteModel->getVentasPorUsuario();
    }

    public function getProductosEnPromocion() {
        return $this->reporteModel->getProductosEnPromocion();
    }

    public function getProductosStockBajo() {
        return $this->reporteModel->getProductosStockBajo();
    }

    public function getCalificacionesPorProducto() {
        return $this->reporteModel->getCalificacionesPorProducto();
    }

    public function getEntregasPorEstado() {
        return $this->reporteModel->getEntregasPorEstado();
    }

    public function getPedidosPorFecha() {
        return $this->reporteModel->getPedidosPorFecha();
    }

    public function getProductosMasCaros() {
        return $this->reporteModel->getProductosMasCaros();
    }

    public function getUsuariosMasCompras() {
        return $this->reporteModel->getUsuariosMasCompras();
    }
}
?>
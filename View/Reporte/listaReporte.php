<?php
$reporteController = new ClassReporteController();

$reportes = [
    "Productos Más Vendidos" => $reporteController->getProductosMasVendidos(),
    "Pedidos por Estado" => $reporteController->getPedidosPorEstado(),
    "Ventas por Usuario" => $reporteController->getVentasPorUsuario(),
    "Productos en Promoción" => $reporteController->getProductosEnPromocion(),
    "Productos con Stock Bajo" => $reporteController->getProductosStockBajo(),
    "Calificaciones por Producto" => $reporteController->getCalificacionesPorProducto(),
    "Entregas por Estado" => $reporteController->getEntregasPorEstado(),
    "Pedidos por Fecha" => $reporteController->getPedidosPorFecha(),
    "Productos Más Caros" => $reporteController->getProductosMasCaros(),
    "Usuarios con Más Compras" => $reporteController->getUsuariosMasCompras(),
];
?>

<h2>Reportes Generales</h2>

<?php foreach ($reportes as $titulo => $datos): ?>
    <h3><?php echo $titulo; ?></h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <?php if (!empty($datos)): ?>
                    <?php foreach (array_keys($datos[0]) as $columna): ?>
                        <th><?php echo ucfirst(str_replace('_', ' ', $columna)); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <?php foreach ($fila as $valor): ?>
                        <td><?php echo htmlspecialchars($valor); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Generales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo con colores vinos claros */
        body {
            background-color: #f8f5f2;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff8f6;
        }
        .card-header {
            background-color: #8b0000; /* Color vino oscuro */
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .table {
            margin-bottom: 0;
        }
        th {
            background-color: #b22222 !important; /* Color vino claro */
            color: white !important;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffe4e1; /* Rosa pálido */
        }
        tbody tr:hover {
            background-color: #fcd5ce !important; /* Color resaltado */
        }
        .btn-vino {
            background-color: #8b0000;
            color: white;
            transition: 0.3s;
        }
        .btn-vino:hover {
            background-color: #5a0000;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4 text-danger fw-bold">📊 Reportes Generales</h2>

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

    <?php foreach ($reportes as $titulo => $datos): ?>
        <div class="card mb-4">
            <div class="card-header"><?php echo $titulo; ?></div>
            <div class="card-body">
                <?php if (!empty($datos)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <?php foreach (array_keys($datos[0]) as $columna): ?>
                                        <th><?php echo ucfirst(str_replace('_', ' ', $columna)); ?></th>
                                    <?php endforeach; ?>
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
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">No hay datos disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

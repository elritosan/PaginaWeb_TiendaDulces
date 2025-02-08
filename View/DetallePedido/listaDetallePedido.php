<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

echo "<h2>Lista de Detalles de Pedido</h2>";
echo "<a href='index.php?entity=DetallePedido&action=insertar' class='btn btn-success mb-3'>Agregar Detalle</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Pedido</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Acciones</th>
      </tr></thead><tbody>";

// Instancia de la clase producto
$productoModel = new ClassProducto();

foreach ($listadoelementos as $detalle) {
    // Obtener producto por ID
    $producto = $productoModel->getProductoById($detalle['id_producto']);
    $nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";

    echo "<tr>";
    echo "<td>{$detalle['id']}</td>";
    echo "<td>{$detalle['id_pedido']}</td>";
    echo "<td>{$nombre_producto}</td>";
    echo "<td>{$detalle['cantidad']}</td>";
    echo "<td>{$detalle['precio_unitario']}</td>";
    echo "<td>
        <a href='index.php?entity=DetallePedido&action=detalle&id={$detalle['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

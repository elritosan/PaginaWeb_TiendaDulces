<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

echo "<h2>Lista de Promociones</h2>";
echo "<a href='index.php?entity=Promocion&action=insertar' class='btn btn-success mb-3'>Agregar Promoción</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>ID Producto</th><th>Nombre Producto</th><th>Descuento</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Acciones</th>
      </tr></thead><tbody>";

// Instancia de la clase producto
$productoModel = new ClassProducto();

foreach ($listadoelementos as $promocion) {
    // Obtener producto por ID
    $producto = $productoModel->getProductoById($promocion['id_producto']);
    $nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";

    echo "<tr>";
    echo "<td>{$promocion['id']}</td>";
    echo "<td>{$promocion['id_producto']}</td>";
    echo "<td>{$nombre_producto}</td>"; // Nueva columna con el nombre del producto
    echo "<td>{$promocion['descuento']}%</td>";
    echo "<td>{$promocion['fecha_inicio']}</td>";
    echo "<td>{$promocion['fecha_fin']}</td>";
    echo "<td>
        <a href='index.php?entity=Promocion&action=detalle&id={$promocion['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

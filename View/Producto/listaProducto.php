<?php
echo "<h2>Lista de Productos</h2>";
echo "<a href='index.php?entity=Producto&action=insertar' class='btn btn-success mb-3'>Agregar Producto</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Imagen</th><th>Precio</th><th>Stock</th><th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $producto) {
    echo "<tr>";
    echo "<td>{$producto['id']}</td>";
    echo "<td>{$producto['nombre']}</td>";
    echo "<td><img src='{$producto['imagen']}' width='100' height='100' style='object-fit: cover;'></td>";
    echo "<td>{$producto['precio']}</td>";
    echo "<td>{$producto['stock']}</td>";
    echo "<td>
        <a href='index.php?entity=Producto&action=detalle&id={$producto['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

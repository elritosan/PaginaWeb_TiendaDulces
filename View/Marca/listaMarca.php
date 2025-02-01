<?php
echo "<h2>Lista de Marcas</h2>";
echo "<a href='index.php?entity=Marca&action=insertar' class='btn btn-success mb-3'>Agregar Marca</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $marca) {
    echo "<tr>";
    echo "<td>{$marca['id']}</td>";
    echo "<td>{$marca['nombre']}</td>";
    echo "<td>
        <a href='index.php?entity=Marca&action=detalle&id={$marca['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
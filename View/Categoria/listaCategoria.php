<?php
echo "<h2>Lista de Categorías</h2>";
echo "<a href='index.php?entity=Categoria&action=insertar' class='btn btn-success mb-3'>Agregar Categoría</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $categoria) {
    echo "<tr>";
    echo "<td>{$categoria['id']}</td>";
    echo "<td>{$categoria['nombre']}</td>";
    echo "<td>
        <a href='index.php?entity=Categoria&action=detalle&id={$categoria['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
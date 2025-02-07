<?php
echo "<h2>Lista de Roles</h2>";
echo "<a href='index.php?entity=Rol&action=insertar' class='btn btn-success mb-3'>Agregar Rol</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Descripción</th>
        <th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $rol) {
    echo "<tr>";
    echo "<td>{$rol['id']}</td>";
    echo "<td>{$rol['nombrerol']}</td>";
    echo "<td>{$rol['descripcion']}</td>";
    echo "<td>
        <a href='index.php?entity=Rol&action=detalle&id={$rol['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
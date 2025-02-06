<?php
echo "<h2>Lista de Usuarios</h2>";
echo "<a href='index.php?entity=Usuario&action=insertar' class='btn btn-success mb-3'>Agregar Usuario</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Correo</th><th>Rol</th>
        <th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $usuario) {
    echo "<tr>";
    echo "<td>{$usuario['id']}</td>";
    echo "<td>{$usuario['nombre']}</td>";
    echo "<td>{$usuario['correo']}</td>";
    echo "<td>{$usuario['id_rol']}</td>";
    echo "<td>
        <a href='index.php?entity=Usuario&action=detalle&id={$usuario['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
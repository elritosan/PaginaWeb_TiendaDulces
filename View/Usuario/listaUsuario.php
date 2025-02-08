<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassRol.php';

echo "<h2>Lista de Usuarios</h2>";
echo "<a href='index.php?entity=Usuario&action=insertar' class='btn btn-success mb-3'>Agregar Usuario</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Correo</th><th>Rol</th>
        <th>Acciones</th>
      </tr></thead><tbody>";

// Instancia de la clase rol
$rolModel = new ClassRol();

foreach ($listadoelementos as $usuario) {
    // Obtener el rol por ID
    $rol = $rolModel->getRolById($usuario['id_rol']);
    $nombre_rol = $rol ? htmlspecialchars($rol['nombrerol']) : "No especificado";

    echo "<tr>";
    echo "<td>{$usuario['id']}</td>";
    echo "<td>{$usuario['nombre']}</td>";
    echo "<td>{$usuario['correo']}</td>";
    echo "<td>{$nombre_rol}</td>"; // Se muestra el nombre del rol en lugar del ID
    echo "<td>
        <a href='index.php?entity=Usuario&action=detalle&id={$usuario['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>

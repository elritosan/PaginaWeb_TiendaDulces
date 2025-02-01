<?php
echo "<h2>Lista de Calificaciones</h2>";
echo "<a href='index.php?entity=Calificacion&action=insertar' class='btn btn-success mb-3'>Agregar Calificación</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>ID Usuario</th><th>ID Producto</th><th>Calificación</th><th>Comentario</th><th>Fecha</th><th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $calificacion) {
    echo "<tr>";
    echo "<td>{$calificacion['id']}</td>";
    echo "<td>{$calificacion['id_usuario']}</td>";
    echo "<td>{$calificacion['id_producto']}</td>";
    echo "<td>{$calificacion['calificacion']}</td>";
    echo "<td>{$calificacion['comentario']}</td>";
    echo "<td>{$calificacion['fecha']}</td>";
    echo "<td>
        <a href='index.php?entity=Calificacion&action=detalle&id={$calificacion['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
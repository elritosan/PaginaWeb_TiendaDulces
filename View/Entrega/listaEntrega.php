<?php
echo "<h2>Lista de Entregas</h2>";
echo "<a href='index.php?entity=Entrega&action=insertar' class='btn btn-success mb-3'>Agregar Entrega</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>ID Pedido</th><th>Dirección</th><th>Fecha Estimada</th><th>Estado</th><th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $entrega) {
    echo "<tr>";
    echo "<td>{$entrega['id']}</td>";
    echo "<td>{$entrega['id_pedido']}</td>";
    echo "<td>{$entrega['direccion_entrega']}</td>";
    echo "<td>{$entrega['fecha_estimada']}</td>";
    echo "<td>{$entrega['estado']}</td>";
    echo "<td>
        <a href='index.php?entity=Entrega&action=detalle&id={$entrega['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
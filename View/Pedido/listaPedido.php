<?php
echo "<h2>Lista de Pedidos</h2>";
echo "<a href='index.php?entity=Pedido&action=insertar' class='btn btn-success mb-3'>Agregar Pedido</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Usuario</th><th>Total</th><th>Estado</th><th>Fecha</th><th>Acciones</th>
      </tr></thead><tbody>";

foreach ($listadoelementos as $pedido) {
    echo "<tr>";
    echo "<td>{$pedido['id']}</td>";
    echo "<td>{$pedido['id_usuario']}</td>";
    echo "<td>{$pedido['total']}</td>";
    echo "<td>{$pedido['estado']}</td>";
    echo "<td>{$pedido['fecha_pedido']}</td>";
    echo "<td>
        <a href='index.php?entity=Pedido&action=detalle&id={$pedido['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
    </td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
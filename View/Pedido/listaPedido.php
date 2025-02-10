<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

echo "<h2>Lista de Pedidos</h2>";
echo "<a href='index.php?entity=Pedido&action=insertar' class='btn btn-success mb-3'>Agregar Pedido</a>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Usuario (ID - Nombre)</th><th>Total</th><th>Estado</th><th>Fecha</th><th>Acciones</th>
      </tr></thead><tbody>";

// Instancia de la clase usuario
$usuarioModel = new ClassUsuario();

foreach ($listadoelementos as $pedido) {
    // Obtener usuario por ID
    $usuario = $usuarioModel->getUsuarioById($pedido['id_usuario']);
    $nombre_usuario = $usuario ? htmlspecialchars($usuario['nombre']) : "No especificado";

    echo "<tr>";
    echo "<td>{$pedido['id']}</td>";
    echo "<td>{$pedido['id_usuario']} - {$nombre_usuario}</td>";
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

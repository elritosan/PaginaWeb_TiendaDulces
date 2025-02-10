<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

echo "<h2>Lista de Pedidos</h2>";

echo "<div class='d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded'>";

// Botón Agregar Usuario con icono
echo "<a href='index.php?entity=Pedido&action=insertar' class='btn btn-success d-flex align-items-center'>
        <i class='fas fa-user-plus me-2'></i> Agregar Pedido
      </a>";

// Formulario de búsqueda con borde redondeado y mejor espaciado
echo "<form method='GET' action='index.php' class='d-flex bg-white p-2 rounded shadow-sm'>";
echo "<input type='hidden' name='entity' value='Pedido'>";
echo "<input type='hidden' name='action' value='listar'>";
echo "<input type='text' name='busqueda' class='form-control me-2 border-0' placeholder='🔍 Buscar Pedidos (ID)...' value='" . (isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '') . "'>";
echo "<button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button>";
echo "</form>";

echo "</div>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Usuario (ID - Nombre)</th><th>Total</th><th>Estado</th><th>Fecha</th><th>Acciones</th>
      </tr></thead><tbody>";

// Instancia de la clase usuario
$usuarioModel = new ClassUsuario();

// Obtener el valor de búsqueda si está definido
$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : null;

foreach ($listadoelementos as $pedido) {
    // Si $busqueda es null o vacío, mostrar todos los usuarios
    if (!empty($busqueda) && stripos($pedido['id'], $busqueda) === false) {
        continue; // Si no coincide el nombre, saltamos al siguiente usuario
    }

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


<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputBusqueda = document.querySelector("input[name='busqueda']");

    inputBusqueda.addEventListener("blur", function () {
        if (inputBusqueda.value.trim() === "") {
            window.location.href = "index.php?entity=Pedido&action=listar"; // Recarga sin parámetro 'busqueda'
        }
    });
});
</script>
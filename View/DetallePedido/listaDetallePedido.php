<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

echo "<h2>Lista de Detalles de Pedido</h2>";

echo "<div class='d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded'>";

// Botón Agregar Usuario con icono
echo "<a href='index.php?entity=DetallePedido&action=insertar' class='btn btn-success d-flex align-items-center'>
        <i class='fas fa-user-plus me-2'></i> Agregar Detalle
      </a>";

// Formulario de búsqueda con borde redondeado y mejor espaciado
echo "<form method='GET' action='index.php' class='d-flex bg-white p-2 rounded shadow-sm'>";
echo "<input type='hidden' name='entity' value='DetallePedido'>";
echo "<input type='hidden' name='action' value='listar'>";
echo "<input type='text' name='busqueda' class='form-control me-2 border-0 w-100' 
        style='min-width: 300px; font-size: 16px; height: 45px;' 
        placeholder='🔍 Buscar Detalle Pedido (ID Pedido)...' 
        value='" . (isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '') . "'>";
echo "<button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button>";
echo "</form>";

echo "</div>";

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Pedido</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Acciones</th>
      </tr></thead><tbody>";

// Instancia de la clase producto
$productoModel = new ClassProducto();

// Obtener el valor de búsqueda si está definido
$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : null; 

foreach ($listadoelementos as $detalle) {
    // Si $busqueda es null o vacío, mostrar todos los usuarios
    if (!empty($busqueda) && stripos($detalle['id_pedido'], $busqueda) === false) {
        continue; // Si no coincide el nombre, saltamos al siguiente usuario
    }

    // Obtener producto por ID
    $producto = $productoModel->getProductoById($detalle['id_producto']);
    $nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";

    echo "<tr>";
    echo "<td>{$detalle['id']}</td>";
    echo "<td>{$detalle['id_pedido']}</td>";
    echo "<td>{$nombre_producto}</td>";
    echo "<td>{$detalle['cantidad']}</td>";
    echo "<td>{$detalle['precio_unitario']}</td>";
    echo "<td>
        <a href='index.php?entity=DetallePedido&action=detalle&id={$detalle['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
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
            window.location.href = "index.php?entity=DetallePedido&action=listar"; // Recarga sin parámetro 'busqueda'
        }
    });
});
</script>

<?php
echo "<h2>Lista de Marcas</h2>";

// Contenedor flexible para alinear el botón y el formulario en la misma línea con mejor diseño
echo "<div class='d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded'>";

// Botón Agregar Usuario con icono
echo "<a href='index.php?entity=Marca&action=insertar' class='btn btn-success d-flex align-items-center'>
        <i class='fas fa-user-plus me-2'></i> Agregar Marca
      </a>";

// Formulario de búsqueda con borde redondeado y mejor espaciado
echo "<form method='GET' action='index.php' class='d-flex bg-white p-2 rounded shadow-sm'>";
echo "<input type='hidden' name='entity' value='Marca'>";
echo "<input type='hidden' name='action' value='listar'>";
echo "<input type='text' name='busqueda' class='form-control me-2 border-0' placeholder='🔍 Buscar Marcas...' value='" . (isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '') . "'>";
echo "<button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button>";
echo "</form>";

echo "</div>";


echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Nombre</th><th>Acciones</th>
      </tr></thead><tbody>";

// Obtener el valor de búsqueda si está definido
$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : null; 

foreach ($listadoelementos as $marca) {
    // Si $busqueda es null o vacío, mostrar todos los usuarios
    if (!empty($busqueda) && stripos($marca['nombre'], $busqueda) === false) {
        continue; // Si no coincide el nombre, saltamos al siguiente usuario
    }

    echo "<tr>";
    echo "<td>{$marca['id']}</td>";
    echo "<td>{$marca['nombre']}</td>";
    echo "<td>
        <a href='index.php?entity=Marca&action=detalle&id={$marca['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
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
            window.location.href = "index.php?entity=Marca&action=listar"; // Recarga sin parámetro 'busqueda'
        }
    });
});
</script>
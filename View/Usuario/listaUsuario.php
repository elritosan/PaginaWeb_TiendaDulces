<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassRol.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'ClassUsuarioController.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuarioController = new ClassUsuarioController();

$usuario = $_SESSION['usuario'] ?? null; // Recuperamos el usuario de la sesión
$usuarioRol = $usuario['id_rol'] ?? 'guest';


if ($usuarioRol == '2') {
    $usuarioModel = new ClassUsuario();
    $usuario = $usuarioModel->getUsuarioById($usuario['id']); // Recargar los datos

    // Instancia de la clase rol
    $rolModel = new ClassRol();
    $rol = $rolModel->getRolById($usuario['id_rol']);
    $nombre_rol = $rol ? htmlspecialchars($rol['nombrerol']) : "No especificado";
    
    
    echo "<h2>Usuario: " . htmlspecialchars($usuario['nombre']) . "</h2>";

    // Información del usuario
    echo '<ul class="list-group">';
    echo '<li class="list-group-item"><strong>ID:</strong> ' . htmlspecialchars($usuario['id']) . '</li>';
    echo '<li class="list-group-item"><strong>Nombre:</strong> ' . htmlspecialchars($usuario['nombre']) . '</li>';
    echo '<li class="list-group-item"><strong>Correo:</strong> ' . htmlspecialchars($usuario['correo']) . '</li>';
    echo '<li class="list-group-item"><strong>Dirección:</strong> ' . htmlspecialchars($usuario['direccion']) . '</li>';
    echo '<li class="list-group-item"><strong>Teléfono:</strong> ' . htmlspecialchars($usuario['telefono']) . '</li>';
    echo '<li class="list-group-item"><strong>Rol:</strong> ' . htmlspecialchars($nombre_rol ?? 'No especificado') . '</li>';
    echo '<li class="list-group-item"><strong>Fecha de Registro:</strong> ' . htmlspecialchars($usuario['fecha_registro']) . '</li>';
    echo '</ul>';

    // Botones de edición y eliminación
    echo '<div class="mt-3">';
    echo '<a href="index.php?entity=Usuario&action=editar&id=' . htmlspecialchars($usuario['id']) . '" class="btn btn-warning me-2">Editar</a>';

    // Formulario con confirmación de eliminación
    echo '<form id="deleteForm' . htmlspecialchars($usuario['id']) . '" method="POST" action="index.php" style="display:inline;">';
    echo '<input type="hidden" name="entity" value="Usuario">';
    echo '<input type="hidden" name="action" value="eliminar">';
    echo '<input type="hidden" name="id" value="' . htmlspecialchars($usuario['id']) . '">';
    echo '<button type="button" class="btn btn-danger" onclick="confirmarEliminacion(' . htmlspecialchars($usuario['id']) . ')">Eliminar</button>';
    echo '</form>';
    echo '</div>';

}


// Si el usuario es administrador (id_rol = 1), mostrar el botón y el formulario
if ($usuarioRol == '1') {
    echo "<h2>Lista de Usuarios</h2>";

    // Contenedor flexible para alinear el botón y el formulario en la misma línea con mejor diseño
    echo "<div class='d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded'>";

    // Botón Agregar Usuario con icono
    echo "<a href='index.php?entity=Usuario&action=insertar' class='btn btn-success d-flex align-items-center'>
            <i class='fas fa-user-plus me-2'></i> Agregar Usuario
        </a>";

    // Formulario de búsqueda con borde redondeado y mejor espaciado
    echo "<form method='GET' action='index.php' class='d-flex bg-white p-2 rounded shadow-sm'>";
    echo "<input type='hidden' name='entity' value='Usuario'>";
    echo "<input type='hidden' name='action' value='listar'>";
    echo "<input type='text' name='busqueda' class='form-control me-2 border-0' placeholder='🔍 Buscar usuario...' value='" . (isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '') . "'>";
    echo "<button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button>";
    echo "</form>";

    echo "</div>";

    echo "<table class='table table-striped'>";
    echo "<thead><tr>
            <th>ID</th><th>Nombre</th><th>Correo</th><th>Rol</th>
            <th>Acciones</th>
        </tr></thead><tbody>";

    // Instancia de la clase rol
    $rolModel = new ClassRol();

    // Obtener el valor de búsqueda si está definido
    $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : null; 

    foreach ($listadoelementos as $usuario) {
        // Si $busqueda es null o vacío, mostrar todos los usuarios
        if (!empty($busqueda) && stripos($usuario['nombre'], $busqueda) === false) {
            continue; // Si no coincide el nombre, saltamos al siguiente usuario
        }

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
    }


?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputBusqueda = document.querySelector("input[name='busqueda']");

    inputBusqueda.addEventListener("blur", function () {
        if (inputBusqueda.value.trim() === "") {
            window.location.href = "index.php?entity=Usuario&action=listar"; // Recarga sin parámetro 'busqueda'
        }
    });
});
</script>


<script>
function confirmarEliminacion(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("deleteForm" + id).submit();
        }
    });
}
</script>
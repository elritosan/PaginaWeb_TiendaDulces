<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'ClassUsuarioController.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassEntrega.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario = $_SESSION['usuario'] ?? null; // Recuperamos el usuario de la sesión
$usuarioRol = $usuario['id_rol'] ?? 'guest';

if ($usuarioRol == '2'){
    echo "<h2>Lista de Entregas</h2>";

    echo "<div class='d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded'>";

    // Formulario de búsqueda alineado a la derecha
    echo "<form method='GET' action='index.php' class='d-flex bg-white p-2 rounded shadow-sm ms-auto'>";
    echo "<input type='hidden' name='entity' value='Entrega'>";
    echo "<input type='hidden' name='action' value='listar'>";
    echo "<input type='text' name='busqueda' class='form-control me-2 border-0 w-100' 
            style='min-width: 300px; font-size: 16px; height: 45px;' 
            placeholder='🔍 Buscar Entrega (ID Pedido)...' 
            value='" . (isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '') . "'>";
    echo "<button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button>";
    echo "</form>";

    echo "</div>";


    echo "<table class='table table-striped'>";
    echo "<thead><tr>
            <th>ID</th><th>ID Pedido</th><th>Dirección</th><th>Fecha Estimada</th><th>Estado</th><th>Acciones</th>
        </tr></thead><tbody>";

    // Obtener el ID del usuario logueado
    $usuario_id_actual = $usuario['id']; // Obtén el ID del usuario autenticado

    // Obtener la conexión a la base de datos
    $database = new ClassDatabase();
    $db = $database->getConnection(); // Obtiene la conexión

    class Pedido {
        private $db;

        public function __construct($db) {
            $this->db = $db; // Asegúrate de pasar la conexión a la base de datos
        }

        // Función para obtener un pedido por su ID
        public function obtenerPedidoPorId($id_pedido) {
            $query = "SELECT * FROM pedidos WHERE id = :id_pedido LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_pedido', $id_pedido);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    // Crear instancia del modelo Pedido
    $pedidoModel = new Pedido($db); // Asegúrate de pasar la conexión a la base de datos

    // Obtener el valor de búsqueda si está definido
    $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : null;

    foreach ($listadoelementos as $entrega) {
        // Obtener el pedido asociado a la entrega
        $pedido = $pedidoModel->obtenerPedidoPorId($entrega['id_pedido']); 

        // Filtrar entregas según el id_usuario del pedido
        if ($pedido['id_usuario'] != $usuario_id_actual) {
            continue; // Si el pedido no pertenece al usuario, lo omitimos
        }

        // Filtrar por búsqueda si está definida
        if (!empty($busqueda) && stripos($entrega['id_pedido'], $busqueda) === false) {
            continue; 
        }

        // Mostrar datos de la entrega
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
}


if ($usuarioRol == '1'){
    echo "<h2>Lista de Entregas</h2>";

    echo "<div class='d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded'>";

    // Botón Agregar Usuario con icono
    echo "<a href='index.php?entity=Entrega&action=insertar' class='btn btn-success d-flex align-items-center'>
            <i class='fas fa-user-plus me-2'></i> Agregar Entrega
        </a>";

    // Formulario de búsqueda con borde redondeado y mejor espaciado
    echo "<form method='GET' action='index.php' class='d-flex bg-white p-2 rounded shadow-sm'>";
    echo "<input type='hidden' name='entity' value='Entrega'>";
    echo "<input type='hidden' name='action' value='listar'>";
    echo "<input type='text' name='busqueda' class='form-control me-2 border-0 w-100' 
            style='min-width: 300px; font-size: 16px; height: 45px;' 
            placeholder='🔍 Buscar Entrega (ID Pedido)...' 
            value='" . (isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '') . "'>";
    echo "<button type='submit' class='btn btn-primary'><i class='fas fa-search'></i></button>";
    echo "</form>";

    echo "</div>";

    echo "<table class='table table-striped'>";
    echo "<thead><tr>
            <th>ID</th><th>ID Pedido</th><th>Dirección</th><th>Fecha Estimada</th><th>Estado</th><th>Acciones</th>
        </tr></thead><tbody>";

    // Obtener el valor de búsqueda si está definido
    $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : null;

    foreach ($listadoelementos as $entrega) {
        // Si $busqueda es null o vacío, mostrar todos los usuarios
        if (!empty($busqueda) && stripos($entrega['id_pedido'], $busqueda) === false) {
            continue; // Si no coincide el nombre, saltamos al siguiente usuario
        }

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
    }


?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputBusqueda = document.querySelector("input[name='busqueda']");

    inputBusqueda.addEventListener("blur", function () {
        if (inputBusqueda.value.trim() === "") {
            window.location.href = "index.php?entity=Entrega&action=listar"; // Recarga sin parámetro 'busqueda'
        }
    });
});
</script>
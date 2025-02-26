<?php
// Definir la ruta base para evitar concatenaciones incorrectas
define('BASE_PATH', __DIR__);

// Obtener la entidad y la acción desde la URL (por defecto 'Usuario' y 'listar')
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Por Metodo POST";
    $entity = $_POST['entity'] ?? null;
    $action = $_POST['action'] ?? null;
    $id = $_POST['id'] ?? null;
} else {
    echo "Por Metodo GET";
    $entity = $_GET['entity'] ?? null;
    $action = $_GET['action'] ?? null;
    $id = $_GET['id'] ?? null;
}

echo "Entidad: ".$entity. " Acción: ".$action. " Id: ".$id;


// Mapeo de entidades con sus controladores correspondientes
$controllers = [
    'Usuario' => 'ClassUsuarioController',
    'Categoria' => 'ClassCategoriaController',
    'Marca' => 'ClassMarcaController',
    'Producto' => 'ClassProductoController',
    'Pedido' => 'ClassPedidoController',
    'DetallePedido' => 'ClassDetallePedidoController',
    'Promocion' => 'ClassPromocionController',
    'Calificacion' => 'ClassCalificacionController',
    'Entrega' => 'ClassEntregaController'
];

// Función para generar el menú
function createDropdownMenu($entity, $label, $icon) {
    return "
    <li class='nav-item dropdown'>
        <a class='nav-link' href='index.php?entity=$entity&action=listar' id='navbarDropdown-$entity' role='button' aria-expanded='false'>
            <i class='$icon'></i> $label
        </a>
    </li>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Tienda</title>

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/49ed2ef561.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="fas fa-store"></i> Tienda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php
                    echo createDropdownMenu('Usuario', 'Usuarios', 'fas fa-user');
                    echo createDropdownMenu('Categoria', 'Categorías', 'fas fa-list');
                    echo createDropdownMenu('Marca', 'Marcas', 'fas fa-tags');
                    echo createDropdownMenu('Producto', 'Productos', 'fas fa-box');
                    echo createDropdownMenu('Pedido', 'Pedidos', 'fas fa-shopping-cart');
                    echo createDropdownMenu('DetallePedido', 'Detalles Pedido', 'fas fa-receipt');
                    echo createDropdownMenu('Promocion', 'Promociones', 'fas fa-percent');
                    echo createDropdownMenu('Calificacion', 'Calificaciones', 'fas fa-star');
                    echo createDropdownMenu('Entrega', 'Entregas', 'fas fa-truck');
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // Verificar si la entidad existe en los controladores
        if (array_key_exists($entity, $controllers)) {
            require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $controllers[$entity] . '.php';
            $controller = new $controllers[$entity]();

            // Determinar la acción y llamar el método correspondiente
            if ($action === 'listar') {
                $listadoelementos = $controller->{"get" . $entity . "Controller"}();
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'lista' . $entity . '.php';
                
            } elseif ($action === 'insertar') {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->{"set" . $entity . "Controller"}();
                } else {
                    require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'form' . $entity . '.php';
                }
            } elseif ($action === 'editar' && $id) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->{"update" . $entity . "Controller"}();
                } else {
                    $elemento = $controller->{"get" . $entity . "ByIdController"}($id);
                    require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'form' . $entity . '.php';
                }
            } elseif ($action === 'detalle' && $id) {
                $elemento = $controller->{"get" . $entity . "ByIdController"}($id);
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'detalle' . $entity . '.php';
            } elseif ($action === 'eliminar' && $id) {
                $controller->{"delete" . $entity . "Controller"}($id);
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'eliminar' . $entity . '.php';
            } else {
                echo "<p class='text-danger'>Acción no válida</p>";
            }
        } else {
            echo "<p class='text-danger'>Entidad no válida</p>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir la ruta base para evitar concatenaciones incorrectas
define('BASE_PATH', __DIR__);

// Definir opciones de menú por tipo de usuario
$menuOpciones = [
    '1' => [
        'Rol' => 'fas fa-user',
        'Usuario' => 'fas fa-user',
        'Categoria' => 'fas fa-list',
        'Marca' => 'fas fa-tags',
        'Producto' => 'fas fa-box',
        'Pedido' => 'fas fa-shopping-cart',
        'DetallePedido' => 'fas fa-receipt',
        'Promocion' => 'fas fa-percent',
        'Entrega' => 'fas fa-truck',
        'Reporte' => 'fas fa-chart-bar'
    ],
    '2' => [
        'Usuario' => 'fas fa-user',
        'Calificacion' => 'fas fa-star',
        'PeticionCompra' => 'fas fa-shopping-cart',
        'Pedido' => 'fas fa-shopping-cart',
        'Entrega' => 'fas fa-truck',
    ]
];

// Obtener el tipo de usuario
$tipoUsuario = $_SESSION['usuario']['id_rol'] ?? '2';

// Obtener la entidad y la acción desde la URL (por defecto 'Usuario' y 'listar')
$entity = $_REQUEST['entity'] ?? null;
$action = $_REQUEST['action'] ?? null;
$id = $_REQUEST['id'] ?? null;

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
    'Entrega' => 'ClassEntregaController',
    'Rol' => 'ClassRolController',
    'Login' => 'ClassIniciarSesionController',
    'Reporte' => 'ClassReporteController',
    'PeticionCompra' => 'ClassPeticionCompraController'
];

// Función para generar el menú dinámicamente
function createDropdownMenu($entity, $label, $icon)
{
    return "
    <li class='nav-item'>
        <a class='nav-link' href='index.php?entity=$entity&action=listar'>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/49ed2ef561.js" crossorigin="anonymous"></script>

    <style>
        /* Estilo del menú en tonos rojos/vino */
        .navbar {
            background: linear-gradient(90deg, #B22222, #8B0000);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.6rem;
            color: white;
        }

        .nav-link {
            color: white !important;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }

        /* Estilos de la ventana modal */
        .modal-content {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        /* Fondo dinámico en la ventana modal */
        .modal-body {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .modal-body img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .modal-body img.active {
            opacity: 1;
        }

        .modal-text {
            position: absolute;
            z-index: 2;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="fas fa-store"></i> Tienda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php
                    foreach ($menuOpciones[$tipoUsuario] as $entidad => $icon) {
                        echo createDropdownMenu($entidad, $entidad, $icon);
                    }
                    ?>
                </ul>
                <!-- Opción de Login/Logout -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <a class="nav-link text-white" href="index.php?entity=Login&action=logout">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión (<?php echo $_SESSION['usuario']['nombre']; ?>)
                            </a>

                        <?php else: ?>
                            <a class="nav-link text-white" href="index.php?entity=Login&action=login">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
   
    <div class="container mt-4">
        <?php
        if (array_key_exists($entity, $controllers)) {
            require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $controllers[$entity] . '.php';
            $controller = new $controllers[$entity]();
            if ($entity === 'Reporte' && $action === 'listar') {
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Reporte' . DIRECTORY_SEPARATOR . 'listaReporte.php';
            } elseif ($entity === 'Login') {
                if ($action === 'login') {
                    require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Login.php';
                } elseif ($action === 'procesarLogin' && $_SERVER["REQUEST_METHOD"] == "POST") {
                    $controller->iniciarSesion($_POST['correo'], $_POST['contrasena']);
                } elseif ($action === 'logout') {
                    $controller->cerrarSesion();
                }
            } elseif ($entity === 'PeticionCompra' && $action === 'listar') {
                $controller->procesarCompraController();
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'lista' . $entity . '.php';
            } elseif ($action === 'listar') {
                $listadoelementos = $controller->{"get" . $entity . "Controller"}();
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'lista' . $entity . '.php';
            } elseif ($action === 'insertar') {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->{"set" . $entity . "Controller"}();
                } else {
                    require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'form' . $entity . '.php';
                }
            } elseif ($action === 'detalle' && $id) {
                $elemento = $controller->{"get" . $entity . "ByIdController"}($id);
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'detalle' . $entity . '.php';
            } elseif ($action === 'editar' && $id) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->{"update" . $entity . "Controller"}();
                } else {
                    $elemento = $controller->{"get" . $entity . "ByIdController"}($id);
                    require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'form' . $entity . '.php';
                }
            } elseif ($action === 'eliminar' && $id) {
                $controller->{"delete" . $entity . "Controller"}($id);
            }
            if ($entity === 'Usuario' && $action === 'listar') {
                // Verificar si existe el parámetro de búsqueda
                $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

                // Pasar la búsqueda al controlador
                $listadoelementos = $controller->listarUsuariosController($busqueda); // Método en tu controlador

                // Cargar la vista de listaUsuario.php
                require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $entity . DIRECTORY_SEPARATOR . 'lista' . $entity . '.php';
            }
        }
        ?>
    </div>
    <script>
        let index = 0;
        const images = document.querySelectorAll('.modal-body img');

        function cambiarImagen() {
            images[index].classList.remove('active');
            index = (index + 1) % images.length;
            images[index].classList.add('active');
        }

        setInterval(cambiarImagen, 3000);
    </script>
</body>

</html>
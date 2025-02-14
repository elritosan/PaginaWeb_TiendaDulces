<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está en sesión
$rolUsuario = isset($_SESSION['usuario']['id_rol']) ? $_SESSION['usuario']['id_rol'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #5a0e2c;
        }
        .container {
            max-width: 100%;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 1rem;
        }
        .table thead {
            background-color: #8a1c3b;
            color: white;
        }
        .btn-custom {
            background-color: #a83250;
            color: white;
        }
        .btn-custom:hover {
            background-color: #8a1c3b;
        }
        .star {
            font-size: 40px;
            transition: color 0.3s;
        }
        .img-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            background-color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lista de Calificaciones</h2>
        
        <?php if ($rolUsuario == 2): ?>
            <div class="d-flex justify-content-end mb-3">
                <a href='index.php?entity=Calificacion&action=insertar' class='btn btn-custom btn-lg'>Agregar Calificación</a>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Imagen</th>
                        <th>Calificación</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <?php if ($rolUsuario == 2): ?>
                            <th>Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usuarioModel = new ClassUsuario();
                    $productoModel = new ClassProducto();
                    
                    function generarEstrellas($calificacion) {
                        $stars = "";
                        for ($i = 1; $i <= 5; $i++) {
                            $stars .= "<span class='star' style='color: " . ($i <= $calificacion ? "gold" : "gray") . ";'>&#9733;</span>";
                        }
                        return $stars;
                    }
                    
                    foreach ($listadoelementos as $calificacion) {
                        $usuario = $usuarioModel->getUsuarioById($calificacion['id_usuario']);
                        $nombre_usuario = $usuario ? htmlspecialchars($usuario['nombre']) : "No especificado";
                        
                        $producto = $productoModel->getProductoById($calificacion['id_producto']);
                        $nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";
                        $imagen_producto = $producto && !empty($producto['imagen']) ? "<img src='" . htmlspecialchars($producto['imagen']) . "' class='img-thumbnail'>" : "No disponible";
                        
                        $calificacion_estrellas = generarEstrellas($calificacion['calificacion']);
                    ?>
                    <tr>
                        <td><?= $calificacion['id'] ?></td>
                        <td><?= $nombre_usuario ?></td>
                        <td><?= $nombre_producto ?></td>
                        <td><?= $imagen_producto ?></td>
                        <td><?= $calificacion_estrellas ?></td>
                        <td><?= htmlspecialchars($calificacion['comentario']) ?></td>
                        <td><?= htmlspecialchars($calificacion['fecha']) ?></td>
                        <?php if ($rolUsuario == 2): ?>
                            <td>
                                <a href='index.php?entity=Calificacion&action=detalle&id=<?= $calificacion['id'] ?>' class='btn btn-info btn-sm'>Ver Detalle</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

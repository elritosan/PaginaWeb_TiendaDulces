<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';


// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está en sesión
$rolUsuario = isset($_SESSION['usuario']['id_rol']) ? $_SESSION['usuario']['id_rol'] : null;


echo "<h2>Lista de Calificaciones</h2>";

// Mostrar botón "Agregar Calificación" solo si es usuario
if ($rolUsuario == 2) {
    echo "<a href='index.php?entity=Calificacion&action=insertar' class='btn btn-success mb-3'>Agregar Calificación</a>";
}

echo "<table class='table table-striped'>";
echo "<thead><tr>
        <th>ID</th><th>Usuario</th><th>Producto</th><th>Imagen</th><th>Calificación</th><th>Comentario</th><th>Fecha</th>";

// Mostrar la columna "Acciones" solo si el usuario es ADMIN
if ($rolUsuario == 2) {
    echo "<th>Acciones</th>";
}

echo "</tr></thead><tbody>";

// Instancias de las clases usuario y producto
$usuarioModel = new ClassUsuario();
$productoModel = new ClassProducto();

// Función para generar estrellas visuales en la tabla
function generarEstrellas($calificacion) {
    $stars = "";
    for ($i = 1; $i <= 5; $i++) {
        $stars .= "<span class='star' style='color: " . ($i <= $calificacion ? "gold" : "gray") . ";'>&#9733;</span>";
    }
    return $stars;
}

foreach ($listadoelementos as $calificacion) {
    // Obtener usuario por ID
    $usuario = $usuarioModel->getUsuarioById($calificacion['id_usuario']);
    $nombre_usuario = $usuario ? htmlspecialchars($usuario['nombre']) : "No especificado";

    // Obtener producto por ID
    $producto = $productoModel->getProductoById($calificacion['id_producto']);
    $nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";
    $imagen_producto = $producto && !empty($producto['imagen']) ? "<img src='" . htmlspecialchars($producto['imagen']) . "' width='50' height='50' style='object-fit: cover;'>" : "No disponible";

    // Convertir la calificación en estrellas
    $calificacion_estrellas = generarEstrellas($calificacion['calificacion']);

    echo "<tr>";
    echo "<td>{$calificacion['id']}</td>";
    echo "<td>{$nombre_usuario}</td>"; // Nueva columna con el nombre del usuario
    echo "<td>{$nombre_producto}</td>"; // Nueva columna con el nombre del producto
    echo "<td>{$imagen_producto}</td>"; // Nueva columna con la imagen del producto
    echo "<td>{$calificacion_estrellas}</td>"; // Mostrar calificación en estrellas
    echo "<td>{$calificacion['comentario']}</td>";
    echo "<td>{$calificacion['fecha']}</td>";
    // Mostrar acciones solo si el usuario es ADMIN
    if ($rolUsuario == 2) {
        echo "<td>
            <a href='index.php?entity=Calificacion&action=detalle&id={$calificacion['id']}' class='btn btn-info btn-sm'>Ver Detalle</a>
        </td>";
    }
    echo "</tr>";
}

echo "</tbody></table>";
?>

<style>
    .star {
        font-size: 20px;
        transition: color 0.3s;
    }
</style>

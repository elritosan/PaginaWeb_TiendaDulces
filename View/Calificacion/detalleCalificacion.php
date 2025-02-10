<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

$calificacion = $elemento ?? null;
if (!isset($calificacion) || empty($calificacion)) {
    echo "<p class='text-danger'>Calificación no encontrada.</p>";
    return;
}

// Instancias de las clases usuario y producto
$usuarioModel = new ClassUsuario();
$productoModel = new ClassProducto();

// Obtener usuario por ID
$usuario = $usuarioModel->getUsuarioById($calificacion['id_usuario']);
$nombre_usuario = $usuario ? htmlspecialchars($usuario['nombre']) : "No especificado";

// Obtener producto por ID
$producto = $productoModel->getProductoById($calificacion['id_producto']);
$nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";
$imagen_producto = $producto && !empty($producto['imagen']) ? "<img src='" . htmlspecialchars($producto['imagen']) . "' width='100' height='100' style='object-fit: cover;'>" : "No disponible";

// Función para generar estrellas visuales
function generarEstrellas($calificacion) {
    $stars = "";
    for ($i = 1; $i <= 5; $i++) {
        $stars .= "<span class='star' style='color: " . ($i <= $calificacion ? "gold" : "gray") . ";'>&#9733;</span>";
    }
    return $stars;
}

// Convertir la calificación en estrellas
$calificacion_estrellas = generarEstrellas($calificacion['calificacion']);
?>

<h2>Detalle de la Calificación</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($calificacion['id']); ?></li>
    <li class="list-group-item"><strong>Usuario:</strong> <?php echo $nombre_usuario; ?></li>
    <li class="list-group-item"><strong>Producto:</strong> <?php echo $nombre_producto; ?></li>
    <li class="list-group-item"><strong>Imagen del Producto:<br></strong> <?php echo $imagen_producto; ?></li>
    <li class="list-group-item"><strong>Calificación:</strong> <span class="star-container"><?php echo $calificacion_estrellas; ?></span></li>
    <li class="list-group-item"><strong>Comentario:</strong> <?php echo htmlspecialchars($calificacion['comentario']); ?></li>
    <li class="list-group-item"><strong>Fecha:</strong> <?php echo htmlspecialchars($calificacion['fecha']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Calificacion&action=editar&id=<?php echo $calificacion['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Calificacion">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($calificacion['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Calificacion&action=listar" class="btn btn-secondary">Volver</a>
</div>

<style>
    .star {
        font-size: 25px;
        transition: color 0.3s;
    }
</style>

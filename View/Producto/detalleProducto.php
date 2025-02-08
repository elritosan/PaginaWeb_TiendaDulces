<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassMarca.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassCategoria.php';

$producto = $elemento ?? null;
if (!isset($producto) || empty($producto)) {
    echo "<p class='text-danger'>Producto no encontrado.</p>";
    return;
}

// Instancias de las clases para obtener marca y categoría
$marcaModel = new ClassMarca();
$categoriaModel = new ClassCategoria();

$marca = $marcaModel->getMarcaById($producto['id_marca']);
$categoria = $categoriaModel->getCategoriaById($producto['id_categoria']);

// Obtener nombres o asignar "No especificado" en caso de error
$nombre_marca = $marca ? htmlspecialchars($marca['nombre']) : "No especificado";
$nombre_categoria = $categoria ? htmlspecialchars($categoria['nombre']) : "No especificado";

?>

<h2>Detalle del Producto</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($producto['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($producto['nombre']); ?></li>
    <li class="list-group-item"><strong>Marca:</strong> <?php echo $nombre_marca; ?></li>
    <li class="list-group-item"><strong>Categoría:</strong> <?php echo $nombre_categoria; ?></li>
    <li class="list-group-item"><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['descripcion']); ?></li>
    <li class="list-group-item"><strong>Precio:</strong> <?php echo htmlspecialchars($producto['precio']); ?></li>
    <li class="list-group-item"><strong>Stock:</strong> <?php echo htmlspecialchars($producto['stock']); ?></li>
    <li class="list-group-item"><strong>Imagen:</strong> <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" width="100"></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Producto&action=editar&id=<?php echo $producto['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Producto">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Producto&action=listar" class="btn btn-secondary">Volver</a>
</div>

<?php
$producto = $elemento ?? null;
if (!isset($producto) || empty($producto)) {
    echo "<p class='text-danger'>Producto no encontrado.</p>";
    return;
}
?>

<h2>Detalle del Producto</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($producto['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($producto['nombre']); ?></li>
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
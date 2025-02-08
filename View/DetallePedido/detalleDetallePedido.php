<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

$detallePedido = $elemento ?? null;
if (!isset($detallePedido) || empty($detallePedido)) {
    echo "<p class='text-danger'>Detalle de Pedido no encontrado.</p>";
    return;
}

// Instancia de la clase producto
$productoModel = new ClassProducto();
$producto = $productoModel->getProductoById($detallePedido['id_producto']);
$nombre_producto = $producto ? htmlspecialchars($producto['nombre']) : "No especificado";
?>

<h2>Detalle del Pedido</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($detallePedido['id']); ?></li>
    <li class="list-group-item"><strong>ID Pedido:</strong> <?php echo htmlspecialchars($detallePedido['id_pedido']); ?></li>
    <li class="list-group-item"><strong>Producto:</strong> <?php echo $nombre_producto; ?></li>
    <li class="list-group-item"><strong>Cantidad:</strong> <?php echo htmlspecialchars($detallePedido['cantidad']); ?></li>
    <li class="list-group-item"><strong>Precio Unitario:</strong> <?php echo htmlspecialchars($detallePedido['precio_unitario']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=DetallePedido&action=editar&id=<?php echo $detallePedido['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="DetallePedido">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($detallePedido['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=DetallePedido&action=listar" class="btn btn-secondary">Volver</a>
</div>

<?php
$pedido = $elemento ?? null;
if (!isset($pedido) || empty($pedido)) {
    echo "<p class='text-danger'>Pedido no encontrado.</p>";
    return;
}
?>

<h2>Detalle del Pedido</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($pedido['id']); ?></li>
    <li class="list-group-item"><strong>Usuario:</strong> <?php echo htmlspecialchars($pedido['id_usuario']); ?></li>
    <li class="list-group-item"><strong>Total:</strong> <?php echo htmlspecialchars($pedido['total']); ?></li>
    <li class="list-group-item"><strong>Estado:</strong> <?php echo htmlspecialchars($pedido['estado']); ?></li>
    <li class="list-group-item"><strong>Fecha Pedido:</strong> <?php echo htmlspecialchars($pedido['fecha_pedido']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Pedido&action=editar&id=<?php echo $pedido['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Pedido">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedido['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Pedido&action=listar" class="btn btn-secondary">Volver</a>
</div>
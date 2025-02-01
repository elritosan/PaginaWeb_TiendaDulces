<?php
$entrega = $elemento ?? null;
if (!isset($entrega) || empty($entrega)) {
    echo "<p class='text-danger'>Entrega no encontrada.</p>";
    return;
}
?>

<h2>Detalle de la Entrega</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($entrega['id']); ?></li>
    <li class="list-group-item"><strong>ID Pedido:</strong> <?php echo htmlspecialchars($entrega['id_pedido']); ?></li>
    <li class="list-group-item"><strong>Dirección:</strong> <?php echo htmlspecialchars($entrega['direccion_entrega']); ?></li>
    <li class="list-group-item"><strong>Fecha Estimada:</strong> <?php echo htmlspecialchars($entrega['fecha_estimada']); ?></li>
    <li class="list-group-item"><strong>Estado:</strong> <?php echo htmlspecialchars($entrega['estado']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Entrega&action=editar&id=<?php echo $entrega['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Entrega">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($entrega['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Entrega&action=listar" class="btn btn-secondary">Volver</a>
</div>
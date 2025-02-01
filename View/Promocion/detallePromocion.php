<?php
$promocion = $elemento ?? null;
if (!isset($promocion) || empty($promocion)) {
    echo "<p class='text-danger'>Promoción no encontrada.</p>";
    return;
}
?>

<h2>Detalle de la Promoción</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($promocion['id']); ?></li>
    <li class="list-group-item"><strong>ID Producto:</strong> <?php echo htmlspecialchars($promocion['id_producto']); ?></li>
    <li class="list-group-item"><strong>Descuento:</strong> <?php echo htmlspecialchars($promocion['descuento']); ?>%</li>
    <li class="list-group-item"><strong>Fecha Inicio:</strong> <?php echo htmlspecialchars($promocion['fecha_inicio']); ?></li>
    <li class="list-group-item"><strong>Fecha Fin:</strong> <?php echo htmlspecialchars($promocion['fecha_fin']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Promocion&action=editar&id=<?php echo $promocion['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Promocion">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($promocion['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Promocion&action=listar" class="btn btn-secondary">Volver</a>
</div>
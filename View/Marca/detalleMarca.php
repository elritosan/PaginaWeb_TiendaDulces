<?php
$marca = $elemento ?? null;
if (!isset($marca) || empty($marca)) {
    echo "<p class='text-danger'>Marca no encontrada.</p>";
    return;
}
?>

<h2>Detalle de la Marca</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($marca['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($marca['nombre']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Marca&action=editar&id=<?php echo $marca['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Marca">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($marca['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Marca&action=listar" class="btn btn-secondary">Volver</a>
</div>

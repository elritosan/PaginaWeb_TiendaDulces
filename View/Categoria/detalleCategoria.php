<?php
$categoria = $elemento ?? null;
if (!isset($categoria) || empty($categoria)) {
    echo "<p class='text-danger'>Categoría no encontrada.</p>";
    return;
}
?>

<h2>Detalle de la Categoría</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($categoria['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($categoria['nombre']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Categoria&action=editar&id=<?php echo $categoria['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Categoria">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($categoria['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Categoria&action=listar" class="btn btn-secondary">Volver</a>
</div>
<?php
$categoria = $elemento ?? null;
if (!isset($categoria) || empty($categoria)) {
    echo "<p class='text-danger'>Categoría no encontrada.</p>";
    return;
}
?>

<h2>Eliminar Categoría</h2>
<p>¿Estás seguro de que quieres eliminar la categoría <strong><?php echo htmlspecialchars($categoria['nombre']); ?></strong>?</p>

<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Categoria">
    <input type="hidden" name="action" value="eliminar">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($categoria['id']); ?>">
    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
    <a href="index.php?entity=Categoria&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

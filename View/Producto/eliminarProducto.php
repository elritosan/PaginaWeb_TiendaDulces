<?php
$producto = $elemento ?? null;
if (!isset($producto) || empty($producto)) {
    echo "<p class='text-danger'>Producto no encontrado.</p>";
    return;
}
?>

<h2>Eliminar Producto</h2>
<p>¿Estás seguro de que quieres eliminar el producto <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong>?</p>

<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Producto">
    <input type="hidden" name="action" value="eliminar">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
    <a href="index.php?entity=Producto&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

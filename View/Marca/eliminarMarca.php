<?php
$marca = $elemento ?? null;
if (!isset($marca) || empty($marca)) {
    echo "<p class='text-danger'>Marca no encontrada.</p>";
    return;
}
?>

<h2>Eliminar Marca</h2>
<p>¿Estás seguro de que quieres eliminar la marca <strong><?php echo htmlspecialchars($marca['nombre']); ?></strong>?</p>

<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Marca">
    <input type="hidden" name="action" value="eliminar">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($marca['id']); ?>">
    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
    <a href="index.php?entity=Marca&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

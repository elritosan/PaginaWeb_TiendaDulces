<?php
$marca = $elemento ?? null;
$marca = $marca ?? ['id' => '', 'nombre' => ''];
$isEdit = !empty($marca['id']);
?>

<h2><?php echo $isEdit ? 'Editar Marca' : 'Registrar Marca'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Marca">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($marca['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($marca['nombre']); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Marca&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

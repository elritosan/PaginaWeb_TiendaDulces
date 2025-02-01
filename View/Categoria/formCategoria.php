<?php
$categoria = $elemento ?? null;
$categoria = $categoria ?? ['id' => '', 'nombre' => ''];
$isEdit = !empty($categoria['id']);
?>

<h2><?php echo $isEdit ? 'Editar Categoría' : 'Registrar Categoría'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Categoria">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($categoria['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($categoria['nombre']); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Categoria&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
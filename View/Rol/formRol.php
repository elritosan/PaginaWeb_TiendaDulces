<?php
$rol = $elemento ?? ['id' => '', 'nombrerol' => '', 'descripcion' => ''];
$isEdit = !empty($rol['id']);
?>

<h2><?php echo $isEdit ? 'Editar Rol' : 'Registrar Rol'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Rol">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rol['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre del Rol</label>
        <input type="text" name="nombrerol" class="form-control" value="<?php echo htmlspecialchars($rol['nombrerol']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"><?php echo htmlspecialchars($rol['descripcion']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Rol&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
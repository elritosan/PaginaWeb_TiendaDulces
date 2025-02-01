<?php
$promocion = $elemento ?? null;
$promocion = $promocion ?? ['id' => '', 'id_producto' => '', 'descuento' => '', 'fecha_inicio' => '', 'fecha_fin' => ''];
$isEdit = !empty($promocion['id']);
?>

<h2><?php echo $isEdit ? 'Editar Promoción' : 'Registrar Promoción'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Promocion">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($promocion['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">ID Producto</label>
        <input type="text" name="id_producto" class="form-control" value="<?php echo htmlspecialchars($promocion['id_producto']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descuento (%)</label>
        <input type="number" step="0.01" name="descuento" class="form-control" value="<?php echo htmlspecialchars($promocion['descuento']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" class="form-control" value="<?php echo htmlspecialchars($promocion['fecha_inicio']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha Fin</label>
        <input type="date" name="fecha_fin" class="form-control" value="<?php echo htmlspecialchars($promocion['fecha_fin']); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Promocion&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
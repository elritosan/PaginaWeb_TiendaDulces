<?php
$calificacion = $elemento ?? null;
$calificacion = $calificacion ?? ['id' => '', 'id_usuario' => '', 'id_producto' => '', 'calificacion' => '', 'comentario' => ''];
$isEdit = !empty($calificacion['id']);
?>

<h2><?php echo $isEdit ? 'Editar Calificación' : 'Registrar Calificación'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Calificacion">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($calificacion['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">ID Usuario</label>
        <input type="text" name="id_usuario" class="form-control" value="<?php echo htmlspecialchars($calificacion['id_usuario']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ID Producto</label>
        <input type="text" name="id_producto" class="form-control" value="<?php echo htmlspecialchars($calificacion['id_producto']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Calificación</label>
        <input type="number" min="1" max="5" name="calificacion" class="form-control" value="<?php echo htmlspecialchars($calificacion['calificacion']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Comentario</label>
        <textarea name="comentario" class="form-control"><?php echo htmlspecialchars($calificacion['comentario']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Calificacion&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
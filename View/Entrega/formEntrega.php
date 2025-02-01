<?php
$entrega = $elemento ?? null;
$entrega = $entrega ?? ['id' => '', 'id_pedido' => '', 'direccion_entrega' => '', 'fecha_estimada' => '', 'estado' => 'pendiente'];
$isEdit = !empty($entrega['id']);
?>

<h2><?php echo $isEdit ? 'Editar Entrega' : 'Registrar Entrega'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Entrega">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($entrega['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">ID Pedido</label>
        <input type="text" name="id_pedido" class="form-control" value="<?php echo htmlspecialchars($entrega['id_pedido']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Dirección de Entrega</label>
        <input type="text" name="direccion_entrega" class="form-control" value="<?php echo htmlspecialchars($entrega['direccion_entrega']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha Estimada</label>
        <input type="date" name="fecha_estimada" class="form-control" value="<?php echo htmlspecialchars($entrega['fecha_estimada']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-control">
            <option value="pendiente" <?php echo ($entrega['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
            <option value="en camino" <?php echo ($entrega['estado'] == 'en camino') ? 'selected' : ''; ?>>En camino</option>
            <option value="entregado" <?php echo ($entrega['estado'] == 'entregado') ? 'selected' : ''; ?>>Entregado</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Entrega&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
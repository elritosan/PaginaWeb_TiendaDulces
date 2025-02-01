<?php
$detallePedido = $elemento ?? null;
$detallePedido = $detallePedido ?? ['id' => '', 'id_pedido' => '', 'id_producto' => '', 'cantidad' => '', 'precio_unitario' => ''];
$isEdit = !empty($detallePedido['id']);
?>

<h2><?php echo $isEdit ? 'Editar Detalle de Pedido' : 'Registrar Detalle de Pedido'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="DetallePedido">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($detallePedido['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Pedido</label>
        <input type="text" name="id_pedido" class="form-control" value="<?php echo htmlspecialchars($detallePedido['id_pedido']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Producto</label>
        <input type="text" name="id_producto" class="form-control" value="<?php echo htmlspecialchars($detallePedido['id_producto']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Cantidad</label>
        <input type="number" name="cantidad" class="form-control" value="<?php echo htmlspecialchars($detallePedido['cantidad']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio Unitario</label>
        <input type="number" step="0.01" name="precio_unitario" class="form-control" value="<?php echo htmlspecialchars($detallePedido['precio_unitario']); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=DetallePedido&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
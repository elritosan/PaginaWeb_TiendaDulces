<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';

$usuarioModel = new ClassUsuario();
$usuarios = $usuarioModel->getUsuario();


$pedido = $elemento ?? null;
$pedido = $pedido ?? ['id' => '', 'id_usuario' => '', 'total' => '', 'estado' => 'pendiente'];
$isEdit = !empty($pedido['id']);
?>

<h2><?php echo $isEdit ? 'Editar Pedido' : 'Registrar Pedido'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Pedido">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedido['id']); ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <select name="id_usuario" class="form-control" required>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario['id']; ?>" <?php echo $pedido['id_usuario'] == $usuario['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($usuario['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Total</label>
        <input type="number" step="0.01" name="total" class="form-control" 
            value="<?php echo htmlspecialchars($pedido['total']); ?>" 
            min="0.01" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-control">
            <option value="pendiente" <?php echo ($pedido['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
            <option value="enviado" <?php echo ($pedido['estado'] == 'enviado') ? 'selected' : ''; ?>>Enviado</option>
            <option value="entregado" <?php echo ($pedido['estado'] == 'entregado') ? 'selected' : ''; ?>>Entregado</option>
            <option value="cancelado" <?php echo ($pedido['estado'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Pedido&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
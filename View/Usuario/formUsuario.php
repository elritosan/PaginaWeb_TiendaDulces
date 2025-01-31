<?php
// $usuario = $elemento;
$usuario = $elemento ?? ['id' => '', 'nombre' => '', 'correo' => '', 'direccion' => '', 'telefono' => '', 'tipo_usuario' => 'cliente'];
$isEdit = !empty($usuario['id']); // Si tiene ID, es edición
?>

<h2><?php echo $isEdit ? 'Editar Usuario' : 'Registrar Usuario'; ?></h2>
<form method="POST" action="index.php">
    <!-- Enviar la entidad y acción en un input hidden -->
    <input type="hidden" name="entity" value="Usuario">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Correo</label>
        <input type="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="contrasena" class="form-control" <?php echo $isEdit ? '' : 'required'; ?>>
        <?php if ($isEdit) echo "<small class='text-muted'>Dejar en blanco para no cambiar.</small>"; ?>
    </div>
    <div class="mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" value="<?php echo htmlspecialchars($usuario['direccion']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo de Usuario</label>
        <select name="tipo_usuario" class="form-control">
            <option value="cliente" <?php echo $usuario['tipo_usuario'] == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
            <option value="admin" <?php echo $usuario['tipo_usuario'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Usuario&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

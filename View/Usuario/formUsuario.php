<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassRol.php';

$rolModel = new ClassRol();
$roles = $rolModel->getRoles();

$usuario = $elemento ?? ['id' => '', 'nombre' => '', 'correo' => '', 'direccion' => '', 'telefono' => '', 'id_rol' => ''];
$isEdit = !empty($usuario['id']);
?>

<h2><?php echo $isEdit ? 'Editar Usuario' : 'Registrar Usuario'; ?></h2>
<form method="POST" action="index.php">
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
        <input type="text" name="direccion" class="form-control" 
            value="<?php echo htmlspecialchars($usuario['direccion']); ?>" 
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" 
            value="<?php echo htmlspecialchars($usuario['telefono']); ?>" 
            maxlength="10" 
            pattern="[0-9]{10}" 
            title="Debe contener exactamente 10 dígitos" 
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
            required>
    </div>
    <div class="mb-3">
        <label class="form-label">Rol</label>
        <?php 
            $nombreRol = "";
            $idRolUsuarioEditado = $usuario['id_rol'] ?? ''; // El rol del usuario que se está editando

            // Obtener el nombre del rol actual del usuario editado
            foreach ($roles as $rol) {
                if ($rol['id'] == $idRolUsuarioEditado) {
                    $nombreRol = htmlspecialchars($rol['nombrerol']);
                    break;
                }
            }

            $usuarioSesion = $_SESSION['usuario'] ?? null; // Usuario logueado
            $rolUsuarioSesion = $usuarioSesion['id_rol'] ?? ''; // Rol del usuario logueado

            if ($rolUsuarioSesion == 2): // Si el usuario logueado es Cliente, solo mostrar sin editar
        ?>
            <input type="text" class="form-control" value="<?php echo $nombreRol ?: 'Cliente'; ?>" readonly>
            <input type="hidden" name="id_rol" value="<?php echo $idRolUsuarioEditado; ?>">
        <?php else: // Si el usuario logueado es administrador, permitir edición ?>
            <select name="id_rol" class="form-control">
                <?php foreach ($roles as $rol): ?>
                    <option value="<?php echo $rol['id']; ?>" <?php echo ($idRolUsuarioEditado == $rol['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($rol['nombrerol']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>


    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Usuario&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
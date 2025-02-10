<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassRol.php';

$usuario = $elemento;
if (!isset($usuario) || empty($usuario)) {
    echo "<p class='text-danger'>Usuario no encontrado.</p>";
    return;
}

// Instancia de la clase rol
$rolModel = new ClassRol();
$rol = $rolModel->getRolById($usuario['id_rol']);
$nombre_rol = $rol ? htmlspecialchars($rol['nombrerol']) : "No especificado";
?>

<h2>Detalle del Usuario</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($usuario['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></li>
    <li class="list-group-item"><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></li>
    <li class="list-group-item"><strong>Dirección:</strong> <?php echo htmlspecialchars($usuario['direccion']); ?></li>
    <li class="list-group-item"><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono']); ?></li>
    <li class="list-group-item"><strong>Rol:</strong> <?php echo $nombre_rol; ?></li>
    <li class="list-group-item"><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($usuario['fecha_registro']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Usuario&action=editar&id=<?php echo $usuario['id']; ?>" class="btn btn-warning">Editar</a>
    
    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Usuario">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
    
    <a href="index.php?entity=Usuario&action=listar" class="btn btn-secondary">Volver</a>
</div>
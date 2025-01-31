<?php
$usuario = $elemento;
if (!isset($usuario) || empty($usuario)) {
    echo "<p class='text-danger'>Usuario no encontrado.</p>";
    return;
}
?>

<h2>Detalle del Usuario</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($usuario['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></li>
    <li class="list-group-item"><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></li>
    <li class="list-group-item"><strong>Dirección:</strong> <?php echo htmlspecialchars($usuario['direccion']); ?></li>
    <li class="list-group-item"><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono']); ?></li>
    <li class="list-group-item"><strong>Tipo de Usuario:</strong> <?php echo htmlspecialchars($usuario['tipo_usuario']); ?></li>
    <li class="list-group-item"><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($usuario['fecha_registro']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Usuario&action=editar&id=<?php echo $usuario['id']; ?>" class="btn btn-warning">Editar</a>
    <a href="index.php?entity=Usuario&action=eliminar&id=<?php echo $usuario['id']; ?>" class="btn btn-danger">Eliminar</a>
    <a href="index.php?entity=Usuario&action=listar" class="btn btn-secondary">Volver</a>
</div>
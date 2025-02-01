<?php
$calificacion = $elemento ?? null;
if (!isset($calificacion) || empty($calificacion)) {
    echo "<p class='text-danger'>Calificación no encontrada.</p>";
    return;
}
?>

<h2>Detalle de la Calificación</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($calificacion['id']); ?></li>
    <li class="list-group-item"><strong>ID Usuario:</strong> <?php echo htmlspecialchars($calificacion['id_usuario']); ?></li>
    <li class="list-group-item"><strong>ID Producto:</strong> <?php echo htmlspecialchars($calificacion['id_producto']); ?></li>
    <li class="list-group-item"><strong>Calificación:</strong> <?php echo htmlspecialchars($calificacion['calificacion']); ?></li>
    <li class="list-group-item"><strong>Comentario:</strong> <?php echo htmlspecialchars($calificacion['comentario']); ?></li>
    <li class="list-group-item"><strong>Fecha:</strong> <?php echo htmlspecialchars($calificacion['fecha']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Calificacion&action=editar&id=<?php echo $calificacion['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;">
        <input type="hidden" name="entity" value="Calificacion">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($calificacion['id']); ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="index.php?entity=Calificacion&action=listar" class="btn btn-secondary">Volver</a>
</div>
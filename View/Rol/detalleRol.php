<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$rol = $elemento;
if (!isset($rol) || empty($rol)) {
    echo "<p class='text-danger'>Rol no encontrado.</p>";
    return;
}
?>

<h2>Detalle del Rol</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($rol['id']); ?></li>
    <li class="list-group-item"><strong>Nombre del Rol:</strong> <?php echo htmlspecialchars($rol['nombrerol']); ?></li>
    <li class="list-group-item"><strong>Descripción:</strong> <?php echo htmlspecialchars($rol['descripcion']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Rol&action=editar&id=<?php echo $rol['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;" id="deleteForm<?php echo $rol['id']; ?>">
        <input type="hidden" name="entity" value="Rol">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rol['id']); ?>">
        <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $rol['id']; ?>)">Eliminar</button>
    </form>

    <a href="index.php?entity=Rol&action=listar" class="btn btn-secondary">Volver</a>
</div>

<script>
function confirmarEliminacion(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("deleteForm" + id).submit();
        }
    });
}

</script>
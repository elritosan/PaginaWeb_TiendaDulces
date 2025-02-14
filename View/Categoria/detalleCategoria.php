<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$categoria = $elemento ?? null;
if (!isset($categoria) || empty($categoria)) {
    echo "<p class='text-danger'>Categoría no encontrada.</p>";
    return;
}
?>

<h2>Detalle de la Categoría</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($categoria['id']); ?></li>
    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($categoria['nombre']); ?></li>
</ul>

<div class="mt-3">
    <a href="index.php?entity=Categoria&action=editar&id=<?php echo $categoria['id']; ?>" class="btn btn-warning">Editar</a>

    <form method="POST" action="index.php" style="display:inline;" id="deleteForm<?php echo $categoria['id']; ?>">
        <input type="hidden" name="entity" value="Categoria">
        <input type="hidden" name="action" value="eliminar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($categoria['id']); ?>">
        <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $categoria['id']; ?>)">Eliminar</button>
    </form>

    <a href="index.php?entity=Categoria&action=listar" class="btn btn-secondary">Volver</a>
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
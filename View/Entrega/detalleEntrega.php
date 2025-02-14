<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassUsuario.php';
$entrega = $elemento ?? null;
if (!isset($entrega) || empty($entrega)) {
    echo "<p class='text-danger'>Entrega no encontrada.</p>";
    return;
}

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtener el usuario de la sesión y su rol
$usuarioo = $_SESSION['usuario'] ?? null;
$usuarioRol = $usuarioo['id_rol'] ?? 'guest';
?>

<h2>Detalle de la Entrega</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($entrega['id']); ?></li>
    <li class="list-group-item"><strong>ID Pedido:</strong> <?php echo htmlspecialchars($entrega['id_pedido']); ?></li>
    <li class="list-group-item"><strong>Dirección:</strong> <?php echo htmlspecialchars($entrega['direccion_entrega']); ?></li>
    <li class="list-group-item"><strong>Fecha Estimada:</strong> <?php echo htmlspecialchars($entrega['fecha_estimada']); ?></li>
    <li class="list-group-item"><strong>Estado:</strong> <?php echo htmlspecialchars($entrega['estado']); ?></li>
</ul>

<div class="mt-3">
    <?php if ($usuarioRol == '1') { ?>
        <a href="index.php?entity=Entrega&action=editar&id=<?php echo $entrega['id']; ?>" class="btn btn-warning">Editar</a>
    <?php } ?>

    <?php if ($usuarioRol == '1' || $usuarioRol == '2') { ?>
        <!-- Agregamos un id único al formulario -->
        <form id="deleteForm<?php echo $entrega['id']; ?>" method="POST" action="index.php" style="display:inline;">
            <input type="hidden" name="entity" value="Entrega">
            <input type="hidden" name="action" value="eliminar">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($entrega['id']); ?>">
            <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $entrega['id']; ?>)">Eliminar</button>
        </form>
    <?php } ?>

    <a href="index.php?entity=Entrega&action=listar" class="btn btn-secondary">Volver</a>
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
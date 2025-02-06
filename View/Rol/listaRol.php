<?php
$roles = $listadoelementos ?? [];
?>

<h2>Lista de Roles</h2>
<a href="index.php?entity=Rol&action=insertar" class="btn btn-success mb-3">Agregar Rol</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $rol): ?>
            <tr>
                <td><?php echo htmlspecialchars($rol['id']); ?></td>
                <td><?php echo htmlspecialchars($rol['nombrerol']); ?></td>
                <td><?php echo htmlspecialchars($rol['descripcion']); ?></td>
                <td>
                    <a href="index.php?entity=Rol&action=editar&id=<?php echo $rol['id']; ?>" class="btn btn-warning">Editar</a>
                    <a href="index.php?entity=Rol&action=detalle&id=<?php echo $rol['id']; ?>" class="btn btn-info">Ver</a>
                    <a href="index.php?entity=Rol&action=eliminar&id=<?php echo $rol['id']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
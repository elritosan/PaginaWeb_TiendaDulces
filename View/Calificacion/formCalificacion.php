<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

$productoModel = new ClassProducto();
$productos = $productoModel->getProductos();

$calificacion = $elemento ?? null;
$calificacion = $calificacion ?? ['id' => '', 'id_usuario' => $_SESSION['usuario']['id'] ?? '', 'id_producto' => '', 'calificacion' => '', 'comentario' => ''];
$isEdit = !empty($calificacion['id']);
?>

<h2><?php echo $isEdit ? 'Editar Calificación' : 'Registrar Calificación'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Calificacion">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($calificacion['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($calificacion['id_usuario']); ?>">
        <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['usuario']['nombre'] ?? ''); ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Producto</label>
        <select name="id_producto" class="form-control" required>
            <?php foreach ($productos as $producto): ?>
                <option value="<?php echo $producto['id']; ?>" <?php echo $calificacion['id_producto'] == $producto['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Calificación</label>
        <input type="number" min="1" max="5" name="calificacion" class="form-control" value="<?php echo htmlspecialchars($calificacion['calificacion']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Comentario</label>
        <textarea name="comentario" class="form-control"><?php echo htmlspecialchars($calificacion['comentario']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Calificacion&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
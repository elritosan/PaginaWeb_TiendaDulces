<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassCategoria.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassMarca.php';

$categoriaModel = new ClassCategoria();
$categorias = $categoriaModel->getCategorias();

$marcaModel = new ClassMarca();
$marcas = $marcaModel->getMarcas();

$producto = $elemento ?? null;
$producto = $producto ?? ['id' => '', 'nombre' => '', 'descripcion' => '', 'precio' => '', 'id_categoria' => '', 'id_marca' => '', 'stock' => '', 'imagen' => ''];
$isEdit = !empty($producto['id']);
?>

<h2><?php echo $isEdit ? 'Editar Producto' : 'Registrar Producto'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="Producto">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio</label>
        <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select name="id_categoria" class="form-control" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>" <?php echo $producto['id_categoria'] == $categoria['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($categoria['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Marca</label>
        <select name="id_marca" class="form-control" required>
            <?php foreach ($marcas as $marca): ?>
                <option value="<?php echo $marca['id']; ?>" <?php echo $producto['id_marca'] == $marca['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($marca['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Imagen (URL)</label>
        <input type="text" name="imagen" class="form-control" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Producto&action=listar" class="btn btn-secondary">Cancelar</a>
</form>
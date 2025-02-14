<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPedido.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

$usuarioModel = new ClassPedido();
$pedidos = $usuarioModel->getPedido($id);

$usuarioModel = new ClassProducto();
$productos = $usuarioModel->getProducto($id);

$detallePedido = $elemento ?? null;
$detallePedido = $detallePedido ?? ['id' => '', 'id_pedido' => '', 'id_producto' => '', 'cantidad' => '', 'precio_unitario' => ''];
$isEdit = !empty($detallePedido['id']);
?>

<h2><?php echo $isEdit ? 'Editar Detalle de Pedido' : 'Registrar Detalle de Pedido'; ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="entity" value="DetallePedido">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($detallePedido['id']); ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Pedido</label>
        <select name="id_pedido" class="form-control" required>
            <?php foreach ($pedidos as $pedido): ?>
                <option value="<?php echo $pedido['id']; ?>" <?php echo $detallePedido['id_pedido'] == $pedido['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($pedido['id']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Producto</label>
        <select name="id_producto" id="id_producto" class="form-control" required onchange="actualizarPrecio()">
            <option value="">Seleccione un producto</option>
            <?php foreach ($productos as $producto): ?>
                <option value="<?php echo $producto['id']; ?>" 
                        data-precio="<?php echo $producto['precio']; ?>"
                        <?php echo $detallePedido['id_producto'] == $producto['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Cantidad</label>
        <input type="number" name="cantidad" class="form-control" 
            value="<?php echo htmlspecialchars($detallePedido['cantidad']); ?>" 
            min="1" required >
    </div>
    <div class="mb-3">
        <label class="form-label">Precio Unitario</label>
        <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" 
               class="form-control" value="<?php echo htmlspecialchars($detallePedido['precio_unitario']); ?>" readonly>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=DetallePedido&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

<script>
function actualizarPrecio() {
    var selectProducto = document.getElementById("id_producto");
    var precioInput = document.getElementById("precio_unitario");

    var precio = selectProducto.options[selectProducto.selectedIndex].getAttribute("data-precio");
    precioInput.value = precio ? precio : "";
}
</script>
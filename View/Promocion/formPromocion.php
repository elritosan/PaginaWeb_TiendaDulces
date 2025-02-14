<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

$productoModel = new ClassProducto();
$productos = $productoModel->getProductos();

$promocion = $elemento ?? null;
$promocion = $promocion ?? ['id' => '', 'id_producto' => '', 'descuento' => '', 'fecha_inicio' => '', 'fecha_fin' => ''];
$isEdit = !empty($promocion['id']);

date_default_timezone_set('America/Guayaquil'); // Ajusta la zona horaria para Ecuador
$hoy = date('Y-m-d', strtotime('today'));



// Definir el rango permitido
$minFecha = date('Y-m-d', strtotime('-1 year')); // Máximo 1 año atrás
$maxFecha = date('Y-m-d', strtotime('+1 year')); // Máximo 1 año adelante
$promocion['fecha_inicio'] = $isEdit ? $promocion['fecha_inicio'] : $hoy;

// Forzar coherencia: La fecha fin no puede ser menor que la fecha inicio
if (!$isEdit || empty($promocion['fecha_fin']) || strtotime($promocion['fecha_fin']) < strtotime($promocion['fecha_inicio'])) {
    $promocion['fecha_fin'] = $promocion['fecha_inicio'];
}

// Definir variable para el error
$fechaError = '';
// Comprobamos el POST para validar fechas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];

    // Comprobamos si la fecha de fin es menor que la fecha de inicio
    if (strtotime($fechaFin) < strtotime($fechaInicio)) {
        $fechaError = 'La fecha de fin no puede ser menor que la fecha de inicio.';
    } else {
        // Aquí iría el código para procesar el formulario si las fechas son válidas
    }
}


?>

<?php if (!empty($fechaError)): ?>
    <div class="text-danger"><?php echo $fechaError; ?></div>
<?php endif; ?>

<h2><?php echo $isEdit ? 'Editar Promoción' : 'Registrar Promoción'; ?></h2>
<form method="POST" action="index.php" onsubmit="return validarFechas()">
    <input type="hidden" name="entity" value="Promocion">
    <input type="hidden" name="action" value="<?php echo $isEdit ? 'editar' : 'insertar'; ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($promocion['id']); ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Producto</label>
        <select name="id_producto" class="form-control" required>
            <?php foreach ($productos as $producto): ?>
                <option value="<?php echo $producto['id']; ?>" <?php echo $promocion['id_producto'] == $producto['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Descuento (%)</label>
        <input type="number" step="0.01" name="descuento" class="form-control" 
            value="<?php echo htmlspecialchars($promocion['descuento'] ?? ''); ?>" 
            required min="0.01" max="100">
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" class="form-control" 
            value="<?php echo htmlspecialchars($promocion['fecha_inicio'] ?? $hoy); ?>" 
            required min="<?php echo $hoy; ?>" max="<?php echo $maxFecha; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha Fin</label>
        <input type="date" name="fecha_fin" class="form-control" 
        value="<?php echo htmlspecialchars($promocion['fecha_fin'] ?? $hoy); ?>" 
        required min="<?php echo htmlspecialchars($promocion['fecha_inicio']); ?>" 
        max="<?php echo htmlspecialchars($maxFecha); ?>">
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?entity=Promocion&action=listar" class="btn btn-secondary">Cancelar</a>
</form>

<script>
    function validarFechas() {
    const fechaInicio = document.querySelector('input[name="fecha_inicio"]').value;
    const fechaFin = document.querySelector('input[name="fecha_fin"]').value;

    // Compara las fechas de inicio y fin
    if (new Date(fechaFin) < new Date(fechaInicio)) {
        // Usamos SweetAlert2 en lugar de alert()
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La fecha de fin no puede ser menor que la fecha de inicio.',
        });
        return false; // Evita el envío del formulario
    }

    return true; // Permite el envío del formulario
}

</script>
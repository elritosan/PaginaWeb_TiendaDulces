<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPromocion.php';

$productoModel = new ClassProducto();
$promocionModel = new ClassPromocion();
$productos = $productoModel->getProductos();
$carrito = $_SESSION['carrito'] ?? [];
$usuario_id = $_SESSION['usuario']['id'] ?? null; // Obtener ID de usuario de la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda en Línea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajusta la imagen dentro de la tarjeta */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        /* Factura fija en el lado derecho */
        .factura {
            position: sticky;
            top: 20px;
            max-height: 80vh;
            overflow-y: auto;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Ajuste del carrito para pantallas pequeñas */
        @media (max-width: 991px) {
            .factura {
                position: relative;
                top: auto;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body class="container mt-4">

    <!-- Título principal -->
    <h2 class="text-center mb-4">Catálogo de Productos</h2>

    <div class="row">
        <!-- Sección de Productos (Izquierda) -->
        <div class="col-lg-8">
            <div class="row">
                <?php foreach ($productos as $producto): 
                    $descuento = $promocionModel->obtenerDescuento($producto['id']);
                    $precio_final = $producto['precio'] * ((100 - $descuento) / 100);
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <p class="card-text">Precio: <strong id="precio-<?php echo $producto['id']; ?>"><?php echo number_format($producto['precio'], 2); ?> $</strong></p>
                                <?php if ($descuento > 0): ?>
                                    <p class="text-danger">Descuento: <strong id="promo-<?php echo $producto['id']; ?>"><?php echo $descuento; ?>%</strong></p>
                                <?php endif; ?>
                                <input type="number" id="cantidad-<?php echo $producto['id']; ?>" class="form-control mb-2" min="0" max="<?php echo $producto['stock']; ?>" value="0">
                                <button class="btn btn-primary w-100" onclick="agregarAlCarrito(<?php echo $producto['id']; ?>)">Añadir al carrito</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sección de Factura (Derecha, fija en la pantalla) -->
        <div class="col-lg-4">
            <div class="factura">
                <h4>Factura</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="lista-carrito"></tbody>
                </table>
                <p><strong>Subtotal:</strong> <span id="subtotal">0.00</span> $</p>
                <p><strong>IVA (15%):</strong> <span id="iva">0.00</span> $</p>
                <p><strong>Total:</strong> <span id="total">0.00</span> $</p>

                <div class="mb-3">
                    <label class="form-label">Dirección de Entrega</label>
                    <input type="text" id="direccion" class="form-control" required>
                </div>

                <button class="btn btn-success w-100" onclick="tramitarPedido()">Tramitar Pedido</button>
            </div>
        </div>
    </div>

    <script>
        let carrito = [];
        const IVA_PORCENTAJE = 15; 

        function agregarAlCarrito(id) {
            let cantidad = parseInt(document.getElementById(`cantidad-${id}`).value);
            let precio = parseFloat(document.getElementById(`precio-${id}`).textContent);
            let descuento = document.getElementById(`promo-${id}`) ? parseFloat(document.getElementById(`promo-${id}`).textContent) / 100 : 0;
            let precioFinal = precio * (1 - descuento);
            
            let index = carrito.findIndex(item => item.id === id);
            if (cantidad === 0) {
                if (index !== -1) {
                    carrito.splice(index, 1);
                }
            } else {
                if (index !== -1) {
                    carrito[index].cantidad = cantidad;
                } else {
                    carrito.push({ id, nombre: document.querySelector(`#cantidad-${id}`).parentElement.querySelector("h5").textContent, cantidad, precioFinal });
                }
            }
            actualizarCarrito();
        }

        function actualizarCarrito() {
            let listaCarrito = document.getElementById('lista-carrito');
            let subtotal = 0;
            listaCarrito.innerHTML = '';
            carrito.forEach(item => {
                let tr = document.createElement('tr');
                let subtotalProducto = item.precioFinal * item.cantidad;
                tr.innerHTML = `
                    <td>${item.nombre}</td>
                    <td>${item.cantidad}</td>
                    <td>${subtotalProducto.toFixed(2)} $</td>
                `;
                listaCarrito.appendChild(tr);
                subtotal += subtotalProducto;
            });

            let iva = subtotal * (IVA_PORCENTAJE / 100);
            let total = subtotal + iva;
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('iva').textContent = iva.toFixed(2);
            document.getElementById('total').textContent = total.toFixed(2);
        }

        async function tramitarPedido() {
            let usuarioId = "<?php echo $usuario_id; ?>"; 

            if (!usuarioId) {
                alert("Debes iniciar sesión para realizar una compra.");
                return;
            }

            if (carrito.length === 0) {
                alert("El carrito está vacío.");
                return;
            }

            let direccion = document.getElementById("direccion").value.trim();
            if (!direccion) {
                alert("Debe ingresar una dirección válida.");
                return;
            }

            let subtotal = parseFloat(document.getElementById('subtotal').textContent);
            let iva = parseFloat(document.getElementById('iva').textContent);
            let total = parseFloat(document.getElementById('total').textContent);

            try {
                let response = await fetch("index.php?entity=Pedido&action=registrar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ usuarioId, carrito, direccion, subtotal, iva, total })
                });

                let data = await response.json();

                if (data.status === "success") {
                    alert(`Compra realizada con éxito.\nTotal: ${data.total} $`);
                    carrito = [];
                    actualizarCarrito();
                    window.location.href = "index.php?entity=Pedido&action=listar";
                } else {
                    alert("Error en la compra: " + data.message);
                }
            } catch (error) {
                console.error("Error en la compra:", error);
                alert("Ocurrió un error inesperado. Inténtalo de nuevo.");
            }
        }
    </script>
</body>
</html>

<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassPromocion.php';

$productoModel = new ClassProducto();
$promocionModel = new ClassPromocion();
$productos = $productoModel->getProductos();
$carrito = $_SESSION['carrito'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda en Línea</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="productos">
        <?php foreach ($productos as $producto): 
            $descuento = $promocionModel->obtenerDescuento($producto['id']);
            $precio_final = $producto['precio'] * ((100 - $descuento) / 100);
        ?>
            <div class="producto">
                <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                <p><?php echo htmlspecialchars($producto['nombre']); ?></p>
                <p>Precio: <span id="precio-<?php echo $producto['id']; ?>"><?php echo number_format($producto['precio'], 2); ?></span> $</p>
                <?php if ($descuento > 0): ?>
                    <p>Promoción: <span id="promo-<?php echo $producto['id']; ?>"><?php echo $descuento; ?></span>% de descuento</p>
                <?php endif; ?>
                <input type="number" id="cantidad-<?php echo $producto['id']; ?>" min="0" max="<?php echo $producto['stock']; ?>" value="0">
                <button onclick="agregarAlCarrito(<?php echo $producto['id']; ?>)">Añadir al carrito</button>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="carrito">
        <h2>Factura</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Descuento</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="lista-carrito"></tbody>
        </table>
        <p>Subtotal: <span id="subtotal">0.00</span> $</p>
        <p>IVA (<span id="iva-porcentaje">21</span>%): <span id="iva">0.00</span> $</p>
        <p>Total: <span id="total">0.00</span> $</p>

        <div class="mb-3">
            <label class="form-label">Dirección de Entrega</label>
            <input type="text" id="direccion" class="form-control" required>
        </div>

        <button onclick="tramitarPedido()">Tramitar Pedido</button>
    </div>
    
    <script>
        let carrito = [];
        const IVA_PORCENTAJE = 21;

        function agregarAlCarrito(id) {
            let cantidad = parseInt(document.getElementById(`cantidad-${id}`).value);
            let precio = parseFloat(document.getElementById(`precio-${id}`).textContent);
            let promocion = document.getElementById(`promo-${id}`) ? parseFloat(document.getElementById(`promo-${id}`).textContent) / 100 : 0;
            let precioConDescuento = precio - (precio * promocion);
            
            let index = carrito.findIndex(item => item.id === id);
            if (cantidad === 0) {
                if (index !== -1) {
                    carrito.splice(index, 1);
                }
            } else {
                if (index !== -1) {
                    carrito[index].cantidad = cantidad;
                    carrito[index].precio = precio;
                    carrito[index].descuento = promocion;
                } else {
                    carrito.push({ id, nombre: document.querySelector(`#cantidad-${id}`).parentElement.querySelector("p").textContent, precio, descuento: promocion, cantidad });
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
                let subtotalProducto = item.precio * item.cantidad * (1 - item.descuento);
                tr.innerHTML = `
                    <td>${item.nombre}</td>
                    <td>${item.cantidad}</td>
                    <td>${item.precio.toFixed(2)} $</td>
                    <td>${(item.descuento * 100).toFixed(2)}%</td>
                    <td>${subtotalProducto.toFixed(2)} $</td>
                `;
                listaCarrito.appendChild(tr);
                subtotal += subtotalProducto;
            });

            let iva = subtotal * (IVA_PORCENTAJE / 100);
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('iva').textContent = iva.toFixed(2);
            document.getElementById('total').textContent = (subtotal + iva).toFixed(2);
            document.getElementById('iva-porcentaje').textContent = IVA_PORCENTAJE;
        }

        function tramitarPedido() {
            if (carrito.length === 0) {
                alert("El carrito está vacío.");
                return;
            }

            let direccion = document.getElementById("direccion").value;
            if (!direccion) {
                alert("Debe ingresar una dirección.");
                return;
            }

            fetch("index.php?entity=PeticionCompra&action=listar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ carrito, direccion })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Compra realizada con éxito. Total: " + data.total + " $");
                    carrito = [];
                    actualizarCarrito();
                    window.location.href = "index.php?entity=Pedido&action=listar"; // Redirige a listaPedido.php
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error en la compra:", error));
        }
    </script>
</body>
</html>
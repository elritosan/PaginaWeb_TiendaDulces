- 1. Listado de Usuarios Registrados
SELECT id, nombre, correo, telefono, tipo_usuario, fecha_registro 
FROM usuarios 
ORDER BY fecha_registro DESC;


- 2. Productos Más Vendidos
SELECT p.id, p.nombre, SUM(dp.cantidad) AS total_vendido
FROM detalles_pedido dp
JOIN productos p ON dp.id_producto = p.id
GROUP BY p.id, p.nombre
ORDER BY total_vendido DESC
LIMIT 10;

- 3. Pedidos por Usuario
SELECT u.id, u.nombre, COUNT(p.id) AS total_pedidos, SUM(p.total) AS gasto_total
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id
GROUP BY u.id, u.nombre
ORDER BY gasto_total DESC;


- 4. Pedidos Pendientes de Envío
SELECT p.id, u.nombre, p.total, p.estado, p.fecha_pedido
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id
WHERE p.estado = 'pendiente'
ORDER BY p.fecha_pedido ASC;
 
- 5. Ingresos Generados por Mes
SELECT DATE_FORMAT(fecha_pedido, '%Y-%m') AS mes, SUM(total) AS ingresos
FROM pedidos
GROUP BY mes
ORDER BY mes DESC;


- 6. Productos en Promoción Activa
SELECT p.id, p.nombre, p.precio, pr.descuento, 
       (p.precio - (p.precio * pr.descuento / 100)) AS precio_descuento
FROM promociones pr
JOIN productos p ON pr.id_producto = p.id
WHERE CURDATE() BETWEEN pr.fecha_inicio AND pr.fecha_fin;


- 8. Calificaciones y Opiniones de Productos
SELECT p.nombre, c.calificacion, c.comentario, u.nombre AS usuario, c.fecha
FROM calificaciones c
JOIN productos p ON c.id_producto = p.id
JOIN usuarios u ON c.id_usuario = u.id
ORDER BY c.fecha DESC;


- 9. Usuarios que no Han Realizado Pedidos
SELECT u.id, u.nombre, u.correo 
FROM usuarios u
LEFT JOIN pedidos p ON u.id = p.id_usuario
WHERE p.id IS NULL;


- 14. Categorías Más Vendidas
SELECT cat.nombre AS categoria, SUM(dp.cantidad) AS total_vendido
FROM detalles_pedido dp
JOIN productos p ON dp.id_producto = p.id
JOIN categorias cat ON p.id_categoria = cat.id
GROUP BY cat.id, cat.nombre
ORDER BY total_vendido DESC;


18. Usuarios que Más Compran
SELECT u.id, u.nombre, COUNT(p.id) AS total_pedidos, SUM(p.total) AS gasto_total
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id
GROUP BY u.id, u.nombre
ORDER BY gasto_total DESC
LIMIT 10;

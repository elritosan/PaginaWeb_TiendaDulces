1. Reporte de productos más vendidos (por cantidad):
SELECT p.nombre AS producto, SUM(dp.cantidad) AS total_vendido
FROM productos p
JOIN detalles_pedido dp ON p.id = dp.id_producto
GROUP BY p.id
ORDER BY total_vendido DESC;

2. Reporte de pedidos por estado:
SELECT p.estado AS estado_pedido, COUNT(*) AS cantidad
FROM pedidos p
GROUP BY p.estado;

3. Reporte de ventas por usuario:
SELECT u.nombre, SUM(p.total) AS total_compras
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id
WHERE p.estado = 'entregado'
GROUP BY u.id;


4. Reporte de productos en promoción:
SELECT p.nombre AS producto, pr.descuento, pr.fecha_inicio, pr.fecha_fin
FROM promociones pr
JOIN productos p ON pr.id_producto = p.id
WHERE CURDATE() BETWEEN pr.fecha_inicio AND pr.fecha_fin;


5. Reporte de productos con stock bajo (por debajo de un umbral específico, por ejemplo, 10 unidades):
SELECT nombre, stock
FROM productos
WHERE stock < 10;


6. Reporte de calificaciones por producto:
SELECT p.nombre AS producto, AVG(c.calificacion) AS calificacion_promedio, COUNT(c.id) AS cantidad_calificaciones
FROM calificaciones c
JOIN productos p ON c.id_producto = p.id
GROUP BY p.id
ORDER BY calificacion_promedio DESC;


7. Reporte de entregas por estado:
SELECT e.estado AS estado_entrega, COUNT(*) AS cantidad
FROM entregas e
GROUP BY e.estado;


8. Reporte de pedidos por fecha de registro:
SELECT DATE(fecha_pedido) AS fecha, COUNT(*) AS cantidad_pedidos, SUM(total) AS total_ventas
FROM pedidos
GROUP BY DATE(fecha_pedido)
ORDER BY fecha DESC;


9. Reporte de productos más caros:
SELECT nombre, precio
FROM productos
ORDER BY precio DESC
LIMIT 10;


10. Reporte de usuarios con más compras (por total gastado):
SELECT u.nombre, SUM(p.total) AS total_compras
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id
WHERE p.estado = 'entregado'
GROUP BY u.id
ORDER BY total_compras DESC
LIMIT 10;

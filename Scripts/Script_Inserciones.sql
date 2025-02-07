INSERT INTO roles (nombrerol, descripcion) VALUES 
('Administrador', 'Acceso total al sistema'),
('Cliente', 'Puede realizar compras y calificaciones');

-- INSERTANDO USUARIOS (DEPENDE DE ROLES)
INSERT INTO usuarios (nombre, correo, contrasena, direccion, telefono, id_rol) VALUES 
('Admin', 'admin@example.com', MD5('admin123'), 'Dirección 1', '123456789', 1),
('Carlos Pérez', 'carlos@example.com', MD5('cliente123'), 'Calle A #123', '0987654321', 2),
('María Gómez', 'maria@example.com', MD5('maria456'), 'Av. B #456', '0976543210', 2),
('Juan López', 'juan@example.com', MD5('juan789'), 'Calle C #789', '0965432109', 2),
('Ana Torres', 'ana@example.com', MD5('ana000'), 'Av. D #101', '0954321098', 2);
-- Insertando categorías de productos
INSERT INTO categorias (nombre) VALUES 
('Chocolates'),
('Caramelos'),
('Gomas y Gomitas'),
('Chicles');

-- Insertando marcas
INSERT INTO marcas (nombre) VALUES 
('Colombina'),
('Nestlé'),
('La Universal'),
('Confiteca');

-- Insertando productos
INSERT INTO productos (nombre, descripcion, precio, id_categoria, id_marca, stock, imagen) VALUES 
('Chocobon', 'Chocolate relleno de crema de leche', 2.50, 1, 2, 100, 'chocobon.jpg'),
('Bon Bon Bum', 'Chupete con chicle en su interior', 0.50, 2, 1, 200, 'bon_bon_bum.jpg'),
('Chocoleche', 'Chocolate con leche en barra', 1.75, 1, 2, 150, 'chocoleche.jpg'),
('Gomitas Frutales', 'Gomitas sabor a frutas tropicales', 1.00, 3, 4, 180, 'gomitas_frutales.jpg'),
('Chiclets Adams', 'Chicles de menta y frutas', 1.20, 4, 1, 130, 'chiclets_adams.jpg'),
('Milo Chocolate', 'Chocolate en barra con malta', 2.80, 1, 2, 110, 'milo_chocolate.jpg'),
('Colombina Coffee Delight', 'Caramelo sabor a café', 0.80, 2, 1, 190, 'coffee_delight.jpg'),
('Galak', 'Chocolate blanco de Nestlé', 2.90, 1, 2, 100, 'galak.jpg'),
('Gusanitos de Gomita', 'Gomitas en forma de gusano', 1.50, 3, 4, 170, 'gusanitos_gomita.jpg'),
('Wafer Universal', 'Galleta wafer rellena de chocolate', 1.80, 1, 3, 120, 'wafer_universal.jpg'),
('ChocoRamo', 'Ponqué con cobertura de chocolate', 2.20, 1, 1, 90, 'chocoramo.jpg'),
('Chiclets de Sandía', 'Chicles de sandía', 1.10, 4, 1, 140, 'chiclets_sandia.jpg'),
('Tango Chocolate', 'Galleta wafer cubierta de chocolate', 1.90, 1, 3, 130, 'tango_chocolate.jpg'),
('Confites de Chocolate', 'Dulces de chocolate con cobertura de colores', 2.00, 1, 4, 160, 'confites_chocolate.jpg'),
('Bombombum Tropical', 'Chupete con relleno de chicle sabor tropical', 0.55, 2, 1, 210, 'bombombum_tropical.jpg'),
('Alpino', 'Chocolate con leche de alta calidad', 3.00, 1, 2, 100, 'alpino.jpg'),
('Caramelo de Fresa', 'Caramelo masticable sabor fresa', 0.75, 2, 4, 200, 'caramelo_fresa.jpg'),
('Súper Gomas', 'Gomitas con sabores surtidos', 1.60, 3, 3, 180, 'super_gomas.jpg'),
('Chocokrispis Bar', 'Barra de arroz inflado con chocolate', 2.40, 1, 2, 110, 'chocokrispis_bar.jpg'),
('Dulce de Leche Confiteca', 'Caramelo cremoso sabor a dulce de leche', 1.30, 2, 4, 150, 'dulce_leche_confiteca.jpg');

-- Insertando promociones
INSERT INTO promociones (id_producto, descuento, fecha_inicio, fecha_fin) VALUES 
(1, 10.00, '2025-02-01', '2025-02-15'),
(3, 15.00, '2025-02-05', '2025-02-20'),
(7, 5.00, '2025-02-10', '2025-02-25'),
(9, 8.00, '2025-02-15', '2025-03-01'),
(14, 12.00, '2025-02-20', '2025-03-10');

-- Insertando pedidos
INSERT INTO pedidos (id_usuario, total, estado, fecha_pedido) VALUES 
(2, 15.75, 'pendiente', '2025-02-01'),
(3, 9.80, 'enviado', '2025-02-02'),
(4, 20.50, 'entregado', '2025-02-03'),
(5, 7.30, 'cancelado', '2025-02-04');

-- Insertando detalles del pedido
INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES 
(1, 2, 3, 0.50),
(1, 5, 2, 1.20),
(2, 6, 1, 2.80),
(2, 8, 2, 2.90),
(3, 10, 1, 1.80),
(3, 15, 2, 0.55),
(4, 18, 3, 1.60);

-- Insertando calificaciones
INSERT INTO calificaciones (id_usuario, id_producto, calificacion, comentario) VALUES 
(2, 1, 5, 'Muy delicioso, excelente calidad'),
(3, 5, 4, 'Rico, pero esperaba más sabor'),
(4, 10, 5, 'Me encanta, siempre lo compro'),
(5, 15, 3, 'Está bien, pero algo caro'),
(2, 18, 4, 'Buena opción de gomitas');

-- Insertando entregas
INSERT INTO entregas (id_pedido, direccion_entrega, fecha_estimada, estado) VALUES 
(1, 'Calle 123, Ciudad A', '2025-02-05', 'en camino'),
(2, 'Avenida 456, Ciudad B', '2025-02-06', 'entregado'),
(3, 'Calle 789, Ciudad C', '2025-02-07', 'pendiente'),
(4, 'Avenida 101, Ciudad D', '2025-02-08', 'cancelado');
-- INSERTAR USUARIOS
INSERT INTO usuarios (nombre, correo, contrasena, direccion, telefono, tipo_usuario) VALUES
('Juan Pérez', 'juan@example.com', 'hashed_password1', 'Calle 123, Ciudad', '555-1234', 'cliente'),
('María López', 'maria@example.com', 'hashed_password2', 'Avenida 456, Ciudad', '555-5678', 'cliente'),
('Carlos Admin', 'admin@example.com', 'hashed_admin', 'Oficina 789, Ciudad', '555-9999', 'admin');

-- INSERTAR CATEGORÍAS
INSERT INTO categorias (nombre) VALUES
('Chocolates'),
('Gomitas'),
('Caramelos'),
('Galletas'),
('Chicles');

-- INSERTAR MARCAS
INSERT INTO marcas (nombre) VALUES
('DulceManía'),
('ChocoDelight'),
('GomiWorld'),
('Caramelito'),
('CrunchyBites');

-- INSERTAR PRODUCTOS
INSERT INTO productos (nombre, descripcion, precio, id_categoria, id_marca, stock, imagen) VALUES
('Chocolate Amargo', 'Chocolate 70% cacao', 3.50, 1, 2, 100, 'url_imagen_1.jpg'),
('Gomitas Frutales', 'Gomitas con sabores variados', 2.00, 2, 3, 200, 'url_imagen_2.jpg'),
('Caramelos de Menta', 'Refrescantes caramelos de menta', 1.50, 3, 4, 150, 'url_imagen_3.jpg'),
('Galletas de Chocolate', 'Galletas con chispas de chocolate', 4.00, 4, 5, 120, 'url_imagen_4.jpg'),
('Chicles de Sandía', 'Chicles con sabor a sandía', 1.00, 5, 1, 250, 'url_imagen_5.jpg');

-- INSERTAR PROMOCIONES
INSERT INTO promociones (id_producto, descuento, fecha_inicio, fecha_fin) VALUES
(1, 10.00, '2025-02-01', '2025-02-15'),
(2, 15.00, '2025-02-05', '2025-02-20'),
(3, 5.00, '2025-02-10', '2025-02-25');

-- INSERTAR PEDIDOS
INSERT INTO pedidos (id_usuario, total, estado) VALUES
(1, 10.00, 'pendiente'),
(2, 5.50, 'enviado'),
(1, 8.00, 'entregado');

-- INSERTAR DETALLES DEL PEDIDO
INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES
(1, 1, 2, 3.50),
(1, 2, 1, 2.00),
(2, 3, 3, 1.50),
(3, 4, 2, 4.00);

-- INSERTAR CALIFICACIONES
INSERT INTO calificaciones (id_usuario, id_producto, calificacion, comentario) VALUES
(1, 1, 5, 'Delicioso chocolate, muy recomendado'),
(2, 2, 4, 'Gomitas ricas pero algo dulces'),
(1, 3, 3, 'Caramelos de menta refrescantes');

-- INSERTAR ENTREGAS
INSERT INTO entregas (id_pedido, direccion_entrega, fecha_estimada, estado) VALUES
(1, 'Calle 123, Ciudad', '2025-02-05', 'pendiente'),
(2, 'Avenida 456, Ciudad', '2025-02-06', 'en camino'),
(3, 'Calle 123, Ciudad', '2025-02-07', 'entregado');

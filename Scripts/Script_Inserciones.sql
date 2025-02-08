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
('Chocobon', 'Chocolate relleno de crema de leche', 2.50, 1, 2, 100, 'https://i0.wp.com/rosendoguaman.com.ec/wp-content/uploads/2020/05/7802225511520BONOBON18.png?fit=1000%2C778&ssl=1'),
('Bon Bon Bum', 'Chupete con chicle en su interior', 0.50, 2, 1, 200, 'https://www.supermercadosantamaria.com/documents/10180/10504/155103080_G.jpg'),
('Chocoleche', 'Chocolate con leche en barra', 1.75, 1, 2, 150, 'https://cdn.shoplightspeed.com/shops/649049/files/47148249/1652x1652x2/nestle-carlos-v-choco-leche.jpg'),
('Gomitas Frutales', 'Gomitas sabor a frutas tropicales', 1.00, 3, 4, 180, 'https://mundocaramelo.com.ec/cdn/shop/files/MogulJellyButtons1000g..png?v=1721001399&width=1100'),
('Chiclets Adams', 'Chicles de menta y frutas', 1.20, 4, 1, 130, 'https://assets.tuzonamarket.co/images/producto/fQ8cIffgx5.jpg'),
('Milo Chocolate', 'Chocolate en barra con malta', 2.80, 1, 2, 110, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRnJ_8j64DpHy65FY57qxCKaIi_mzuaFhxBw&s'),
('Colombina Coffee Delight', 'Caramelo sabor a café', 0.80, 2, 1, 190, 'https://colombinacontentmanager-prd.s3.us-east-1.amazonaws.com/Dulces/7702011001771_A1N1_es.jpg'),
('Galak', 'Chocolate blanco de Nestlé', 2.90, 1, 2, 100, 'https://www.fybeca.com/dw/image/v2/BDPM_PRD/on/demandware.static/-/Sites-masterCatalog_FybecaEcuador/default/dw9890c782/images/large/100137432_1.jpg?sw=1000&sh=1000'),
('Gusanitos de Gomita', 'Gomitas en forma de gusano', 1.50, 3, 4, 170, 'https://mundodulces17.com/wp-content/uploads/2023/03/gusanos.jpg'),
('Wafer Universal', 'Galleta wafer rellena de chocolate', 1.80, 1, 3, 120, 'https://36580daefdd0e4c6740b-4fe617358557d0f7b1aac6516479e176.ssl.cf1.rackcdn.com/products/31253.41486.jpg'),
('ChocoRamo', 'Ponqué con cobertura de chocolate', 2.20, 1, 1, 90, 'https://olimpica.vtexassets.com/arquivos/ids/946533-800-450?v=638042216830070000&width=800&height=450&aspect=true'),
('Chiclets de Sandía', 'Chicles de sandía', 1.10, 4, 1, 140, 'https://cdn1.totalcommerce.cloud/homesentry/product-zoom/es/chicle-fini-16927-x-80gr-sabor-a-sandia-1.webp'),
('Tango Chocolate', 'Galleta wafer cubierta de chocolate', 1.90, 1, 3, 130, 'https://www.nestle.com.ec/sites/g/files/pydnoa396/files/asset-library/publishingimages/tangoimg.jpg'),
('Confites de Chocolate', 'Dulces de chocolate con cobertura de colores', 2.00, 1, 4, 160, 'https://www.confiteriaminerva.com/wp-content/uploads/BOMBON.CONF_.jpg'),
('Bombombum Tropical', 'Chupete con relleno de chicle sabor tropical', 0.55, 2, 1, 210, 'https://colombinacontentmanager-prd.s3.us-east-1.amazonaws.com/Dulces/7702011076557_A1N1_es.jpg'),
('Alpino', 'Chocolate con leche de alta calidad', 3.00, 1, 2, 100, 'https://static.wixstatic.com/media/240d41_afb427e4fc01413ba1ca11a6ba0aaabb.jpg/v1/fill/w_480,h_480,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/240d41_afb427e4fc01413ba1ca11a6ba0aaabb.jpg'),
('Caramelo de Fresa', 'Caramelo masticable sabor fresa', 0.75, 2, 4, 200, 'https://res.cloudinary.com/riqra/image/upload/v1706302179/sellers/7/whcb5vpb1ra1rvk5bzkw.jpg'),
('Súper Gomas', 'Gomitas con sabores surtidos', 1.60, 3, 3, 180, 'https://www.confiteriaminerva.com/wp-content/uploads/TRULULU.080.SABOR_.jpg'),
('Chocokrispis Bar', 'Barra de arroz inflado con chocolate', 2.40, 1, 2, 110, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQv0GgOwuE_pWurXl62_1GP8xNp_ulhrv_Dfw&s'),
('Dulce de Leche Confiteca', 'Caramelo cremoso sabor a dulce de leche', 1.30, 2, 4, 150, 'https://www.supermercadosantamaria.com/documents/10180/10504/172954564_G.jpg');

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
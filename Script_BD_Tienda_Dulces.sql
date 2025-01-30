-- CREACIÓN DE LA BASE DE DATOS
-- CREATE DATABASE bd_tienda_dulces;
-- USE bd_tienda_dulces;

-- TABLA DE USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    direccion TEXT,
    telefono VARCHAR(20),
    tipo_usuario ENUM('cliente', 'admin') DEFAULT 'cliente',
    fecha_registro DATE DEFAULT (CURDATE())
);

-- TABLA DE CATEGORÍAS
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL
);

-- TABLA DE MARCAS
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL
);

-- TABLA DE PRODUCTOS
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    id_categoria INT,
    id_marca INT,
    stock INT DEFAULT 0,
    imagen TEXT, -- URL de la imagen del producto
    fecha_registro DATE DEFAULT (CURDATE()),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE SET NULL,
    FOREIGN KEY (id_marca) REFERENCES marcas(id) ON DELETE SET NULL
);

-- TABLA DE PROMOCIONES (SIN CHECK)
CREATE TABLE promociones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    descuento DECIMAL(5,2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE
);

-- TABLA DE PEDIDOS
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'enviado', 'entregado', 'cancelado') DEFAULT 'pendiente',
    fecha_pedido DATE DEFAULT (CURDATE()),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- TABLA DE DETALLES DEL PEDIDO
CREATE TABLE detalles_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE
);

-- TABLA DE CALIFICACIONES Y RESEÑAS
CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_producto INT,
    calificacion INT NOT NULL,
    comentario TEXT,
    fecha DATE DEFAULT (CURDATE()),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE
);

-- TABLA DE ENTREGAS
CREATE TABLE entregas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    direccion_entrega TEXT NOT NULL,
    fecha_estimada DATE,
    estado ENUM('pendiente', 'en camino', 'entregado') DEFAULT 'pendiente',
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id) ON DELETE CASCADE
);
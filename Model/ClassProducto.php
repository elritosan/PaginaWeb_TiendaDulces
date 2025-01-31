<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassProducto {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    // Obtener todos los productos
    public function getProductos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM productos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Obtener producto por ID
    public function getProductoById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM productos WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Crear un nuevo producto
    public function setProducto($nombre, $descripcion, $precio, $id_categoria, $id_marca, $stock, $imagen) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO productos (nombre, descripcion, precio, id_categoria, id_marca, stock, imagen) 
                                          VALUES (:nombre, :descripcion, :precio, :id_categoria, :id_marca, :stock, :imagen)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':id_categoria', $id_categoria);
            $stmt->bindParam(':id_marca', $id_marca);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':imagen', $imagen);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Actualizar un producto
    public function updateProducto($id, $nombre, $descripcion, $precio, $id_categoria, $id_marca, $stock, $imagen) {
        try {
            $stmt = $this->conn->prepare("UPDATE productos SET 
                                          nombre = :nombre, descripcion = :descripcion, precio = :precio, 
                                          id_categoria = :id_categoria, id_marca = :id_marca, stock = :stock, imagen = :imagen
                                          WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':id_categoria', $id_categoria);
            $stmt->bindParam(':id_marca', $id_marca);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':imagen', $imagen);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar un producto
    public function deleteProducto($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM productos WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
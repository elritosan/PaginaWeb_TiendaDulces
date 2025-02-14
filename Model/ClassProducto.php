<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassProducto {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getProductos() {
        $query = "SELECT * FROM productos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductoById($id) {
        $query = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setProducto($nombre, $descripcion, $precio, $id_categoria, $id_marca, $stock, $imagen) {
        $query = "INSERT INTO productos (nombre, descripcion, precio, id_categoria, id_marca, stock, imagen) 
                  VALUES (:nombre, :descripcion, :precio, :id_categoria, :id_marca, :stock, :imagen)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':id_marca', $id_marca);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->execute();
    }

    public function updateProducto($id, $nombre, $descripcion, $precio, $id_categoria, $id_marca, $stock, $imagen) {
        $query = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, 
                  id_categoria = :id_categoria, id_marca = :id_marca, stock = :stock, imagen = :imagen WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':id_marca', $id_marca);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteProducto($id) {
        $query = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function actualizarStock($id_producto, $cantidad) {
        try {
            $stmt = $this->conn->prepare("UPDATE productos SET stock = stock + :cantidad WHERE id = :id_producto AND stock + :cantidad >= 0");
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function obtenerStock($id_producto) {
        try {
            $stmt = $this->conn->prepare("SELECT stock FROM productos WHERE id = :id_producto");
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['stock'] : 0;
        } catch (PDOException $e) {
            return 0;
        }
    } 
    
    public function listarProductos($busqueda = '') {
        try {
            if ($busqueda) {
                $stmt = $this->conn->prepare("SELECT * FROM productos WHERE nombre LIKE :busqueda");
                $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM productos");
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getProducto() {
        $sql = "SELECT id, nombre, precio FROM productos";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
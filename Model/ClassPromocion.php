<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ClassDatabase.php';

class ClassPromocion {
    private $conn;

    public function __construct() {
        $db = new ClassDatabase();
        $this->conn = $db->getConnection();
    }

    public function getPromociones() {
        $query = "SELECT * FROM promociones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromocionById($id) {
        $query = "SELECT * FROM promociones WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setPromocion($id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        $query = "INSERT INTO promociones (id_producto, descuento, fecha_inicio, fecha_fin) 
                  VALUES (:id_producto, :descuento, :fecha_inicio, :fecha_fin)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':descuento', $descuento);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->execute();
    }

    public function setPromocioon($id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        // Verificar si la fecha de fin es menor que la fecha de inicio
        if (strtotime($fecha_fin) < strtotime($fecha_inicio)) {
            return false; // Si las fechas son incorrectas, retornar falso
        }
    
        // Insertar la promoción si las fechas son correctas
        $stmt = $this->conn->prepare("INSERT INTO promociones (id_producto, descuento, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
    
        $stmt->bindParam(1, $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(2, $descuento, PDO::PARAM_INT);
        $stmt->bindParam(3, $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(4, $fecha_fin, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePromocion($id, $id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        $query = "UPDATE promociones SET id_producto = :id_producto, descuento = :descuento, 
                  fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':descuento', $descuento);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updatePromocioon($id, $id_producto, $descuento, $fecha_inicio, $fecha_fin) {
        // Preparar la consulta SQL para actualizar la promoción
        $query = "UPDATE promociones SET id_producto = :id_producto, descuento = :descuento, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id";
    
        // Preparar la declaración
        $stmt = $this->conn->prepare($query);
    
        // Vincular los parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':descuento', $descuento, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Si la actualización es exitosa
        } else {
            return false; // Si ocurrió un error
        }
    }

    public function deletePromocion($id) {
        $query = "DELETE FROM promociones WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function obtenerDescuento($id_producto) {
        try {
            $stmt = $this->conn->prepare("
                SELECT descuento FROM promociones 
                WHERE id_producto = :id_producto 
                AND CURDATE() BETWEEN fecha_inicio AND fecha_fin
            ");
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['descuento'] : 0;
        } catch (PDOException $e) {
            return 0;
        }
    }
    
    public function listarPromocion($busqueda = '') {
        try {
            if ($busqueda) {
                $stmt = $this->conn->prepare("SELECT * FROM promociones WHERE id_producto LIKE :busqueda");
                $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM promociones");
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
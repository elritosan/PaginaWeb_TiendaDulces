<?php
// Clase para gestionar la conexión a la base de datos
class ClassDatabase {
    private $host = 'localhost'; // Dirección del servidor de la base de datos
    private $db_name = 'bd_tienda_dulces'; // Nombre de la base de datos
    private $username = 'root'; // Nombre de usuario (por defecto en XAMPP es 'root')
    private $password = 'password'; // Contraseña vacía, ya que no tienes configurada ninguna
    private $conn;

    // Método para obtener la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            // Creación de la conexión usando PDO
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            
            // Establecer el modo de error de PDO a excepción para mejor manejo de errores
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Manejo de errores si no se puede conectar
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn; // Retorna la conexión
    }
}

?>

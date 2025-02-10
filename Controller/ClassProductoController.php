<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

class ClassProductoController {

    public function getProductoController() {
        $productoModel = new ClassProducto();
        return $productoModel->getProductos();
    }

    public function getProductoByIdController($id) {
        $productoModel = new ClassProducto();
        return $productoModel->getProductoById($id);
    }

    public function setProductoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];
            $id_marca = $_POST['id_marca'];
            $stock = $_POST['stock'];
            $imagen = $_POST['imagen'];

            $productoModel = new ClassProducto();
            $productoModel->setProducto($nombre, $descripcion, $precio, $id_categoria, $id_marca, $stock, $imagen);
            echo "<script>window.location.href = 'index.php?entity=Producto&action=listar';</script>";
        }
    }

    public function updateProductoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];
            $id_marca = $_POST['id_marca'];
            $stock = $_POST['stock'];
            $imagen = $_POST['imagen'];

            $productoModel = new ClassProducto();
            $productoModel->updateProducto($id, $nombre, $descripcion, $precio, $id_categoria, $id_marca, $stock, $imagen);
            echo "<script>window.location.href = 'index.php?entity=Producto&action=listar';</script>";
        }
    }

    public function deleteProductoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $productoModel = new ClassProducto();
            $productoModel->deleteProducto($id);
            echo "<script>window.location.href = 'index.php?entity=Producto&action=listar';</script>";
        }
    }

    public function listarProductosController($busqueda = '') {
        // Instanciamos el modelo de usuario correctamente
        $productoModel = new ClassProducto();
        
        // Ahora llamamos al método listarUsuarios en el modelo
        $productos = $productoModel->listarProductos($busqueda);
        
        return $productos;
    }
}
?>
<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassProducto.php';

class ClassProductoController {

    public function getProductosController() {
        $productoModel = new ClassProducto();
        $productos = $productoModel->getProductos();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Producto' . DIRECTORY_SEPARATOR . 'ListaProducto.php';
    }

    public function getProductoByIdController($id) {
        $productoModel = new ClassProducto();
        $producto = $productoModel->getProductoById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Producto' . DIRECTORY_SEPARATOR . 'DetalleProducto.php';
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
            echo "Producto insertado con éxito!";
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
            echo "Producto actualizado con éxito!";
        }
    }

    public function deleteProductoController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $productoModel = new ClassProducto();
            $productoModel->deleteProducto($id);
            echo "Producto eliminado con éxito!";
        }
    }
}
?>
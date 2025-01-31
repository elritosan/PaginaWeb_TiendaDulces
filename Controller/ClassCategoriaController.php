<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassCategoria.php';

class ClassCategoriaController {

    public function getCategoriasController() {
        $categoriaModel = new ClassCategoria();
        $categorias = $categoriaModel->getCategorias();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Categoria' . DIRECTORY_SEPARATOR . 'ListaCategoria.php';
    }

    public function getCategoriaByIdController($id) {
        $categoriaModel = new ClassCategoria();
        $categoria = $categoriaModel->getCategoriaById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Categoria' . DIRECTORY_SEPARATOR . 'DetalleCategoria.php';
    }

    public function setCategoriaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $categoriaModel = new ClassCategoria();
            $categoriaModel->setCategoria($nombre);
            echo "Categoría insertada con éxito!";
        }
    }

    public function updateCategoriaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];

            $categoriaModel = new ClassCategoria();
            $categoriaModel->updateCategoria($id, $nombre);
            echo "Categoría actualizada con éxito!";
        }
    }

    public function deleteCategoriaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $categoriaModel = new ClassCategoria();
            $categoriaModel->deleteCategoria($id);
            echo "Categoría eliminada con éxito!";
        }
    }
}
?>
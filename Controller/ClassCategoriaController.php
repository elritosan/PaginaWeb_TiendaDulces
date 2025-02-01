<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassCategoria.php';

class ClassCategoriaController {

    public function getCategoriaController() {
        $categoriaModel = new ClassCategoria();
        return $categoriaModel->getCategorias();
    }

    public function getCategoriaByIdController($id) {
        $categoriaModel = new ClassCategoria();
        return $categoriaModel->getCategoriaById($id);
    }

    public function setCategoriaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $categoriaModel = new ClassCategoria();
            $categoriaModel->setCategoria($nombre);
            echo "<script>window.location.href = 'index.php?entity=Categoria&action=listar';</script>";
        }
    }

    public function updateCategoriaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];

            $categoriaModel = new ClassCategoria();
            $categoriaModel->updateCategoria($id, $nombre);
            echo "<script>window.location.href = 'index.php?entity=Categoria&action=listar';</script>";
        }
    }

    public function deleteCategoriaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $categoriaModel = new ClassCategoria();
            $categoriaModel->deleteCategoria($id);
            echo "<script>window.location.href = 'index.php?entity=Categoria&action=listar';</script>";
        }
    }
}
?>
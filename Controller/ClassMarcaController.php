<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassMarca.php';

class ClassMarcaController {

    public function getMarcaController() {
        $marcaModel = new ClassMarca();
        return $marcaModel->getMarcas();
    }

    public function getMarcaByIdController($id) {
        $marcaModel = new ClassMarca();
        return $marcaModel->getMarcaById($id);
    }

    public function setMarcaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $marcaModel = new ClassMarca();
            $marcaModel->setMarca($nombre);
            echo "<script>window.location.href = 'index.php?entity=Marca&action=listar';</script>";
        }
    }

    public function updateMarcaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];

            $marcaModel = new ClassMarca();
            $marcaModel->updateMarca($id, $nombre);
            echo "<script>window.location.href = 'index.php?entity=Marca&action=listar';</script>";
        }
    }

    public function deleteMarcaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            $marcaModel = new ClassMarca();
            $marcaModel->deleteMarca($id);
            echo "<script>window.location.href = 'index.php?entity=Marca&action=listar';</script>";
        }
    }
}
?>
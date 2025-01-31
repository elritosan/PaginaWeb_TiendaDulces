<?php
require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'ClassMarca.php';

class ClassMarcaController {

    // Obtener todas las marcas
    public function getMarcasController() {
        $marcaModel = new ClassMarca();
        $marcas = $marcaModel->getMarcas();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Marca' . DIRECTORY_SEPARATOR . 'ListaMarca.php';
    }

    // Obtener una marca por ID
    public function getMarcaByIdController($id) {
        $marcaModel = new ClassMarca();
        $marca = $marcaModel->getMarcaById($id);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Marca' . DIRECTORY_SEPARATOR . 'DetalleMarca.php';
    }

    // Insertar una nueva marca
    public function setMarcaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $marcaModel = new ClassMarca();
            $marcaModel->setMarca($nombre);
            echo "Marca insertada con éxito!";
        }
    }

    // Actualizar una marca existente
    public function updateMarcaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];

            $marcaModel = new ClassMarca();
            $marcaModel->updateMarca($id, $nombre);
            echo "Marca actualizada con éxito!";
        }
    }

    // Eliminar una marca
    public function deleteMarcaController() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $marcaModel = new ClassMarca();
            $marcaModel->deleteMarca($id);
            echo "Marca eliminada con éxito!";
        }
    }
}
?>
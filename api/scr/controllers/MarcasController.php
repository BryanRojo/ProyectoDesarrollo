<?php
require_once __DIR__ . '/../models/Marca.php';

/**
 * Controlador MarcasController
 * 
 * Maneja las operaciones CRUD para marcas.
 */
class MarcasController {
    /**
     * @var Marca $model Instancia del modelo Marca
     */
    private $model;

    /**
     * Constructor de la clase MarcasController.
     * Inicializa el modelo `Marca`.
     */
    public function __construct() {
        $this->model = new Marca();
    }

    /**
     * Obtiene una marca por ID y la devuelve en formato JSON.
     * @param int $id ID de la marca.
     */
    public function obtenerMarca($id) {
        header('Content-Type: application/json');
        try {
            $marca = $this->model->obtenerMarcaPorId((int) $id);
            echo json_encode($marca ?: ['error' => 'Marca no encontrada']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener la marca: ' . $e->getMessage()]);
        }
    }

    /**
     * Obtiene todas las marcas y las devuelve en formato JSON.
     */
    public function obtenerTodasMarcas() {
        header('Content-Type: application/json');
        try {
            $marcas = $this->model->obtenerTodasMarcas();
            echo json_encode($marcas);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener las marcas: ' . $e->getMessage()]);
        }
    }

    /**
     * Crea una nueva marca a partir de los datos enviados por POST.
     */
    public function crearMarca() {
        header('Content-Type: application/json');

        if (!isset($_POST['nombre']) || empty(trim($_POST['nombre']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Nombre no proporcionado']);
            return;
        }

        try {
            $nombre = trim($_POST['nombre']);
            $this->model->crearMarca($nombre);
            echo json_encode(['success' => 'Marca creada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear la marca: ' . $e->getMessage()]);
        }
    }

    /**
     * Actualiza una marca por ID a partir de los datos enviados por PUT.
     * @param int $id ID de la marca a actualizar.
     */
    public function actualizarMarca($id) {
        header('Content-Type: application/json');

        parse_str(file_get_contents("php://input"), $_PUT);

        if (!isset($_PUT['nombre']) || empty(trim($_PUT['nombre']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Nombre no proporcionado']);
            return;
        }

        try {
            $nombre = trim($_PUT['nombre']);
            $this->model->actualizarMarca((int) $id, $nombre);
            echo json_encode(['success' => 'Marca actualizada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la marca: ' . $e->getMessage()]);
        }
    }

    /**
     * Elimina una marca por ID.
     * @param int $id ID de la marca a eliminar.
     */
    public function eliminarMarca($id) {
        header('Content-Type: application/json');
        try {
            $this->model->eliminarMarca((int) $id);
            echo json_encode(['success' => 'Marca eliminada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la marca: ' . $e->getMessage()]);
        }
    }
}
?>

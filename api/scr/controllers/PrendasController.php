<?php
require_once __DIR__ . '/../models/Prenda.php';

/**
 * Controlador PrendasController
 * 
 * Maneja las operaciones CRUD para prendas.
 */
class PrendasController {
    /**
     * @var Prenda $model Instancia del modelo Prenda
     */
    private $model;

    /**
     * Constructor de la clase PrendasController.
     * Inicializa el modelo `Prenda`.
     */
    public function __construct() {
        $this->model = new Prenda();
    }

    /**
     * Obtiene una prenda por ID y la devuelve en formato JSON.
     * @param int $id ID de la prenda.
     */
    public function obtenerPrenda($id) {
        header('Content-Type: application/json');
        try {
            $prenda = $this->model->obtenerPrendaPorId((int) $id);
            echo json_encode($prenda ?: ['error' => 'Prenda no encontrada']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener la prenda: ' . $e->getMessage()]);
        }
    }

    /**
     * Obtiene todas las prendas y las devuelve en formato JSON.
     */
    public function obtenerTodasPrendas() {
        header('Content-Type: application/json');
        try {
            $prendas = $this->model->obtenerTodasPrendas();
            echo json_encode($prendas);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener las prendas: ' . $e->getMessage()]);
        }
    }

    /**
     * Crea una nueva prenda a partir de los datos enviados por POST.
     */
    public function crearPrenda() {
        header('Content-Type: application/json');

        if (!isset($_POST['nombre'], $_POST['marca_id'], $_POST['stock'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos insuficientes para crear la prenda']);
            return;
        }

        try {
            $nombre   = trim($_POST['nombre']);
            $marca_id = (int) $_POST['marca_id'];
            $stock    = (int) $_POST['stock'];

            $this->model->crearPrenda($nombre, $marca_id, $stock);
            echo json_encode(['success' => 'Prenda creada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear la prenda: ' . $e->getMessage()]);
        }
    }

    /**
     * Actualiza una prenda por ID a partir de los datos enviados por PUT.
     * @param int $id ID de la prenda a actualizar.
     */
    public function actualizarPrenda($id) {
        header('Content-Type: application/json');

        parse_str(file_get_contents("php://input"), $_PUT);

        if (!isset($_PUT['nombre'], $_PUT['marca_id'], $_PUT['stock'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos insuficientes para actualizar la prenda']);
            return;
        }

        try {
            $nombre   = trim($_PUT['nombre']);
            $marca_id = (int) $_PUT['marca_id'];
            $stock    = (int) $_PUT['stock'];

            $this->model->actualizarPrenda((int) $id, $nombre, $marca_id, $stock);
            echo json_encode(['success' => 'Prenda actualizada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la prenda: ' . $e->getMessage()]);
        }
    }

    /**
     * Elimina una prenda por ID.
     * @param int $id ID de la prenda a eliminar.
     */
    public function eliminarPrenda($id) {
        header('Content-Type: application/json');
        try {
            $this->model->eliminarPrenda((int) $id);
            echo json_encode(['success' => 'Prenda eliminada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la prenda: ' . $e->getMessage()]);
        }
    }
}
?>

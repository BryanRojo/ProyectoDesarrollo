<?php
require_once __DIR__ . '/../models/Venta.php';

/**
 * Controlador VentasController
 * 
 * Maneja las operaciones CRUD para ventas.
 */
class VentasController {
    /**
     * @var Venta $model Instancia del modelo Venta
     */
    private $model;

    /**
     * Constructor de la clase VentasController.
     * Inicializa el modelo `Venta`.
     */
    public function __construct() {
        $this->model = new Venta();
    }

    /**
     * Obtiene una venta por ID y la devuelve en formato JSON.
     * @param int $id ID de la venta.
     */
    public function obtenerVenta($id) {
        header('Content-Type: application/json');
        try {
            $venta = $this->model->obtenerVentaPorId((int) $id);
            echo json_encode($venta ?: ['error' => 'Venta no encontrada']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener la venta: ' . $e->getMessage()]);
        }
    }

    /**
     * Obtiene todas las ventas y las devuelve en formato JSON.
     */
    public function obtenerTodasVentas() {
        header('Content-Type: application/json');
        try {
            $ventas = $this->model->obtenerTodasVentas();
            echo json_encode($ventas);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener las ventas: ' . $e->getMessage()]);
        }
    }

    /**
     * Crea una nueva venta a partir de los datos enviados por POST.
     */
    public function crearVenta() {
        header('Content-Type: application/json');

        if (!isset($_POST['prenda_id'], $_POST['fecha_venta'], $_POST['cantidad'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos insuficientes para crear la venta']);
            return;
        }

        try {
            $prenda_id   = (int) $_POST['prenda_id'];
            $fecha_venta = trim($_POST['fecha_venta']);
            $cantidad    = (int) $_POST['cantidad'];

            $this->model->crearVenta($prenda_id, $fecha_venta, $cantidad);
            echo json_encode(['success' => 'Venta creada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear la venta: ' . $e->getMessage()]);
        }
    }

    /**
     * Actualiza una venta por ID a partir de los datos enviados por PUT.
     * @param int $id ID de la venta a actualizar.
     */
    public function actualizarVenta($id) {
        header('Content-Type: application/json');

        parse_str(file_get_contents("php://input"), $_PUT);

        if (!isset($_PUT['prenda_id'], $_PUT['fecha_venta'], $_PUT['cantidad'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos insuficientes para actualizar la venta']);
            return;
        }

        try {
            $prenda_id   = (int) $_PUT['prenda_id'];
            $fecha_venta = trim($_PUT['fecha_venta']);
            $cantidad    = (int) $_PUT['cantidad'];

            $this->model->actualizarVenta((int) $id, $prenda_id, $fecha_venta, $cantidad);
            echo json_encode(['success' => 'Venta actualizada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la venta: ' . $e->getMessage()]);
        }
    }

    /**
     * Elimina una venta por ID.
     * @param int $id ID de la venta a eliminar.
     */
    public function eliminarVenta($id) {
        header('Content-Type: application/json');
        try {
            $this->model->eliminarVenta((int) $id);
            echo json_encode(['success' => 'Venta eliminada exitosamente']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la venta: ' . $e->getMessage()]);
        }
    }
}
?>

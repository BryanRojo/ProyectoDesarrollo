<?php
// controllers/VistasController.php

require_once __DIR__ . '/../models/Vista.php';

/**
 * Controlador VistasController
 * 
 * Maneja la obtención de datos desde vistas SQL predefinidas.
 */
class VistasController {
    /**
     * @var Vista $model Instancia del modelo Vista
     */
    private $model;

    /**
     * Constructor de la clase VistasController.
     * Inicializa el modelo `Vista`.
     */
    public function __construct() {
        $this->model = new Vista();
    }

    /**
     * Obtiene la vista `MarcasConVentas`.
     * Devuelve un JSON con los datos o un mensaje de error.
     */
    public function obtenerMarcasConVentas() {
        try {
            header('Content-Type: application/json');
            $datos = $this->model->getMarcasConVentas();
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error al obtener MarcasConVentas: ' . $e->getMessage()]);
        }
    }

    /**
     * Obtiene la vista `PrendasVendidasYStock`.
     * Devuelve un JSON con los datos o un mensaje de error.
     */
    public function obtenerPrendasVendidasYStock() {
        try {
            header('Content-Type: application/json');
            $datos = $this->model->getPrendasVendidasYStock();
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error al obtener PrendasVendidasYStock: ' . $e->getMessage()]);
        }
    }

    /**
     * Obtiene la vista `Top5MarcasMasVendidas`.
     * Devuelve un JSON con los datos o un mensaje de error.
     */
    public function obtenerTop5MarcasMasVendidas() {
        try {
            header('Content-Type: application/json');
            $datos = $this->model->getTop5MarcasMasVendidas();
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error al obtener Top5MarcasMasVendidas: ' . $e->getMessage()]);
        }
    }
}
?>

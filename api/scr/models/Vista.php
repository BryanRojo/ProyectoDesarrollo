<?php
require_once __DIR__ . '/../db/Database.php';

/**
 * Clase Vista
 * 
 * Proporciona métodos para obtener datos de las vistas de la base de datos relacionadas con ventas y marcas.
 */
class Vista {
    /**
     * @var PDO $db Conexión a la base de datos
     */
    private $db;

    /**
     * Constructor de la clase Vista.
     * Establece la conexión con la base de datos.
     */
    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Obtiene los datos de la vista `MarcasConVentas`.
     * 
     * @return array Arreglo asociativo con los resultados de la consulta.
     */
    public function getMarcasConVentas() {
        $stmt = $this->db->query("SELECT * FROM MarcasConVentas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene los datos de la vista `PrendasVendidasYStock`.
     * 
     * @return array Arreglo asociativo con los resultados de la consulta.
     */
    public function getPrendasVendidasYStock() {
        $stmt = $this->db->query("SELECT * FROM PrendasVendidasYStock");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene los datos de la vista `Top5MarcasMasVendidas`.
     * 
     * @return array Arreglo asociativo con los resultados de la consulta.
     */
    public function getTop5MarcasMasVendidas() {
        $stmt = $this->db->query("SELECT * FROM Top5MarcasMasVendidas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

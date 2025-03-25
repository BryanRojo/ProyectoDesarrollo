<?php
require_once __DIR__ . '/../db/Database.php';

/**
 * Clase Venta
 * 
 * Gestiona las operaciones CRUD en la tabla `Ventas`.
 */
class Venta {
    /**
     * @var PDO $db Conexión a la base de datos
     */
    private $db;

    /**
     * Constructor de la clase Venta.
     * Establece la conexión con la base de datos.
     */
    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Obtiene una venta por su ID.
     * 
     * @param int $id ID de la venta a consultar.
     * @return array|null Datos de la venta o `null` si no se encuentra.
     */
    public function obtenerVentaPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Ventas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener la venta: ' . $e->getMessage()];
        }
    }

    /**
     * Obtiene todas las ventas registradas.
     * 
     * @return array Arreglo asociativo con todas las ventas.
     */
    public function obtenerTodasVentas() {
        try {
            $stmt = $this->db->query("SELECT * FROM Ventas");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener todas las ventas: ' . $e->getMessage()];
        }
    }

    /**
     * Crea una nueva venta.
     * 
     * @param int $prenda_id ID de la prenda vendida.
     * @param string $fecha_venta Fecha de la venta en formato `YYYY-MM-DD`.
     * @param int $cantidad Cantidad de prendas vendidas.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function crearVenta($prenda_id, $fecha_venta, $cantidad) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Ventas (prenda_id, fecha_venta, cantidad) VALUES (:prenda_id, :fecha_venta, :cantidad)");
            $stmt->bindParam(':prenda_id', $prenda_id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_venta', $fecha_venta, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Venta creada correctamente.'] : ['error' => 'No se pudo crear la venta.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al crear la venta: ' . $e->getMessage()];
        }
    }

    /**
     * Actualiza los datos de una venta existente.
     * 
     * @param int $id ID de la venta a actualizar.
     * @param int $prenda_id Nuevo ID de la prenda.
     * @param string $fecha_venta Nueva fecha de venta en formato `YYYY-MM-DD`.
     * @param int $cantidad Nueva cantidad vendida.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function actualizarVenta($id, $prenda_id, $fecha_venta, $cantidad) {
        try {
            $stmt = $this->db->prepare("UPDATE Ventas SET prenda_id = :prenda_id, fecha_venta = :fecha_venta, cantidad = :cantidad WHERE id = :id");
            $stmt->bindParam(':prenda_id', $prenda_id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_venta', $fecha_venta, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Venta actualizada correctamente.'] : ['error' => 'No se pudo actualizar la venta.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al actualizar la venta: ' . $e->getMessage()];
        }
    }

    /**
     * Elimina una venta de la base de datos.
     * 
     * @param int $id ID de la venta a eliminar.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function eliminarVenta($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Ventas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Venta eliminada correctamente.'] : ['error' => 'No se pudo eliminar la venta.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al eliminar la venta: ' . $e->getMessage()];
        }
    }
}

<?php
require_once __DIR__ . '/../db/Database.php';

/**
 * Clase Prenda
 * 
 * Gestiona las operaciones CRUD en la tabla `Prendas`.
 */
class Prenda {
    /**
     * @var PDO $db Conexión a la base de datos
     */
    private $db;

    /**
     * Constructor de la clase Prenda.
     * Establece la conexión con la base de datos.
     */
    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Obtiene una prenda por su ID.
     * 
     * @param int $id ID de la prenda a consultar.
     * @return array|null Datos de la prenda o `null` si no se encuentra.
     */
    public function obtenerPrendaPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Prendas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener la prenda: ' . $e->getMessage()];
        }
    }

    /**
     * Obtiene todas las prendas registradas.
     * 
     * @return array Arreglo asociativo con todas las prendas.
     */
    public function obtenerTodasPrendas() {
        try {
            $stmt = $this->db->query("SELECT * FROM Prendas");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener todas las prendas: ' . $e->getMessage()];
        }
    }

    /**
     * Crea una nueva prenda en la base de datos.
     * 
     * @param string $nombre Nombre de la prenda.
     * @param int $marca_id ID de la marca asociada.
     * @param int $stock Cantidad de stock disponible.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function crearPrenda($nombre, $marca_id, $stock) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Prendas (nombre, marca_id, stock) VALUES (:nombre, :marca_id, :stock)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Prenda creada correctamente.'] : ['error' => 'No se pudo crear la prenda.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al crear la prenda: ' . $e->getMessage()];
        }
    }

    /**
     * Actualiza los datos de una prenda existente.
     * 
     * @param int $id ID de la prenda a actualizar.
     * @param string $nombre Nuevo nombre de la prenda.
     * @param int $marca_id Nuevo ID de la marca.
     * @param int $stock Nueva cantidad de stock.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function actualizarPrenda($id, $nombre, $marca_id, $stock) {
        try {
            $stmt = $this->db->prepare("UPDATE Prendas SET nombre = :nombre, marca_id = :marca_id, stock = :stock WHERE id = :id");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Prenda actualizada correctamente.'] : ['error' => 'No se pudo actualizar la prenda.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al actualizar la prenda: ' . $e->getMessage()];
        }
    }

    /**
     * Elimina una prenda de la base de datos.
     * 
     * @param int $id ID de la prenda a eliminar.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function eliminarPrenda($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Prendas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Prenda eliminada correctamente.'] : ['error' => 'No se pudo eliminar la prenda.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al eliminar la prenda: ' . $e->getMessage()];
        }
    }
}
?>

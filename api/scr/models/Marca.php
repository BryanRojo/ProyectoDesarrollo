<?php
require_once __DIR__ . '/../db/Database.php';

/**
 * Clase Marca
 * 
 * Gestiona las operaciones CRUD en la tabla `Marcas`.
 */
class Marca {
    /**
     * @var PDO $db Conexión a la base de datos
     */
    private $db;

    /**
     * Constructor de la clase Marca.
     * Establece la conexión con la base de datos.
     */
    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Obtiene una marca por su ID.
     * 
     * @param int $id ID de la marca a consultar.
     * @return array|null Datos de la marca o `null` si no se encuentra.
     */
    public function obtenerMarcaPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Marcas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener la marca: ' . $e->getMessage()];
        }
    }

    /**
     * Obtiene todas las marcas registradas.
     * 
     * @return array Arreglo asociativo con todas las marcas.
     */
    public function obtenerTodasMarcas() {
        try {
            $stmt = $this->db->query("SELECT * FROM Marcas");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener todas las marcas: ' . $e->getMessage()];
        }
    }

    /**
     * Crea una nueva marca en la base de datos.
     * 
     * @param string $nombre Nombre de la marca.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function crearMarca($nombre) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Marcas (nombre) VALUES (:nombre)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            return $stmt->execute() ? ['success' => 'Marca creada correctamente.'] : ['error' => 'No se pudo crear la marca.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al crear la marca: ' . $e->getMessage()];
        }
    }

    /**
     * Actualiza los datos de una marca existente.
     * 
     * @param int $id ID de la marca a actualizar.
     * @param string $nombre Nuevo nombre de la marca.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function actualizarMarca($id, $nombre) {
        try {
            $stmt = $this->db->prepare("UPDATE Marcas SET nombre = :nombre WHERE id = :id");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Marca actualizada correctamente.'] : ['error' => 'No se pudo actualizar la marca.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al actualizar la marca: ' . $e->getMessage()];
        }
    }

    /**
     * Elimina una marca de la base de datos.
     * 
     * @param int $id ID de la marca a eliminar.
     * @return array Resultado de la operación con mensaje de éxito o error.
     */
    public function eliminarMarca($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Marcas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? ['success' => 'Marca eliminada correctamente.'] : ['error' => 'No se pudo eliminar la marca.'];
        } catch (PDOException $e) {
            return ['error' => 'Error al eliminar la marca: ' . $e->getMessage()];
        }
    }

}
?>

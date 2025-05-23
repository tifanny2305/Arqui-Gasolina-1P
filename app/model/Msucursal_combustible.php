<?php
require_once(__DIR__ . '/../config/database.php');

class Msucursal_combustible {
    private $db;

    private $sucursal_id;
    private $combustible_id;
    private $capacidad_actual;
    private $estado;
    private $fecha_actualizada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->obtenerConexion();
    }

    //Asignar combustible a sucursal
    public function asignarCombustible($sucursal_id, $combustible_id) {
        $this->sucursal_id = $sucursal_id;
        $this->combustible_id = $combustible_id;
        $this->estado = 'disponible';
        $this->fecha_actualizada = date('Y-m-d');

        $query = "INSERT INTO sucursal_combustible 
                  (sucursal_id, combustible_id, estado, fecha_actualizada) 
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiss", 
            $this->sucursal_id, 
            $this->combustible_id, 
            $this->estado, 
            $this->fecha_actualizada
        );
        
        return $stmt->execute();
    }

    //Crear relacion entre sucursal y combustible
    public function crearRelacion($sucursal_id, $combustible_id, $duracion_tanque = 0) {
        $query = "INSERT INTO sucursal_combustible 
                 (sucursal_id, combustible_id, estado, fecha_actualizada, duracion_tanque) 
                 VALUES (?, ?, 'disponible', NOW(), ?)
                 ON DUPLICATE KEY UPDATE 
                 estado = VALUES(estado),
                 fecha_actualizada = VALUES(fecha_actualizada),
                 duracion_tanque = VALUES(duracion_tanque)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iis", $sucursal_id, $combustible_id, $duracion_tanque);
        return $stmt->execute();
    }
    
    //Obtener combustibles por sucursal
    public function obtenerCombustiblesPorSucursal($sucursal_id) {
        $query = "SELECT c.id, c.tipo, sc.capacidad_actual, sc.fecha_actualizada, sc.estado
                  FROM sucursal_combustible sc
                  JOIN combustible c ON c.id = sc.combustible_id
                  WHERE sc.sucursal_id = ?";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $sucursal_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Elimina los combustibles de una sucursal
    public function eliminarCombustiblesDeSucursal($sucursal_id) {
        $query = "DELETE FROM sucursal_combustible WHERE sucursal_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $sucursal_id);
        return $stmt->execute();
    }

    //Del Tanque
    //Elimina el combustible de una sucursal
    public function eliminarCombustible($sucursal_id, $combustible_id) {
        $query = "DELETE FROM sucursal_combustible 
                  WHERE sucursal_id = ? AND combustible_id = ?";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Error preparando consulta: " . $this->db->error);
            return false;
        }
        
        $stmt->bind_param("ii", $sucursal_id, $combustible_id);
        $result = $stmt->execute();
        
        if (!$result) {
            error_log("Error ejecutando consulta: " . $stmt->error);
        }
        
        return $result;
    }

    //Actualizar el estado del combustible en la sucursal
    public function actualizarEstadoCombustible($sucursal_id, $combustible_id, $estado) {
        $fecha_actualizada = date('Y-m-d H:i:s');
        
        $query = "UPDATE sucursal_combustible 
                 SET estado = ?, fecha_actualizada = ?
                 WHERE sucursal_id = ? AND combustible_id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssii", $estado, $fecha_actualizada, $sucursal_id, $combustible_id);
        return $stmt->execute();
    }

    //Actualizar el tanque de combustible en la sucursal
    public function actualizarTanque($sucursal_id, $combustible_id, $capacidad_actual, $estado) {
        
        $query = "UPDATE sucursal_combustible SET 
                 capacidad_actual = ?, 
                 estado = ?, 
                 fecha_actualizada = NOW() 
                 WHERE sucursal_id = ? AND combustible_id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isii", $capacidad_actual, $estado, $sucursal_id, $combustible_id);
        return $stmt->execute();
    }

}
?>

<?php
class Cita {
    private $pdo;

    // Constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear una nueva cita
    public function crear($fecha, $hora, $idMascota) {
        $sql = "INSERT INTO citas (fecha, hora, idMascota) VALUES (:fecha, :hora, :idMascota)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
    }

    // Actualizar una cita
    public function actualizar($idCita, $fecha, $hora, $idMascota) {
        $sql = "UPDATE citas SET fecha = :fecha, hora = :hora, idMascota = :idMascota WHERE idCita = :idCita";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->bindParam(':idCita', $idCita);
        $stmt->execute();
    }

    // Eliminar una cita
    public function eliminar($idCita) {
        $sql = "DELETE FROM citas WHERE idCita = :idCita";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCita', $idCita);
        $stmt->execute();
    }

    // Obtener todas las citas
    public function obtener() {
        $sql = "SELECT c.idCita, c.fecha, c.hora, c.idMascota, m.nombre AS mascotaNombre
                FROM citas c
                INNER JOIN mascotas m ON c.idMascota = m.idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar una cita por ID
    public function buscar($idCita) {
        $sql = "SELECT * FROM citas WHERE idCita = :idCita";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCita', $idCita);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

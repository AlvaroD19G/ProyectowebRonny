<?php
class Mascota {
    private $pdo;

    // Constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear una nueva mascota
    public function crear($nombre, $tipo, $raza, $cedulaCliente) {
        $sql = "INSERT INTO mascotas (nombre, tipo, raza, cedulaCliente) VALUES (:nombre, :tipo, :raza, :cedulaCliente)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':raza', $raza);
        $stmt->bindParam(':cedulaCliente', $cedulaCliente); // Cambiado de 'idCliente' a 'cedulaCliente'
        $stmt->execute();
    }

    // Actualizar una mascota
    public function actualizar($idMascota, $nombre, $tipo, $raza, $cedulaCliente) {
        $sql = "UPDATE mascotas SET nombre = :nombre, tipo = :tipo, raza = :raza, cedulaCliente = :cedulaCliente WHERE idMascota = :idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':raza', $raza);
        $stmt->bindParam(':cedulaCliente', $cedulaCliente); // Cambiado de 'idCliente' a 'cedulaCliente'
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
    }

    // Eliminar una mascota
    public function eliminar($idMascota) {
        $sql = "DELETE FROM mascotas WHERE idMascota = :idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
    }

    // Obtener todas las mascotas
    public function obtener() {
        $sql = "SELECT * FROM mascotas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar una mascota por ID
    public function buscar($idMascota) {
        $sql = "SELECT * FROM mascotas WHERE idMascota = :idMascota";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idMascota', $idMascota);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

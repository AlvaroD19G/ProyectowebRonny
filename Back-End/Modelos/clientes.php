<?php
class Cliente {
    private $pdo;

    // Constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear un nuevo cliente
    public function crear($cedula, $nombre, $direccion, $telefono, $email) {
        // Ahora insertamos la cédula como clave primaria
        $sql = "INSERT INTO clientes (cedula, nombre, direccion, telefono, email) VALUES (:cedula, :nombre, :direccion, :telefono, :email)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    // Actualizar un cliente
    public function actualizar($cedula, $nombre, $direccion, $telefono, $email) {
        // Ahora actualizamos usando la cédula
        $sql = "UPDATE clientes SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE cedula = :cedula";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    // Eliminar un cliente
    public function eliminar($cedula) {
        $sql = "DELETE FROM clientes WHERE cedula = :cedula";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
    }

    // Obtener todos los clientes
    public function obtener() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un cliente por cédula
    public function buscar($cedula) {
        $sql = "SELECT * FROM clientes WHERE cedula = :cedula";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>

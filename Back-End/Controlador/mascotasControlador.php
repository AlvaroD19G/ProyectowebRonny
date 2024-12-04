<?php
require_once '../modelos/mascotas.php';
require_once '../configuracion/conexion.php';

// Instanciamos el modelo de Mascota
$mascota = new Mascota($pdo);

// Método GET: Obtener todas las mascotas
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['idMascota'])) {
    $mascotas = $mascota->obtener();
    echo json_encode($mascotas);
}

// Método GET: Obtener una mascota por su ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idMascota'])) {
    $idMascota = $_GET['idMascota'];
    $mascota = $mascota->buscar($idMascota);
    echo json_encode($mascota);
}

// Método POST: Crear una nueva mascota
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que los datos necesarios estén presentes
    if (isset($data['nombre'], $data['tipo'], $data['raza'], $data['cedulaCliente'])) {
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $raza = $data['raza'];
        $cedulaCliente = $data['cedulaCliente']; // Cambiado de 'idCliente' a 'cedulaCliente'
        
        // Crear la mascota
        $mascota->crear($nombre, $tipo, $raza, $cedulaCliente);
        echo json_encode(['status' => 'success', 'message' => 'Mascota creada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

// Método PUT: Actualizar una mascota existente
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que los datos necesarios estén presentes
    if (isset($data['idMascota'], $data['nombre'], $data['tipo'], $data['raza'], $data['cedulaCliente'])) {
        $idMascota = $data['idMascota'];
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $raza = $data['raza'];
        $cedulaCliente = $data['cedulaCliente']; // Cambiado de 'idCliente' a 'cedulaCliente'
        
        // Actualizar la mascota
        $mascota->actualizar($idMascota, $nombre, $tipo, $raza, $cedulaCliente);
        echo json_encode(['status' => 'success', 'message' => 'Mascota actualizada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

// Método DELETE: Eliminar una mascota
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que el ID de la mascota esté presente
    if (isset($data['idMascota'])) {
        $idMascota = $data['idMascota'];
        
        // Eliminar la mascota
        $mascota->eliminar($idMascota);
        echo json_encode(['status' => 'success', 'message' => 'Mascota eliminada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID de mascota faltante.']);
    }
}
?>

<?php
require_once '../modelos/citas.php';
require_once '../configuracion/conexion.php';

// Instanciamos el modelo de Cita
$cita = new Cita($pdo);

// Método GET: Obtener todas las citas
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['idCita'])) {
    $citas = $cita->obtener();
    echo json_encode($citas);
}

// Método GET: Obtener una cita por su ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idCita'])) {
    $idCita = $_GET['idCita'];
    $cita = $cita->buscar($idCita);
    echo json_encode($cita);
}

// Método POST: Crear una nueva cita
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que los datos necesarios estén presentes
    if (isset($data['fecha'], $data['hora'], $data['idMascota'])) {
        $fecha = $data['fecha'];
        $hora = $data['hora'];
        $idMascota = $data['idMascota'];
        
        // Crear la cita
        $cita->crear($fecha, $hora, $idMascota);
        echo json_encode(['status' => 'success', 'message' => 'Cita creada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

// Método PUT: Actualizar una cita existente
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que los datos necesarios estén presentes
    if (isset($data['idCita'], $data['fecha'], $data['hora'], $data['idMascota'])) {
        $idCita = $data['idCita'];
        $fecha = $data['fecha'];
        $hora = $data['hora'];
        $idMascota = $data['idMascota'];
        
        // Actualizar la cita
        $cita->actualizar($idCita, $fecha, $hora, $idMascota);
        echo json_encode(['status' => 'success', 'message' => 'Cita actualizada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

// Método DELETE: Eliminar una cita
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que el ID de la cita esté presente
    if (isset($data['idCita'])) {
        $idCita = $data['idCita'];
        
        // Eliminar la cita
        $cita->eliminar($idCita);
        echo json_encode(['status' => 'success', 'message' => 'Cita eliminada exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID de cita faltante.']);
    }
}
?>

<?php
require_once '../modelos/clientes.php';
require_once '../configuracion/conexion.php';

// Instanciamos el modelo de Cliente
$cliente = new Cliente($pdo);

// Obtener la operación desde la URL
$op = isset($_GET['op']) ? $_GET['op'] : '';

// Método GET: Obtener todos los clientes
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $op == 'listar') {
    $clientes = $cliente->obtener();
    echo json_encode($clientes);
}

// Método GET: Obtener un cliente por su cédula
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];
    $cliente = $cliente->buscar($cedula);
    echo json_encode($cliente);
}

// Método POST: Crear un nuevo cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $op == 'crear') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que los datos necesarios estén presentes
    if (isset($data['cedula'], $data['nombre'], $data['direccion'], $data['telefono'], $data['email'])) {
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $email = $data['email'];
        
        // Crear el cliente
        $cliente->crear($cedula, $nombre, $direccion, $telefono, $email);
        echo json_encode(['status' => 'success', 'message' => 'Cliente creado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

// Método PUT: Actualizar un cliente existente
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $op == 'actualizar') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que los datos necesarios estén presentes
    if (isset($data['cedula'], $data['nombre'], $data['direccion'], $data['telefono'], $data['email'])) {
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $email = $data['email'];
        
        // Actualizar el cliente
        $cliente->actualizar($cedula, $nombre, $direccion, $telefono, $email);
        echo json_encode(['status' => 'success', 'message' => 'Cliente actualizado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios.']);
    }
}

// Método DELETE: Eliminar un cliente
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $op == 'eliminar') {
    // Se esperan datos en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificamos que la cédula del cliente esté presente
    if (isset($data['cedula'])) {
        $cedula = $data['cedula'];
        
        // Eliminar el cliente
        $cliente->eliminar($cedula);
        echo json_encode(['status' => 'success', 'message' => 'Cliente eliminado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Cédula de cliente faltante.']);
    }
}
?>

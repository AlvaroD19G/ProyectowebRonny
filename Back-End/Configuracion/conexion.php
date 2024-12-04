<?php
$host = 'gestionmascotasweb.mysql.database.azure.com';
$dbname = 'mascotasweb';
$username = 'adminuser@mascotasweb'; 
$password = 'Admin123!'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

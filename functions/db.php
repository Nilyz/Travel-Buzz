<?php
// db.php - Archivo de conexión a la base de datos
$host = 'localhost';
$dbname = 'travelbuzz_db';
$username = 'root';  // Cambia según tu configuración
$password = '';      // Cambia según tu configuración

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

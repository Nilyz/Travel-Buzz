<?php
session_start();
include 'db.php';

// Verifica si el usuario es admin
if (!isset($_SESSION['idUser']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar usuario
    $sql = "DELETE FROM users_data WHERE idUser = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        header('Location: usuarios-administracion.php'); // Redirige después de eliminar
        exit();
    } else {
        echo "<p>Error al eliminar el usuario.</p>";
    }
} else {
    echo "<p>No se ha especificado un ID de usuario.</p>";
    exit();
}
?>

<?php
session_start();
include '../functions/db.php';

// Verifica si el usuario es admin
if (!isset($_SESSION['idUser']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Verifica si se ha pasado un ID y eliminar noticia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM noticias WHERE idNoticia = ?";
    $stmt = $pdo->prepare($sql);
    
    try {
        if ($stmt->execute([$id])) {
            $_SESSION['message'] = "Noticia eliminada correctamente.";
            header('Location: noticias-administracion.php'); // Redirige después de eliminar
            exit();
        } else {
            $_SESSION['message'] = "Error al eliminar la noticia. Por favor, inténtalo de nuevo.";
            header('Location: noticias-administracion.php'); // Redirige a la lista de noticias
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error al eliminar la noticia: " . $e->getMessage();
        header('Location: noticias-administracion.php'); // Redirige a la lista de noticias
        exit();
    }
} else {
    $_SESSION['message'] = "No se ha especificado un ID de noticia.";
    header('Location: noticias-administracion.php'); // Redirige a la lista de noticias
    exit();
}
?>

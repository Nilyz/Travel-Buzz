<?php

include '../functions/auth.php';
include '../functions/appointments.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $citaId = $_GET['id'];

    // Eliminar cita
    if (deleteAppointment($citaId)) {
        header('Location: citas-administracion.php'); // Redirige después de eliminar
        exit();
    } else {
        echo "<p>Error al eliminar la cita.</p>";
    }
} else {
    echo "<p>No se ha especificado un ID de cita.</p>";
    exit();
}
?>

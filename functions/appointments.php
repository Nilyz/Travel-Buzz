<?php
// functions/appointments.php
include 'db.php'; // Asegúrate de que la ruta sea correcta

function getAppointmentsByUser($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE idUser = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllAppointments() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM citas");  // Consulta todas las citas
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createAppointment($userId, $fechaCita, $motivoCita) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $fechaCita, $motivoCita]);
}

function deleteAppointment($citaId) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM citas WHERE idCita = ?");
    $stmt->execute([$citaId]);
}

function isUserAppointment($userId, $citaId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE idCita = ? AND idUser = ?");
    $stmt->execute([$citaId, $userId]);
    return $stmt->rowCount() > 0;
}



?>

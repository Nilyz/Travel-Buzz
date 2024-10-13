<?php

include 'db.php'; 


function getAllAppointments() {
    global $pdo;
    // Hacer el JOIN con la tabla 'users_data' para obtener el nombre y apellidos
    $stmt = $pdo->query("
        SELECT citas.*, users_data.nombre, users_data.apellidos
        FROM citas
        JOIN users_data ON citas.idUser = users_data.idUser
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function createAppointment($idUser, $fechaCita, $motivoCita) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?, ?, ?)");
    $stmt->execute([$idUser, $fechaCita, $motivoCita]);
}


function getAppointmentById($citaId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE idCita = ?");
    $stmt->execute([$citaId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateAppointment($citaId, $fechaCita, $motivoCita) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE citas SET fecha_cita = ?, motivo_cita = ? WHERE idCita = ?");
    return $stmt->execute([$fechaCita, $motivoCita, $citaId]);
}

function deleteAppointment($citaId) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM citas WHERE idCita = ?");
    return $stmt->execute([$citaId]);
}

// Verificar si la cita pertenece al usuario
function isUserAppointment($userId, $citaId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE idCita = ? AND idUser = ?");
    $stmt->execute([$citaId, $userId]);
    return $stmt->rowCount() > 0;
}

function getAppointmentsByUser($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE idUser = ?"); // Asegúrate de que 'citas' es el nombre correcto de tu tabla
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

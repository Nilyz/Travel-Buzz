<?php
// functions/users.php
include '../db.php'; // Asegúrate de que la ruta sea correcta

function getAllUsers() {
    global $pdo;
    // Unir las tablas users_data y users_login para obtener el rol de los usuarios
    $stmt = $pdo->query("SELECT u.idUser, u.nombre, l.rol FROM users_data u JOIN users_login l ON u.idUser = l.idUser");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($idUser) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users_data WHERE idUser = ?");
    $stmt->execute([$idUser]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// functions/users.php

function createUser($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password, $rol) {
    global $pdo;

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insertar en la tabla users_data
        $stmt = $pdo->prepare("INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo]);
        
        // Obtener el último ID insertado
        $idUser = $pdo->lastInsertId();

        // Insertar en la tabla users_login
        $stmt = $pdo->prepare("INSERT INTO users_login (idUser, usuario, password, rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$idUser, $usuario, $hashed_password, $rol]);

        return true; // Retornar true si la creación fue exitosa
    } catch (PDOException $e) {
        return false; // Retornar false si hubo un error
    }
}


function updateUser($idUser, $username, $nombre, $rol) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users_data SET username = ?, nombre = ?, rol = ? WHERE idUser = ?");
    $stmt->execute([$username, $nombre, $rol, $idUser]);
}

function deleteUser($idUser) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users_data WHERE idUser = ?");
    $stmt->execute([$idUser]);
}
?>

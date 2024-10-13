<?php
include 'db.php'; 

function getAllUsers() {
    global $pdo;
    $stmt = $pdo->query("SELECT u.idUser, u.nombre, l.rol FROM users_data u JOIN users_login l ON u.idUser = l.idUser");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getUserById($idUser) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("
            SELECT u.*, ul.usuario, ul.rol 
            FROM users_data AS u
            JOIN users_login AS ul ON u.idUser = ul.idUser 
            WHERE u.idUser = ?
        ");
        $stmt->execute([$idUser]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // Devolver el usuario encontrado
    } catch (PDOException $e) {
        return null; 
    }
}



function createUser($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password, $rol) {
    global $pdo;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {

        $pdo->beginTransaction();

        // Insertar en la tabla users_data
        $stmt = $pdo->prepare("INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo]);

        // Obtener el último ID insertado
        $idUser = $pdo->lastInsertId();

        // Insertar en la tabla users_login
        $stmt = $pdo->prepare("INSERT INTO users_login (idUser, usuario, password, rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$idUser, $usuario, $hashed_password, $rol]);

        // Confirmar la transacción
        $pdo->commit();

        return true; // Retornar true si la creación fue exitosa
    } catch (PDOException $e) {
        // Revertir la transacción si hay un error
        $pdo->rollBack();
        return false; // Retornar false si hubo un error
    }
}



function updateUser($idUser, $username, $nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $rol) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("UPDATE users_data 
                               SET nombre = ?, apellidos = ?, email = ?, telefono = ?, fecha_nacimiento = ?, direccion = ?, sexo = ?
                               WHERE idUser = ?");
        $stmt->execute([$nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $idUser]);

        $stmt = $pdo->prepare("UPDATE users_login 
                               SET usuario = ?, rol = ? 
                               WHERE idUser = ?");
        $stmt->execute([$username, $rol, $idUser]);

        return true; 
    } catch (PDOException $e) {
        return false; 
    }
}


function deleteUser($idUser) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users_data WHERE idUser = ?");
    $stmt->execute([$idUser]);
}
?>

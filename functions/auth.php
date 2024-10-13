<?php
require_once 'db.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function registrarUsuario($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password) {
    global $pdo;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo)
                VALUES (:nombre, :apellidos, :email, :telefono, :fecha_nacimiento, :direccion, :sexo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':email' => $email,
            ':telefono' => $telefono,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':direccion' => $direccion,
            ':sexo' => $sexo
        ]);
        $idUser = $pdo->lastInsertId();


        $sql = "INSERT INTO users_login (idUser, usuario, password) VALUES (:idUser, :usuario, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':idUser' => $idUser,
            ':usuario' => $usuario,
            ':password' => $hashed_password
        ]);

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function iniciarSesion($usuario, $password) {
    global $pdo;

    $sql = "SELECT * FROM users_login WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['idUser'] = $user['idUser'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];
        return $user;
    } else {
        return false;
    }
}

function isLoggedIn() {
    return isset($_SESSION['idUser']);
}

function getUserRole() {
    return $_SESSION['rol'] ?? null;
}

function cerrarSesion() {
    session_destroy();
    header("Location: index.php");
    exit();
}

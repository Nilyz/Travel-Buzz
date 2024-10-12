<?php
// auth.php - Funciones de autenticación
require_once 'db.php'; // Si db.php está en la raíz

// Asegúrate de que la sesión esté iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function registrarUsuario($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password) {
    global $pdo;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insertar en users_data
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

        // Insertar en users_login
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
        // Iniciar sesión estableciendo las variables de sesión
        $_SESSION['idUser'] = $user['idUser'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];
        return $user;
    } else {
        return false;
    }
}

function isLoggedIn() {
    // Verificar si el usuario está logueado
    return isset($_SESSION['idUser']);
}

function getUserRole() {
    // Obtener el rol del usuario
    return $_SESSION['rol'] ?? null;
}

function cerrarSesion() {
    // Cerrar la sesión
    session_destroy();
    header("Location: index.php");
    exit();
}

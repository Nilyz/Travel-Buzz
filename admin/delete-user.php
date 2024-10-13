<?php

include '../functions/auth.php';
include '../functions/users.php';


if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'] ?? null;

if ($id) {
    if (deleteUser($id)) {
        header('Location: usuarios-administracion.php?mensaje=eliminado');
        exit();
    } else {
        header('Location: usuarios-administracion.php?mensaje=error');
        exit();
    }
} else {
    header('Location: usuarios-administracion.php?mensaje=no-id');
    exit();
}
?>

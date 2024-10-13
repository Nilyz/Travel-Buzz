<?php

require_once 'functions/auth.php'; 
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Llamar a la función para validar al usuario
    $user = iniciarSesion($usuario, $password);

    if ($user) {
        // Si el inicio de sesión es exitoso, redirigir a la página principal
        header('Location: index.php');
        exit();
    } else {

        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/headerFooter.css"> 
    <link rel="stylesheet" href="css/sesion.css">
    <script src="js/header.js" defer></script>
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="main-container">
        <div class="login-form">
            <h1>Iniciar Sesión</h1>

            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>

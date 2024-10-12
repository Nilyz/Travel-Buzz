<?php
// login.php
require_once 'functions/auth.php'; // Incluir el archivo donde se define iniciarSesion()

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Llamar a la función iniciarSesion para validar al usuario
    $user = iniciarSesion($usuario, $password);

    if ($user) {
        // Si el inicio de sesión es exitoso, redirigir a la página principal
        header('Location: index.php');
        exit();
    } else {
        // Mostrar mensaje de error si las credenciales son incorrectas
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label>Usuario:</label>
        <input type="text" name="usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>

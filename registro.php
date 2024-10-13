<?php

include 'functions/users.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $rol = 'user'; // rol predeterminado


    if (createUser($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password, $rol)) {
        $message = "<p class='success-message'>Registro exitoso. Ahora puedes <a href='login.php'>iniciar sesión</a>.</p>";
    } else {
        $message = "<p class='error-message'>Error al registrar el usuario. Inténtalo de nuevo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/header.js" defer></script>
    <title>Registro | Travel Buzz</title>
</head>
<body>
<?php include 'includes/header.php';?>
    <main>
        <div class="formCont">
            <h2>Registro</h2>

            <?php if (isset($message)): ?>
                <?php echo $message; ?>
            <?php endif; ?>

            <form method="POST" action="registro.php">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>

                <label>Apellidos:</label>
                <input type="text" name="apellidos" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Teléfono:</label>
                <input type="text" name="telefono" required>

                <label>Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" required>

                <label>Dirección:</label>
                <input type="text" name="direccion">

                <label>Sexo:</label>
                <select name="sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="O">Otro</option>
                </select>

                <label>Usuario:</label>
                <input type="text" name="usuario" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit">Registrarse</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php include 'includes/footer.php'; ?>

<?php
include 'includes/header.php';

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

    // Llama a la función correcta registrarUsuario() en lugar de register()
    if (registrarUsuario($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password)) {
        echo "<p>Registro exitoso. Ahora puedes <a href='login.php'>iniciar sesión</a>.</p>";
    } else {
        echo "<p>Error al registrar el usuario. Inténtalo de nuevo.</p>";
    }
}
?>

<h2>Registro</h2>
<form method="POST" action="registro.php">
    <label>Nombre:</label><input type="text" name="nombre" required><br>
    <label>Apellidos:</label><input type="text" name="apellidos" required><br>
    <label>Email:</label><input type="email" name="email" required><br>
    <label>Teléfono:</label><input type="text" name="telefono" required><br>
    <label>Fecha de Nacimiento:</label><input type="date" name="fecha_nacimiento" required><br>
    <label>Dirección:</label><input type="text" name="direccion"><br>
    <label>Sexo:</label>
    <select name="sexo">
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
        <option value="O">Otro</option>
    </select><br>
    <label>Usuario:</label><input type="text" name="usuario" required><br>
    <label>Contraseña:</label><input type="password" name="password" required><br>
    <button type="submit">Registrarse</button>
</form>

<?php include 'includes/footer.php'; ?>

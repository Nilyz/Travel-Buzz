<?php
// admin/usuarios-administracion.php


include '../functions/auth.php';
require_once '../db.php'; 
include '../functions/users.php';
include '../includes/header.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$usuarios = getAllUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura todos los campos necesarios
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $usuario = $_POST['username'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    if (createUser($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $usuario, $password, $rol)) {
        header('Location: usuarios-administracion.php');
        exit();
    } else {
        echo "<p>Error al crear el usuario. Inténtalo de nuevo.</p>";
    }
}

?>

<main>
    <h1>Administración de Usuarios</h1>

    <h2>Crear Nuevo Usuario</h2>
<form action="usuarios-administracion.php" method="POST">
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
    <input type="text" name="direccion" required>

    <label>Sexo:</label>
    <select name="sexo" required>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
        <option value="otro">Otro</option>
    </select>

    <label>Nombre de Usuario:</label>
    <input type="text" name="username" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <label>Rol:</label>
    <select name="rol" required>
        <option value="user">Usuario</option>
        <option value="admin">Administrador</option>
    </select>

    <button type="submit">Crear Usuario</button>
</form>


    <h2>Usuarios Existentes</h2>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
            <li>
                <?php echo htmlspecialchars($usuario['nombre']); ?> - 
                <?php echo htmlspecialchars($usuario['rol']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php
include '../includes/footer.php';
?>

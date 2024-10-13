<?php
include '../functions/auth.php';
include '../functions/users.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$usuario = getUserById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $username = $_POST['username'];
    $rol = $_POST['rol'];

    if (updateUser($id, $username, $nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $rol)) {
        header('Location: usuarios-administracion.php?mensaje=actualizado');
        exit();
    } else {
        echo "<p class='error-message'>Error al actualizar el usuario.</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/usuarios-admin.css">
    <script src="../js/header.js" defer></script>
    <title>Editar Usuario</title>
</head>
<body>
    
<?php include '../includes/header.php'; ?>

<main class="admin-container">
    <section class="form-section">
        <h2>Editar Usuario</h2>
        <form action="edit-user.php?id=<?php echo $usuario['idUser']; ?>" method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>

            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" value="<?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?>" required>

            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>" required>

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="masculino" <?php if ($usuario['sexo'] == 'masculino') echo 'selected'; ?>>Masculino</option>
                <option value="femenino" <?php if ($usuario['sexo'] == 'femenino') echo 'selected'; ?>>Femenino</option>
                <option value="otro" <?php if ($usuario['sexo'] == 'otro') echo 'selected'; ?>>Otro</option>
            </select>

            <label>Nombre de Usuario:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required>

            <label>Rol:</label>
            <select name="rol" required>
                <option value="user" <?php if ($usuario['rol'] == 'user') echo 'selected'; ?>>Usuario</option>
                <option value="admin" <?php if ($usuario['rol'] == 'admin') echo 'selected'; ?>>Administrador</option>
            </select>

            <button type="submit">Actualizar Usuario</button>
        </form>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

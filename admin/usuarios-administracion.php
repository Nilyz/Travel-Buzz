<?php

include '../functions/auth.php';
include '../functions/users.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$usuarios = getAllUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        echo "<p class='error-message'>Error al crear el usuario. Inténtalo de nuevo.</p>";
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
    <title>Administración de Usuarios</title>
</head>
<body>
    
<?php include '../includes/header.php'; ?>

<main>
    <h1>Administrar usuarios</h1>
<div class="admin-container">
    <section class="form-section">
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
    </section>

    <section class="list-section">
        <h2>Usuarios Existentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                        <td>
                            <a href="edit-user.php?id=<?php echo $usuario['idUser']; ?>" class="edit-btn">Editar</a>
                            <a href="delete-user.php?id=<?php echo $usuario['idUser']; ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
                </div>
</main>


<?php include '../includes/footer.php'; ?>
</body>
</html>

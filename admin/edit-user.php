<?php
session_start();
include 'db.php';
include 'includes/header.php';

// Verifica si el usuario es admin
if (!isset($_SESSION['idUser']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del usuario
    $sql = "SELECT * FROM users_data WHERE idUser = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "<p>Usuario no encontrado.</p>";
        exit();
    }

    // Actualizar datos del usuario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $direccion = $_POST['direccion'];
        $sexo = $_POST['sexo'];

        $sql = "UPDATE users_data SET nombre = ?, apellidos = ?, email = ?, telefono = ?, fecha_nacimiento = ?, direccion = ?, sexo = ? WHERE idUser = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo, $id])) {
            echo "<p>Usuario actualizado correctamente.</p>";
        } else {
            echo "<p>Error al actualizar el usuario.</p>";
        }
    }
} else {
    echo "<p>No se ha especificado un ID de usuario.</p>";
    exit();
}
?>

<h1>Editar Usuario</h1>
<form action="edit-user.php?id=<?php echo $id; ?>" method="POST">
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
    <input type="text" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>
    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
    <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>
    <input type="date" name="fecha_nacimiento" value="<?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?>" required>
    <textarea name="direccion"><?php echo htmlspecialchars($usuario['direccion']); ?></textarea>
    <select name="sexo" required>
        <option value="masculino" <?php if($usuario['sexo'] === 'masculino') echo 'selected'; ?>>Masculino</option>
        <option value="femenino" <?php if($usuario['sexo'] === 'femenino') echo 'selected'; ?>>Femenino</option>
        <option value="otro" <?php if($usuario['sexo'] === 'otro') echo 'selected'; ?>>Otro</option>
    </select>
    <button type="submit">Actualizar Usuario</button>
</form>

<?php
include 'includes/footer.php';
?>

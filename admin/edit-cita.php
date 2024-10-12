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

    // Obtener datos de la cita
    $sql = "SELECT * FROM citas WHERE idCita = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cita) {
        echo "<p>Cita no encontrada.</p>";
        exit();
    }

    // Actualizar datos de la cita
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idUser = $_POST['idUser'];
        $fecha_cita = $_POST['fecha_cita'];
        $motivo_cita = $_POST['motivo_cita'];

        $sql = "UPDATE citas SET idUser = ?, fecha_cita = ?, motivo_cita = ? WHERE idCita = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$idUser, $fecha_cita, $motivo_cita, $id])) {
            echo "<p>Cita actualizada correctamente.</p>";
        } else {
            echo "<p>Error al actualizar la cita.</p>";
        }
    }
} else {
    echo "<p>No se ha especificado un ID de cita.</p>";
    exit();
}
?>

<h1>Editar Cita</h1>
<form action="edit-cita.php?id=<?php echo $id; ?>" method="POST">
    <select name="idUser" required>
        <option value="">Selecciona un Usuario</option>
        <?php
        // Listar usuarios para la selección
        $sql = "SELECT * FROM users_data";
        $stmt = $pdo->query($sql);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $usuario) {
            echo "<option value=\"{$usuario['idUser']}\" " . ($usuario['idUser'] === $cita['idUser'] ? 'selected' : '') . ">{$usuario['nombre']}</option>";
        }
        ?>
    </select>
    <input type="date" name="fecha_cita" value="<?php echo htmlspecialchars($cita['fecha_cita']); ?>" required>
    <textarea name="motivo_cita" required><?php echo htmlspecialchars($cita['motivo_cita']); ?></textarea>
    <button type="submit">Actualizar Cita</button>
</form>

<?php
include 'includes/footer.php';
?>

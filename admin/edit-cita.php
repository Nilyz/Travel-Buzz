<?php

include '../functions/auth.php';
include '../functions/appointments.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $citaId = $_GET['id'];
    $cita = getAppointmentById($citaId);

    if (!$cita) {
        echo "<p>Cita no encontrada.</p>";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fecha_cita = $_POST['fecha_cita'];
        $motivo_cita = $_POST['motivo_cita'];

        if (updateAppointment($citaId, $fecha_cita, $motivo_cita)) {
            header('Location: citas-administracion.php');
            exit();
        } else {
            echo "<p>Error al actualizar la cita.</p>";
        }
    }
} else {
    echo "<p>No se ha especificado un ID de cita.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/citas-admin.css">
    <script src="../js/header.js" defer></script>
    <title>Editar Cita</title>
</head>
<body>
<?php include '../includes/header.php'; ?>
<main>
    <h1>Editar Cita</h1>
    <form action="edit-cita.php?id=<?php echo $cita['idCita']; ?>" method="POST">
        <label>Fecha de la Cita:</label>
        <input type="datetime-local" name="fecha_cita" value="<?php echo htmlspecialchars($cita['fecha_cita']); ?>" required>
        
        <label>Motivo de la Cita:</label>
        <input type="text" name="motivo_cita" value="<?php echo htmlspecialchars($cita['motivo_cita']); ?>" required>

        <button type="submit">Actualizar Cita</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

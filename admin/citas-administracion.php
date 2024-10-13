<?php

include '../functions/auth.php';
include '../functions/appointments.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$citas = getAllAppointments();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha_cita = $_POST['fecha_cita'];
    $motivo_cita = $_POST['motivo_cita'];
    $idUser = $_SESSION['idUser'];

    createAppointment($idUser, $fecha_cita, $motivo_cita);
    header('Location: citas-administracion.php');
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
    <title>Administración de Citas</title>
</head>
<body>
<?php include '../includes/header.php'; ?>
<main>
<h1>Administración de Citas</h1>
    <div class="citasCont">


<h2>Crear Nueva Cita</h2>
<form action="citas-administracion.php" method="POST">
    <label>Fecha de la Cita:</label>
    <input type="datetime-local" name="fecha_cita" required>
    
    <label>Motivo de la Cita:</label>
    <input type="text" name="motivo_cita" required>

    <button type="submit">Crear Cita</button>
</form>

<h2>Citas Planificadas</h2>
<ul>
    <?php foreach ($citas as $cita): ?>
        <li>
            <?php echo htmlspecialchars($cita['fecha_cita']); ?> - 
            <?php echo htmlspecialchars($cita['motivo_cita']); ?> - 
            <?php echo htmlspecialchars($cita['nombre'] . ' ' . $cita['apellidos']); ?> - 
            <a href="edit-cita.php?id=<?php echo $cita['idCita']; ?>" class="edit-btn">Editar</a>
            <a href="delete-cita.php?id=<?php echo $cita['idCita']; ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar esta cita?');">Eliminar</a>
        </li>
    <?php endforeach; ?>
</ul>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

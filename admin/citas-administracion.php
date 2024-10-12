<?php
// admin/citas-administracion.php
include '../functions/auth.php';
include '../functions/appointments.php';
include '../includes/header.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$citas = getAllAppointments();
?>

<main>
    <h1>Administración de Citas</h1>

    <h2>Citas Planificadas</h2>
    <ul>
        <?php foreach ($citas as $cita): ?>
            <li>
                <?php echo htmlspecialchars($cita['fecha_cita']); ?> - 
                <?php echo htmlspecialchars($cita['motivo_cita']); ?> - 
                <?php echo htmlspecialchars($cita['nombre']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php
include '../includes/footer.php';
?>

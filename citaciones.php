<?php
// citaciones.php
include 'functions/auth.php'; // Asegúrate de incluir auth.php para usar isLoggedIn
include 'functions/appointments.php';
include 'includes/header.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['idUser'];

// Procesar la solicitud de creación de una cita
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['delete_cita'])) {
    $fechaCita = $_POST['fecha_cita'];
    $motivoCita = $_POST['motivo_cita'];

    // Validación básica
    if (!empty($fechaCita) && !empty($motivoCita)) {
        createAppointment($userId, $fechaCita, $motivoCita);
        header('Location: citaciones.php');
        exit();
    }
}

// Procesar la eliminación de una cita
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_cita'])) {
    $citaId = $_POST['delete_cita'];

    // Verificar que la cita pertenece al usuario logueado antes de eliminarla
    if (isUserAppointment($userId, $citaId)) {
        deleteAppointment($citaId);
        header('Location: citaciones.php');
        exit();
    } else {
        echo "<p>Error: No tienes permiso para eliminar esta cita.</p>";
    }
}

// Obtener las citas del usuario
$citas = getAppointmentsByUser($userId);
?>

<main>
    <h1>Mis Citas</h1>

    <h2>Solicitar Nueva Cita</h2>
    <form action="citaciones.php" method="POST">
        <label>Fecha de la Cita:</label>
        <input type="date" name="fecha_cita" required>
        
        <label>Motivo de la Cita:</label>
        <input type="text" name="motivo_cita" required>

        <button type="submit">Solicitar Cita</button>
    </form>

    <h2>Citas Planificadas</h2>
    <ul>
        <?php if (!empty($citas)): ?>
            <?php foreach ($citas as $cita): ?>
                <li>
                    <?php echo htmlspecialchars($cita['fecha_cita']); ?> - 
                    <?php echo htmlspecialchars($cita['motivo_cita']); ?>
                    <form action="citaciones.php" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_cita" value="<?php echo htmlspecialchars($cita['idCita']); ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No tienes citas planificadas.</li>
        <?php endif; ?>
    </ul>
</main>

<?php
include 'includes/footer.php';
?>

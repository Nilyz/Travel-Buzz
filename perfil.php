<?php
session_start();
include 'db.php'; 
include 'includes/header.php';

// Asegúrate de que el usuario esté logueado
if (!isset($_SESSION['idUser'])) {
    header('Location: login.php');
    exit();
}

$idUser = $_SESSION['idUser'];
$sql = "SELECT * FROM users_data WHERE idUser = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idUser]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h1>Perfil de <?php echo htmlspecialchars($user['nombre']); ?></h1>
<p>Nombre: <?php echo htmlspecialchars($user['nombre']); ?></p>
<p>Apellidos: <?php echo htmlspecialchars($user['apellidos']); ?></p>
<p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
<p>Teléfono: <?php echo htmlspecialchars($user['telefono']); ?></p>
<p>Fecha de Nacimiento: <?php echo htmlspecialchars($user['fecha_nacimiento']); ?></p>
<p>Dirección: <?php echo htmlspecialchars($user['direccion']); ?></p>
<p>Sexo: <?php echo htmlspecialchars($user['sexo']); ?></p>

<?php
include 'includes/footer.php';
?>

<?php
session_start();
include 'functions/db.php';

// Hay que estar logeado para acceder a esta página
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/headerFooter.css"> 
    <link rel="stylesheet" href="css/perfil.css">
    <script src="js/header.js" defer></script>
    <title>Document</title>
</head>

<body>
<?php include 'includes/header.php';?>
<main>
    <div class="fondo"></div>
    <div class="infoCont">
        <h1>Perfil de <?php echo htmlspecialchars($user['nombre']); ?></h1>
        <div class="userInfo">
            <p>Nombre: <?php echo htmlspecialchars($user['nombre']); ?></p>
            <p>Apellidos: <?php echo htmlspecialchars($user['apellidos']); ?></p>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Teléfono: <?php echo htmlspecialchars($user['telefono']); ?></p>
            <p>Fecha de Nacimiento: <?php echo htmlspecialchars($user['fecha_nacimiento']); ?></p>
            <p>Dirección: <?php echo htmlspecialchars($user['direccion']); ?></p>
            <p>Sexo: <?php echo htmlspecialchars($user['sexo']); ?></p>
        </div>
        
    </div>

</main>
    

    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>
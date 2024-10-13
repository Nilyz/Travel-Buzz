<?php
session_start();
include '../functions/db.php';

if (!isset($_SESSION['idUser']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM noticias WHERE idNoticia = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$noticia) {
        echo "<p>Noticia no encontrada.</p>";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $imagen = $_POST['imagen'];
        $texto = $_POST['texto'];

        $sql = "UPDATE noticias SET titulo = ?, imagen = ?, texto = ? WHERE idNoticia = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$titulo, $imagen, $texto, $id])) {
            $_SESSION['message'] = "Noticia actualizada correctamente.";
            header('Location: noticias-administracion.php');
            exit();
        } else {
            echo "<p>Error al actualizar la noticia.</p>";
        }
    }
} else {
    echo "<p>No se ha especificado un ID de noticia.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/noticias-admin.css">
    <script src="../js/header.js" defer></script>
    <title>Editar Noticia</title>
</head>
<body>

<?php include '../includes/header.php'; ?>

<main>
    <h1>Editar Noticia</h1>
    <form action="edit-noticia.php?id=<?php echo $id; ?>" method="POST">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>
        
        <label>Imagen:</label>
        <input type="text" name="imagen" value="<?php echo htmlspecialchars($noticia['imagen']); ?>" required>
        
        <label>Texto:</label>
        <textarea name="texto" required><?php echo htmlspecialchars($noticia['texto']); ?></textarea>
        
        <button type="submit">Actualizar Noticia</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

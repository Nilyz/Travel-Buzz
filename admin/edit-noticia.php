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

    // Obtener datos de la noticia
    $sql = "SELECT * FROM noticias WHERE idNoticia = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$noticia) {
        echo "<p>Noticia no encontrada.</p>";
        exit();
    }

    // Actualizar datos de la noticia
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $imagen = $_POST['imagen']; // Para un ejemplo simple, se puede manejar la imagen de otra manera
        $texto = $_POST['texto'];

        $sql = "UPDATE noticias SET titulo = ?, imagen = ?, texto = ? WHERE idNoticia = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$titulo, $imagen, $texto, $id])) {
            echo "<p>Noticia actualizada correctamente.</p>";
        } else {
            echo "<p>Error al actualizar la noticia.</p>";
        }
    }
} else {
    echo "<p>No se ha especificado un ID de noticia.</p>";
    exit();
}
?>

<h1>Editar Noticia</h1>
<form action="edit-noticia.php?id=<?php echo $id; ?>" method="POST">
    <input type="text" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>
    <input type="text" name="imagen" value="<?php echo htmlspecialchars($noticia['imagen']); ?>" required>
    <textarea name="texto" required><?php echo htmlspecialchars($noticia['texto']); ?></textarea>
    <button type="submit">Actualizar Noticia</button>
</form>

<?php
include 'includes/footer.php';
?>

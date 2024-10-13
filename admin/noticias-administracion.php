<?php
session_start();
include '../functions/auth.php';
include '../functions/news.php';

// Verifica si el usuario es admin
if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}


if (isset($_SESSION['message'])) {
    echo "<p class='message'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}

$noticias = getAllNews();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $imagen = $_POST['imagen'];
    $texto = $_POST['texto'];
    $idUser = $_SESSION['idUser'];

    createNews($titulo, $imagen, $texto, $idUser);
    $_SESSION['message'] = "Noticia creada correctamente.";
    header('Location: noticias-administracion.php');
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
    <title>Administración de Noticias</title>
</head>
<body>
<?php include '../includes/header.php'; ?>
<main>
<h1>Administración de Noticias</h1>
    <div class="noticiasCont">


<h2>Crear Nueva Noticia</h2>
<form action="noticias-administracion.php" method="POST">
    <label>Título:</label>
    <input type="text" name="titulo" required>
    
    <label>Imagen:</label>
    <input type="text" name="imagen" required>
    
    <label>Texto:</label>
    <textarea name="texto" required></textarea>

    <button type="submit">Crear Noticia</button>
</form>

<h2>Noticias Existentes</h2>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($noticias as $noticia): ?>
            <tr>
                <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                <td><?php echo htmlspecialchars($noticia['fecha']); ?></td>
                <td>
                    <a href="edit-noticia.php?id=<?php echo $noticia['idNoticia']; ?>" class="edit-btn">Editar</a>
                    <a href="delete-noticia.php?id=<?php echo $noticia['idNoticia']; ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar esta noticia?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

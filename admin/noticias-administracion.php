<?php
// admin/noticias-administracion.php
include '../functions/auth.php';
include '../functions/news.php';
include '../includes/header.php';

if (!isLoggedIn() || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$noticias = getAllNews();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $imagen = $_POST['imagen'];
    $texto = $_POST['texto'];
    $idUser = $_SESSION['idUser'];

    createNews($titulo, $imagen, $texto, $idUser);
    header('Location: noticias-administracion.php');
    exit();
}
?>

<main>
    <h1>Administración de Noticias</h1>

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
    <ul>
        <?php foreach ($noticias as $noticia): ?>
            <li>
                <?php echo htmlspecialchars($noticia['titulo']); ?> - 
                <?php echo htmlspecialchars($noticia['fecha']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php
include '../includes/footer.php';
?>

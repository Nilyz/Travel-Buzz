<?php
// noticias.php
include 'functions/news.php';
include 'includes/header.php';

$noticias = getAllNews();
?>

<main>
    <h1>Noticias</h1>
    <?php foreach ($noticias as $noticia): ?>
        <article>
            <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
            <p><strong>Publicado el:</strong> <?php echo $noticia['fecha']; ?></p>
            <img src="<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="Imagen de la noticia">
            <p><?php echo nl2br(htmlspecialchars($noticia['texto'])); ?></p>
        </article>
    <?php endforeach; ?>
</main>

<?php
include 'includes/footer.php';
?>

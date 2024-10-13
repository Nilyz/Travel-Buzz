<?php
include 'functions/news.php';


$noticias = getAllNews();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/headerFooter.css"> 
    <link rel="stylesheet" href="css/noticias.css">
    <script src="js/header.js" defer></script>
    <title>Document</title>
</head>
<body>
<?php include 'includes/header.php';?>
<main>
    <h1>Noticias</h1>
    <?php foreach ($noticias as $noticia): ?>
        <article>
            <div class="news_Text">
                <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                <p>Publicado el: <?php echo $noticia['fecha']; ?></p>
                <p><?php echo nl2br(htmlspecialchars($noticia['texto'])); ?></p>
            </div>
            <img src="<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="Imagen de la noticia">
        </article>
    <?php endforeach; ?>
</main>
<?php
include 'includes/footer.php';
?>
</body>
</html>



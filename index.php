
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/headerFooter.css"> 
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

    <?php include 'includes/header.php';?>
    <div class="landing">
        <h1>¡Explora el Mundo con Nosotros!</h1>
        <p>Paquetes de viajes personalizados a los mejores destinos.</p>
        <button>
            <a href="registro.php">Reserva tu Aventura</a>
        </button>
    </div>

    <main>
        <section id="about">
            <img src="img/paisaje1.jpg" alt="Imagen sobre nosotros" class="responsive">

            <div class="about_text">
                <h2>Sobre Nosotros</h2>
                <p>
                En Travel Buzz, nos especializamos en crear experiencias de viaje inolvidables, adaptadas a tus deseos y necesidades. Desde escapadas de fin de semana hasta viajes alrededor del mundo, ¡tenemos algo para todos!
                </p>
            </div>
        </section>

        <section id="news">
            <h2>Últimas Noticias</h2>
            <article>
                <div class="news_Text">
                    <h3>Título de Noticia 1</h3>
                    <p>Publicado el: 2024-10-01</p>
                    <P>TravelBuzz lanza una nueva ruta que te llevará por los parajes más espectaculares del norte del país. Desde bosques hasta montañas, los viajeros podrán disfrutar de experiencias únicas y descubrir la biodiversidad de la región.</P>
                    <button><a href="noticias.php">Más noticias</a></button>

                </div>
                
                <img src="img/paisaje1.jpg" alt="">
            </article>
        </section>

        <section id="appointments">
            <h2>Gestiona tus Citas</h2>
            <p>
                A través de nuestra plataforma puedes solicitar y gestionar tus citas fácilmente. 
                <a href="citaciones.php">Ver Citas</a>
            </p>
        </section>
    </main>

    <?php
        include 'includes/footer.php';
    ?>

</body>
</html>

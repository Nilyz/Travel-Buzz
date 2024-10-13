<?php
// Inicia la sesión si no ha sido iniciada aún
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav id="nav">
    <div class="logo">
        <p>Travel Buzz</p>
        <img src="/TrabajoPHP/img/logo.svg" alt="Logo de Travel Buzz">
    </div>
    <ul>
        <li><a href="/TrabajoPHP/index.php">Inicio</a></li>

        <?php if (isset($_SESSION['idUser'])): ?>
            <?php if ($_SESSION['rol'] === 'user'): ?>
                <!-- Mostrar Citas y Perfil para usuarios -->
                <li><a href="/TrabajoPHP/noticias.php">Noticias</a></li>
                <li><a href="/TrabajoPHP/citaciones.php">Citas</a></li>
                <li><a href="/TrabajoPHP/perfil.php">Mi Perfil</a></li>
            <?php elseif ($_SESSION['rol'] === 'admin'): ?>
                <!-- Navegación para administradores -->
                <li><a href="/TrabajoPHP/admin/usuarios-administracion.php">Administrar Usuarios</a></li>
                <li><a href="/TrabajoPHP/admin/citas-administracion.php">Administrar Citas</a></li>
                <li><a href="/TrabajoPHP/admin/noticias-administracion.php">Administrar Noticias</a></li>
            <?php endif; ?>
            <li><a href="/TrabajoPHP/logout.php">Cerrar Sesión</a></li>
        <?php else: ?>
            <!-- Mostrar solo Noticias cuando no hay sesión iniciada -->
            <li><a href="/TrabajoPHP/noticias.php">Noticias</a></li>
            <li><a href="/TrabajoPHP/login.php">Iniciar Sesión</a></li>
            <li><a href="/TrabajoPHP/registro.php">Registrarse</a></li>
        <?php endif; ?>
    </ul>
</nav>

<?php
// Asegúrate de que la sesión no esté iniciada previamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <ul>
        <li><a href="/TrabajoPHP/index.php">Inicio</a></li>

        <?php if (isset($_SESSION['idUser'])): ?>
            <?php if ($_SESSION['rol'] === 'user'): ?>
                <li><a href="/TrabajoPHP/noticias.php">Noticias</a></li>
                <li><a href="/TrabajoPHP/citaciones.php">Citas</a></li>
                <li><a href="/TrabajoPHP/perfil.php">Mi Perfil</a></li>
            <?php elseif ($_SESSION['rol'] === 'admin'): ?>
                <li><a href="/TrabajoPHP/admin/usuarios-administracion.php">Administrar Usuarios</a></li>
                <li><a href="/TrabajoPHP/admin/citas-administracion.php">Administrar Citas</a></li>
                <li><a href="/TrabajoPHP/admin/noticias-administracion.php">Administrar Noticias</a></li>
            <?php endif; ?>
            
            <li><a href="/TrabajoPHP/logout.php">Cerrar Sesión</a></li>
        <?php else: ?>
            <li><a href="/TrabajoPHP/login.php">Iniciar Sesión</a></li>
            <li><a href="/TrabajoPHP/registro.php">Registrarse</a></li>
        <?php endif; ?>
    </ul>
</nav>

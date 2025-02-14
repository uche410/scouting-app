<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Home - Sports Scouting</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
        <nav class="navbar">
            <ul>
                <li><a href="home.php">Inicio</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="mensajes.php">Mensajes</a></li>
                <li><a href="bienvenida.php">Bienvenida</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <h1>Bienvenido a Sports Scouting</h1>
            <p>Esta es tu página principal, accede a las secciones desde la barra superior.</p>
        </div>
    </body>
</html>

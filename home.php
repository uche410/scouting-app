<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Scouting App</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<nav class="navbar">
    <ul>
        <li><a href="home.php">🏠 Inicio</a></li>
        <li><a href="perfil.php">👤 Perfil</a></li>
        <li><a href="busqueda.php">🔍 Búsqueda</a></li>
        <li><a href="mensajeria.php">💬 Mensajes</a></li>
        <li><a href="logout.php">🚪 Cerrar sesión</a></li>
    </ul>
</nav>

<div class="main-container">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
    <p>Esta es tu página principal de Scouting App. Explora tus estadísticas, contactos y mensajes.</p>
</div>

</body>
</html>
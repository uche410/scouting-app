<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }
  
  $usuario = $_SESSION['usuario'];
  $notificaciones = $conn->query("SELECT * FROM notificaciones WHERE usuario = '$usuario' ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Notificaciones</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Mis Notificaciones</h1>
  <ul>
    <?php if ($notificaciones->num_rows > 0): ?>
      <?php while ($notif = $notificaciones->fetch_assoc()): ?>
        <li><strong><?= htmlspecialchars($notif['titulo']) ?>:</strong> <?= htmlspecialchars($notif['mensaje']) ?> (<?= $notif['fecha'] ?>)</li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No tienes notificaciones.</p>
    <?php endif; ?>
  </ul>
  <a href="bienvenida.php">Volver</a>
</body>
</html>
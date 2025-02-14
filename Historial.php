<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }

  $usuario = $_SESSION['usuario'];

  // Obtener historial de actividades
  $historial = $conn->query("SELECT actividad, fecha FROM historial WHERE usuario = '$usuario' ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de Actividades</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Historial de Actividades</h1>
  <ul>
    <?php if ($historial->num_rows > 0): ?>
      <?php while ($row = $historial->fetch_assoc()): ?>
        <li><?= htmlspecialchars($row['fecha']) ?> - <?= htmlspecialchars($row['actividad']) ?></li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No hay actividades registradas.</p>
    <?php endif; ?>
  </ul>
  
  <a href="bienvenida.php">Volver</a>
</body>
</html>
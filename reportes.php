<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
      header('Location: index.php');
      exit();
  }

  // Obtener reportes de actividades de todos los usuarios
  $reportes = $conn->query("SELECT usuario, actividad, fecha FROM historial ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes de Actividades</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Reportes de Actividades</h1>
  <table border="1">
    <tr>
      <th>Usuario</th>
      <th>Actividad</th>
      <th>Fecha</th>
    </tr>
    <?php if ($reportes->num_rows > 0): ?>
      <?php while ($reporte = $reportes->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($reporte['usuario']) ?></td>
          <td><?= htmlspecialchars($reporte['actividad']) ?></td>
          <td><?= htmlspecialchars($reporte['fecha']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="3">No se encontraron reportes.</td></tr>
    <?php endif; ?>
  </table>
  
  <a href="admin.php">Volver al Panel</a>
</body>
</html>

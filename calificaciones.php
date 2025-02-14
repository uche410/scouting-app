<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }

  $usuario = $_SESSION['usuario'];

  // Guardar calificación
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $jugador = $_POST['jugador'];
      $calificacion = $_POST['calificacion'];
      $conn->query("INSERT INTO calificaciones (usuario, jugador, calificacion) VALUES ('$usuario', '$jugador', '$calificacion') ON DUPLICATE KEY UPDATE calificacion='$calificacion'");
  }

  // Mostrar calificaciones
  $calificaciones = $conn->query("SELECT jugador, calificacion FROM calificaciones WHERE usuario = '$usuario'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calificaciones</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Calificar Jugadores</h1>
  <form method="POST">
    <label>Nombre del Jugador:</label>
    <input type="text" name="jugador" placeholder="Jugador" required>
    <label>Calificación (1-5):</label>
    <input type="number" name="calificacion" min="1" max="5" required>
    <button type="submit">Guardar</button>
  </form>

  <h2>Mis Calificaciones:</h2>
  <ul>
    <?php if ($calificaciones->num_rows > 0): ?>
      <?php while ($row = $calificaciones->fetch_assoc()): ?>
        <li><?= htmlspecialchars($row['jugador']) ?> - <?= htmlspecialchars($row['calificacion']) ?>/5</li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No has calificado a ningún jugador aún.</p>
    <?php endif; ?>
  </ul>
  
  <a href="bienvenida.php">Volver</a>
</body>
</html>
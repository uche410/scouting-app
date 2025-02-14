<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }

  $usuario = $_SESSION['usuario'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $jugador = $_POST['jugador'];
      $conn->query("INSERT IGNORE INTO favoritos (usuario, jugador) VALUES ('$usuario', '$jugador')");
  }

  $favoritos = $conn->query("SELECT jugador FROM favoritos WHERE usuario = '$usuario'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Favoritos</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Mis Favoritos</h1>
  <form method="POST">
    <label>Nombre del Jugador:</label>
    <input type="text" name="jugador" placeholder="Jugador" required>
    <button type="submit">Agregar a Favoritos</button>
  </form>

  <h2>Lista de Jugadores Favoritos:</h2>
  <ul>
    <?php if ($favoritos->num_rows > 0): ?>
      <?php while ($row = $favoritos->fetch_assoc()): ?>
        <li><?= htmlspecialchars($row['jugador']) ?></li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No tienes jugadores favoritos aún.</p>
    <?php endif; ?>
  </ul>
  
  <a href="bienvenida.php">Volver</a>
</body>
</html>
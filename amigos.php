<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }
  
  $usuario = $_SESSION['usuario'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $amigo = $_POST['amigo'];
      $conn->query("INSERT INTO amigos (usuario, amigo) VALUES ('$usuario', '$amigo')");
  }

  $amigos = $conn->query("SELECT amigo FROM amigos WHERE usuario = '$usuario'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Amigos</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Mis Amigos</h1>
  <form method="POST">
    <label>Añadir Amigo:</label>
    <input type="text" name="amigo" placeholder="Usuario" required>
    <button type="submit">Agregar</button>
  </form>

  <h2>Lista de Amigos:</h2>
  <ul>
    <?php if ($amigos->num_rows > 0): ?>
      <?php while ($row = $amigos->fetch_assoc()): ?>
        <li><?= htmlspecialchars($row['amigo']) ?></li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No tienes amigos agregados.</p>
    <?php endif; ?>
  </ul>
  <a href="bienvenida.php">Volver</a>
</body>
</html>
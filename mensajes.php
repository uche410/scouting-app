<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $receptor = $_POST['receptor'];
      $mensaje = $_POST['mensaje'];
      $emisor = $_SESSION['usuario'];
      $conn->query("INSERT INTO mensajes (emisor, receptor, mensaje) VALUES ('$emisor', '$receptor', '$mensaje')");
  }
  
  $mensajes = $conn->query("SELECT * FROM mensajes WHERE receptor = '" . $_SESSION['usuario'] . "'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mensajes</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Bandeja de Mensajes</h1>
  <form method="POST">
    <label>Para (usuario):</label>
    <input type="text" name="receptor" required>
    <label>Mensaje:</label>
    <textarea name="mensaje" required></textarea>
    <button type="submit">Enviar</button>
  </form>
  
  <h2>Mensajes Recibidos:</h2>
  <ul>
    <?php while ($msg = $mensajes->fetch_assoc()): ?>
      <li><strong><?= htmlspecialchars($msg['emisor']) ?>:</strong> <?= htmlspecialchars($msg['mensaje']) ?></li>
    <?php endwhile; ?>
  </ul>
  
  <a href="bienvenida.php">Volver</a>
</body>
</html>
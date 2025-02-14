<?php
  session_start();
  require 'conectardb.php';
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }

  $usuario = $_SESSION['usuario'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $contenido = $_POST['contenido'];
      $conn->query("INSERT INTO comentarios (usuario, contenido, fecha) VALUES ('$usuario', '$contenido', NOW())");
  }

  $comentarios = $conn->query("SELECT usuario, contenido, fecha FROM comentarios ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Comentarios</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Comentarios</h1>
  <form method="POST">
    <label>Escribe tu comentario:</label>
    <textarea name="contenido" rows="4" placeholder="Escribe aquí..." required></textarea>
    <button type="submit">Publicar</button>
  </form>

  <h2>Comentarios Recientes:</h2>
  <ul>
    <?php if ($comentarios->num_rows > 0): ?>
      <?php while ($comentario = $comentarios->fetch_assoc()): ?>
        <li>
          <strong><?= htmlspecialchars($comentario['usuario']) ?>:</strong>
          <?= htmlspecialchars($comentario['contenido']) ?>
          <em>(<?= $comentario['fecha'] ?>)</em>
        </li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No hay comentarios aún.</p>
    <?php endif; ?>
  </ul>
  <a href="bienvenida.php">Volver</a>
</body>
</html>

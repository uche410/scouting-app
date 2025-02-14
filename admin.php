<?php
  session_start();
  if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
      header('Location: index.php');
      exit();
  }
  require 'conectardb.php';
  $usuarios = $conn->query("SELECT id, usuario, rol FROM usuarios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Panel de Administración</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Usuario</th>
      <th>Rol</th>
    </tr>
    <?php while ($usuario = $usuarios->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($usuario['id']) ?></td>
        <td><?= htmlspecialchars($usuario['usuario']) ?></td>
        <td><?= htmlspecialchars($usuario['rol']) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <a href="bienvenida.php">Volver</a>
</body>
</html>
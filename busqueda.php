<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }
  require 'conectardb.php';

  $filtro = $_GET['filtro'] ?? '';
  $consulta = $conn->query("SELECT * FROM jugadores WHERE posicion LIKE '%$filtro%' OR nombre LIKE '%$filtro%'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Buscar Jugadores</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Búsqueda de Jugadores</h1>
  <form method="GET">
    <input type="text" name="filtro" placeholder="Buscar por nombre o posición" value="<?= htmlspecialchars($filtro) ?>">
    <button type="submit">Buscar</button>
  </form>

  <h2>Resultados:</h2>
  <ul>
    <?php while ($jugador = $consulta->fetch_assoc()): ?>
      <li>
        <?= htmlspecialchars($jugador['nombre']) ?> - <?= htmlspecialchars($jugador['posicion']) ?>
      </li>
    <?php endwhile; ?>
  </ul>

  <a href="bienvenida.php">Volver</a>
</body>
</html>

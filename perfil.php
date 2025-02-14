<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }
  require 'conectardb.php';
  $usuario = $_SESSION['usuario'];
  $consulta = $conn->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
  $perfil = $consulta->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Perfil</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Perfil de <?= htmlspecialchars($perfil['usuario']) ?></h1>
  <p>Nombre: <?= htmlspecialchars($perfil['nombre']) ?></p>
  <p>Email: <?= htmlspecialchars($perfil['email']) ?></p>
  <a href="editarPerfil.php">Editar Perfil</a>
  <a href="logout.php">Cerrar Sesión</a>
</body>
</html>

<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {
      header('Location: index.php');
      exit();
  }
  require 'conectardb.php';
  $usuario = $_SESSION['usuario'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nombre = $_POST['nombre'];
      $email = $_POST['email'];
      $conn->query("UPDATE usuarios SET nombre='$nombre', email='$email' WHERE usuario='$usuario'");
      header('Location: perfil.php');
      exit();
  }

  $consulta = $conn->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
  $perfil = $consulta->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Editar Perfil</h1>
  <form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($perfil['nombre']) ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($perfil['email']) ?>" required>
    <button type="submit">Guardar Cambios</button>
  </form>
  <a href="perfil.php">Volver</a>
</body>
</html>


<?php
  require 'conectardb.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario = $_POST['usuario'];
      $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
      $email = $_POST['email'];
      $rol = 'usuario';
      $conn->query("INSERT INTO usuarios (usuario, clave, email, rol) VALUES ('$usuario', '$clave', '$email', '$rol')");
      header('Location: index.php');
      exit();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Registrar Nuevo Usuario</h1>
  <form method="POST">
    <label>Usuario:</label>
    <input type="text" name="usuario" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Contraseña:</label>
    <input type="password" name="clave" required>
    <button type="submit">Registrar</button>
  </form>
  <a href="index.php">Volver</a>
</body>
</html>

<?php
  require 'conectardb.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $nuevaClave = password_hash('123456', PASSWORD_DEFAULT);
      $conn->query("UPDATE usuarios SET clave='$nuevaClave' WHERE email='$email'");
      echo "Contraseña restablecida a '123456'.";
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Restablecer Contraseña</h1>
  <form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <button type="submit">Restablecer</button>
  </form>
  <a href="index.php">Volver</a>
</body>
</html>

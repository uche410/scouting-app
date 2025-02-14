<?php
include "conectardb.php";
session_start();
   

    
   
    
    function consultaPass($user, $pass) {
    $pdo = conetarDB();  
    $consulta = "SELECT * FROM login WHERE username = :param";

    $resul = $pdo->prepare($consulta);
    if (!$resul) {
        die("ERROR: Fallo al preparar la consulta SQL.<br>");
    }

    $ejecucion = $resul->execute(["param" => $user]);
    if (!$ejecucion) {
        die("ERROR: Fallo al ejecutar la consulta SQL.<br>");
    }

    $registro = $resul->fetch(PDO::FETCH_ASSOC);
    if (!$registro) {
        die("ERROR: Usuario no encontrado.<br>");
    }

    if ($pass == $registro["password"]) {
        $_SESSION['user'] = $user;
        header("Location: bienvenida.php"); 
        exit();
    } else {
        die("ERROR: Contraseña incorrecta.<br>");
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
        body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.login-container {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    max-width: 400px;
    width: 100%;
}

h1 {
    color: #1e3c72;
    font-size: 24px;
    margin-bottom: 15px;
}

.message {
    font-size: 18px;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
    display: inline-block;
    margin-bottom: 15px;
}

.message.error {
    color: #d9534f;
    background: #f8d7da;
}

.message.success {
    color: #28a745;
    background: #d4edda;
}

.back-button {
    display: inline-block;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background: #ff9800;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.back-button:hover {
    background: #e68900;
}
    </style>
    </head>
    <body>
        <h1> Procesar Login </h1>
        <?php
          $pdo=conetarDB();
          if($pdo==null){
              print "ERROR pdo null ";
          }
          else{
              print "Conexion CORRECTA<br>";
          }
           $user=recogerValor("user");
           $pass=recogerValor("pass");
           if ($user === "error" || $pass === "error" || empty($user) || empty($pass)) {
    die("ERROR: Usuario o contraseña no proporcionados.<br>");
}
           print "Usuario : $user <br>password : $pass <br>";
           
           consultaPass($user,$pass);
        ?>
    </body>
</html>

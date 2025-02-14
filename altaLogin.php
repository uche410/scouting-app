<?php
include "conectardb.php";

function guardarDatos($user, $pass) {
    $pdo = conetarDB();
    if (!$pdo) {
        header("Location: index.php?error=db");
        exit();
    }

    // Verificar si el usuario ya existe
    $verificar = "SELECT COUNT(*) FROM login WHERE username = :paramUser";
    $stmt = $pdo->prepare($verificar);
    $stmt->execute(["paramUser" => $user]);
    $existe = $stmt->fetchColumn();

    if ($existe > 0) {
        header("Location: index.php?error=exists");
        exit();
    }

    // Insertar usuario si no existe
    $consulta = "INSERT INTO login (username, password) VALUES (:paramUser, :paramPass)";
    $resul = $pdo->prepare($consulta);

    if (!$resul->execute(["paramUser" => $user, "paramPass" => $pass])) {
        header("Location: index.php?error=insert");
        exit();
    } else {
        header("Location: index.php?success=registered");
        exit();
    }
}

// Recoger valores
$user = recogerValor("user");
$pass = recogerValor("pass");

if ($user === "error" || $pass === "error" || empty($user) || empty($pass)) {
    header("Location: index.php?error=empty");
    exit();
}

guardarDatos($user, $pass);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> ALTA LOGIN </h1> 
        <?php
            $user=recogerValor("user");
            $pass=recogerValor("pass");
            
            if($user!="" && $pass!=""){
                print "Intentando registrar usuario: $user con contraseña: $pass <br>";

                guardarDatos($user, $pass);
            }else{
                print "ERROR campos vacios ";
            }
        ?>
    </body>
</html>

<?php
session_start();
require 'conectardb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT id, nombre, contraseña, tipo FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($contrasena, $usuario['contraseña'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nombre'];
            $_SESSION['user_tipo'] = $usuario['tipo'];
            
            echo "<script>alert('Bienvenido, {$usuario['nombre']}');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Correo no registrado.'); window.history.back();</script>";
    }
    $stmt->close();
}
$conn->close();

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
    
</html>

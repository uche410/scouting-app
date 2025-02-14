<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); 
    exit();
}
$user = $_SESSION['user'];

echo "<html><head><title>Bienvenido</title></head><body>";
echo "<div style='font-family: Arial, sans-serif; text-align: center; padding: 50px;'>";
echo "<h1>Bienvenido, " . htmlspecialchars($user) . "!</h1>";
echo "<p>Redirigiendo a la página principal...</p>";
echo "</div>";
echo "<script>setTimeout(() => { window.location.href = 'home.php'; }, 2000);</script>";
echo "</body></html>";
?>

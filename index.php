<html>
    <head>
        <meta charset="UTF-8">
        <title>Sports Scouting</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <script>
            function login() {
                document.forms["form"].action = "procesarLogin.php";
                document.forms["form"].submit();
            }

            function alta() {
                document.forms["form"].action = "altaLogin.php";
                document.forms["form"].submit();
            }
            function borrarCampos() {
                document.forms["form"].reset();
            }
        </script>
    </head>
    <body>
        <div class="login-container">
            <img src="lupa.webp" class="logo" alt="Ícono de lupa">
            <h1>SPORTS SCOUTING</h1>
            <div class="login-box">
                <form method="post" name="form">
                    <input type="text" name="user" placeholder="Usuario">
                    <input type="password" name="pass" placeholder="Contraseña">
                    <div class="button-group">
                        <button type="button" class="btn btn-blue" onclick="login()">Iniciar sesión</button>
                        <button type="button" class="btn btn-orange" onclick="alta()">Registrarse</button>
                    </div>
                    <div class="button-group">
                        <button type="button" class="btn btn-gray" onclick="borrarCampos()">Borrar Campos</button>
                    </div>
                    <img src="jugador.png" class="jugador" alt="Jugador de baloncesto">
                    


                    <?php if (isset($_GET["error"])): ?>
                        <p class="error-message">
                            <?php
                            switch ($_GET["error"]) {
                                case "exists":
                                    echo "❌ Este usuario ya está registrado.";
                                    break;
                                case "empty":
                                    echo "⚠️ Debes completar todos los campos.";
                                    break;
                                case "insert":
                                    echo "⚠️ Error al registrar. Intenta de nuevo.";
                                    break;
                                case "db":
                                    echo "⚠️ Error de conexión con la base de datos.";
                                    break;
                            }
                            ?>
                        </p>
                    <?php endif; ?>

                    <?php if (isset($_GET["success"]) && $_GET["success"] == "registered"): ?>
                        <p class="success-message">✅ Usuario registrado con éxito.</p>
                    <?php endif; ?>

                </form>
            </div>
        </div>
    </body>
</html>

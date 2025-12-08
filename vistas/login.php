<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Sesion</title>
        <link rel="stylesheet" href="./css/estilos.css">
    </head>
    <body>
        <form action="index.php?c=Usuario&m=procesarLogin" method="POST">
            <h2>Iniciar Sesión</h2>
            <?php if(isset($datos) && $datos): ?>
                <div class="mensaje error"><?php echo $datos; ?></div>
            <?php endif; ?>
            <label>Usuario o correo:</label>
            <input type="text" name="nombre" placeholder="usuario123@gmail.com" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasenia" placeholder="••••••••" required>

            <button type="submit" name="login">Iniciar Sesión</button>

            <p>¿No tienes una cuenta? <a href="index.php?c=Usuario&m=registroForm">Registrarse</a></p>
        </form>
    </body>
</html>
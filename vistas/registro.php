<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
        <link rel="stylesheet" href="./css/estilos.css">
    </head>
    <body>
        <form action="index.php?c=Usuario&m=procesarRegistro" method="POST">
            <h2>Registrarse</h2>
            <?php if(isset($datos) && $datos): ?>
                <div class="mensaje error"><?php echo $datos; ?></div>
            <?php endif; ?>
            <label>Nombre de usuario:</label>
            <input type="text" name="nombre" placeholder="usuario123" required>

            <label>Correo:</label>
            <input type="email" name="correo" placeholder="usuario123@gmail.com" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasenia" placeholder="••••••••" required>

            <label>Repita la contraseña:</label>
            <input type="password" name="contrasenia2" placeholder="••••••••" required>

            <button type="submit" name="registro">Registrarse</button>

            <p>¿Ya tienes cuenta? <a href="index.php?c=Usuario&m=loginForm">Iniciar Sesión</a></p>
        </form>
    </body>
</html>

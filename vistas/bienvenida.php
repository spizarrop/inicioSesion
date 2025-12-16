<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido</title>
    </head>
    <body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario'] ?? 'Usuario'; ?>!</h2>
    <form action="index.php?c=Usuario&m=cambiarModoLogin" method="POST">
        <h3>Modo de Login</h3>
        <label>
            <input type="radio" name="modo_login" value="seguro"
                <?php echo ($_SESSION['modo_login'] ?? 'seguro') === 'seguro' ? 'checked' : ''; ?>>
            Login seguro (consulta preparada)
        </label><br>
        <label>
            <input type="radio" name="modo_login" value="inseguro"
                <?php echo ($_SESSION['modo_login'] ?? '') === 'inseguro' ? 'checked' : ''; ?>>
            Login inseguro (SQL Injection)
        </label><br><br>
        <button type="submit">Guardar modo</button>
    </form><br>
    <a href="index.php?c=Usuario&m=logout">Cerrar sesión</a>
    </body>
</html>
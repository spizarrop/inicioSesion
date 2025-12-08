<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido</title>
        <link rel="stylesheet" href="./css/estilos.css">
    </head>
    <body>
        <form>
            <h2>Bienvenido, <?php echo $_SESSION['usuario'] ?? 'Usuario'; ?>!</h2>
            <p>Has iniciado sesión correctamente.</p>
            <a href="index.php?c=Usuario&m=logout">Cerrar sesión</a>
        </form>
    </body>
</html>
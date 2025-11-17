<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesion</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <form action="procesarLogin.php" method="POST">
        <label>Usuario o correo:</label><br>
        <input type="text" name="nombre" placeholder="usuario123@gmail.com"><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasenia" placeholder="••••••••"><br>
        <br>
        <button type="submit" name="login">Iniciar Sesión</button><br>
        <label>¿No tienes una cuenta? </label>
        <a href="registro.php">Registrarse</a>
    </form>
</body>
</html>
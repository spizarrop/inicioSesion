<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <form action="procesarRegistro.php" method="POST">
        <label>Nombre de usuario:</label><br>
        <input type="text" name="nombre" placeholder="usuario123"><br>
        <label>Correo:</label><br>
        <input type="email" name="correo" placeholder="usuario123@gmail.com"><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasenia" placeholder="••••••••"><br>
        <label>Repita la contraseña:</label><br>
        <input type="password" name="contrasenia2" placeholder="••••••••"><br>
        <br>
        <button type="submit" name="registro">Registrarse</button>
    </form>
</body>
</html>
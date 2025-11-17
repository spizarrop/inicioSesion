<?php
require_once "conexionDB.php";
$conexion = new mysqli(SERVER,USER,PASS,DB);

$nombre = $_POST['nombre'];
$contrasenia = $_POST['contrasenia'];

if(strpos($nombre, "@")){
    $correo = $nombre;
    $sql = "SELECT (nombre, contrasenia) 
        FROM usuarios 
        WHERE correo='".$correo."' AND contrasenia='".$contrasenia."';";
}else{
    $sql = "SELECT (nombre, contrasenia) 
        FROM usuarios 
        WHERE nombre='".$nombre."' AND contrasenia='".$contrasenia."';";
}
$resultado = $conexion->query($sql);

if($resultado->num_rows > 0){
    header("Location: aplicacion.php");
    exit;
}
?>
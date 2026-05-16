<?php 

$servidor = "localhost" ;
$usuario = "root";
$password = "";
$base_datos = "escape_room";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos, 3307);

if($conexion->connect_error){
    die("Error de conexion: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

?>
<?php    
session_start();

$intentos = isset($_SESSION["intentos"])
    ? $_SESSION["intentos"]
    : 0;

session_destroy();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Recuperado</title>
    
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="contenedor">

        <h1>¡Acceso Recuperado!</h1>

        <p>Has desbloqueado todos lo niveles del servidor perdido</p>

        <p>Los archivos han sido restaurados correctamente</p>

        <p>Intentos realizados : <?php echo $intentos; ?> </p>
        
        <a href="index.php" class="boton">
         Volver a jugar 
         </a>
    </div>
</body>
</html>
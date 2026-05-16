<?php

session_start();

$_SESSION["nivel"] = 1;
$_SESSION["intentos"] = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Servidor Perdido</title>

    <link rel="stylesheet" hreft="estilos.css">
</head>
<body>
    
    <div class="contenedor">

    <h1>El servidor perdido</h1>
    <p>
        TRANSMISION ENTRANTE - AÑO 2035
    </p>

    <p>Un antiguo servidor de respaldo a sido encontrado en una sala abandonada del datacenter </p>

    <p>Para recuperar los archivos deberas superar una serie de pistas digitales</p>

    <p>Cada respuesta correcta desbloqueara el siguiente nivel</p>

    <a href="juego.php" class="botton">
        Iniciar mision
    </a>

    </div>
</body>
</html>
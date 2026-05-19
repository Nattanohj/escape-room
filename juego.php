<?php

session_start();

include("conexion.php");

if (!isset($_SESSION["nivel"])) {
    $_SESSION["nivel"] = 1;
}

if (!isset($_SESSION["intentos"])) {
    $_SESSION["intentos"] = 0;
}

$nivel = $_SESSION["nivel"];
$mensaje = "";

$sql = "SELECT * FROM pistas WHERE orden = $nivel";

$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {

    header("Location: final.php");
    exit();

}

$pista = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $respuesta_usuario = trim($_POST["respuesta"]);

    $_SESSION["intentos"]++;

    if (
        strcasecmp(
            $respuesta_usuario,
            $pista["respuesta"]
        ) == 0
    ) {

        $_SESSION["nivel"]++;

        header("Location: juego.php");
        exit();

    } else {

        $mensaje =
            " Respuesta incorrecta. El servidor rechaza el acceso.";

    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Juego</title>

    <link rel="stylesheet" href="estilos.css">

</head>

<body>

    <div class="contenedor">

        <h1>
            Nivel <?php echo $nivel; ?>
        </h1>

        <div class="pista">

            <h2>
                 Pista encontrada
            </h2>

            <p>
                <?php echo $pista["pregunta"]; ?>
            </p>

        </div>

        <form
            method="POST"
            onsubmit="return validarFormulario();"
        >

            <input
                type="text"
                name="respuesta"
                id="respuesta"
                placeholder="Ingresa tu respuesta"
            >

            <button type="submit">
                Enviar respuesta
            </button>

        </form>

        <p class="mensaje">
            <?php echo $mensaje; ?>
        </p>

    </div>

    <script src="script.js"></script>

</body>
</html>
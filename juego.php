<?php

session_start();

include("conexion.php");

if (!isset($_SESSION["nivel"])) {
    $_SESSION["nivel"] = 1;
}

if (!isset($_SESSION["intentos"])) {
    $_SESSION["intentos"] = 0;
}

$mensaje = "";
$claseMensaje = "";

/* VALIDAR RESPUESTA */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nivel_actual = $_SESSION["nivel"];

    $respuesta_usuario =
        trim($_POST["respuesta"]);

    $sql_validar =
        "SELECT * FROM pistas WHERE orden = $nivel_actual";

    $resultado_validar =
        $conexion->query($sql_validar);

    if (
        $resultado_validar &&
        $resultado_validar->num_rows > 0
    ) {

        $pista_validar =
            $resultado_validar->fetch_assoc();

        $_SESSION["intentos"]++;

        if (
            strcasecmp(
                trim($respuesta_usuario),
                trim($pista_validar["respuesta"])
            ) == 0
        ) {

            $_SESSION["nivel"]++;

            $nuevo_nivel = $_SESSION["nivel"];

            $sql_siguiente =
                "SELECT * FROM pistas WHERE orden = $nuevo_nivel";

            $resultado_siguiente =
                $conexion->query($sql_siguiente);

            if (
                $resultado_siguiente &&
                $resultado_siguiente->num_rows == 0
            ) {

                header("Location: final.php");
                exit();

            }

            $mensaje =
                "Respuesta correcta. Avanzando al siguiente nivel.";

            $claseMensaje = "exito";

        } else {

            $mensaje =
                "Respuesta incorrecta. El servidor rechaza el acceso.";

            $claseMensaje = "error";

        }
    }
}

/* CONSULTAR PISTA ACTUAL */

$nivel = $_SESSION["nivel"];

$sql =
    "SELECT * FROM pistas WHERE orden = $nivel";

$resultado = $conexion->query($sql);

if (
    !$resultado ||
    $resultado->num_rows == 0
) {

    header("Location: final.php");
    exit();

}

$pista = $resultado->fetch_assoc();

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

        <?php if ($mensaje != "") { ?>

            <p class="<?php echo $claseMensaje; ?>">
                <?php echo $mensaje; ?>
            </p>

        <?php } ?>

    </div>

    <script src="script.js"></script>

</body>
</html>
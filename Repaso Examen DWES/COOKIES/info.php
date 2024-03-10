<?php
include_once "colors.php";

$mostrarAviso = true;


if (isset($_COOKIE["color"]) && in_array($_COOKIE["color"], $colors)) {
    $color = $_COOKIE["color"];
    setcookie("color", $_COOKIE["color"], time() + 60 * 60 * 24 * 7);
} else {
    $color = $default;
}

if (isset($_POST["acepta_cookies"])) {
    setcookie("acepta_cookies",  time() + 60 * 60 * 24 * 365);
    $mostrarAviso = false;
    header("Location: info.php");
    exit();
} else if (isset($_COOKIE["acepta_cookies"])) {
    $mostrarAviso = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<style>
    body {
        background-color: <?= $color ?>;
    }
</style>

<body>
    <div id="contenido">


        <h1>Solsticio de invierno</h1>
        <pre>
        <p>
            El solsticio de invierno (el término solsticio proviene del latín sol ["Sol"] y sistere ["permanecer quieto"];
            también, solsticio hiemal)12 corresponde al instante en que la posición del Sol en el cielo se encuentra a la
            mayor distancia angular negativa del ecuador celeste. Dependiendo de la correspondencia con el calendario,
            el evento del solsticio de invierno tiene lugar entre el 21 y el 22 de diciembre todos los años, en el caso
            del hemisferio norte, y entre el 20 y el 21 de junio, en el caso del hemisferio sur. Esta variación es debida
            al desfase temporal provocado por los años bisiestos.
        </p>
    </pre>

        <a href="pref.php">Elige el tema</a>

    </div>
    <?php if ($mostrarAviso) : ?>
        <div id="aviso-cookies">
            <form method="post" action="">
                Este sitio web utiliza cookies para mejorar su experiencia. Al continuar navegando por este sitio, aceptas su uso.
                <input type="submit" name="acepta_cookies" value="Aceptar">
            </form>
        </div>
    <?php endif; ?>
    <div id="bloqueo"></div>


    <script src="script.js"></script>
</body>

</html>

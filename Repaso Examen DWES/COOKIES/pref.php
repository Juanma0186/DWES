<?php
//errores display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "colors.php";

$error = " ";
if (isset($_GET["color"])) {
    //! tiempo de vida de la cookie: 1 semana
    //setcookie("color",$_GET["color"],time()+60*60*24*7,"/");
    if (in_array($_GET["color"], $colors)) {
        setcookie("color", $_GET["color"], time() + 60 * 60 * 24 * 7);
        header("Location: info.php");
        die();
    } else {
        $error = "El color no es válido";
    }
} else {
    $color = $defecto;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colors</title>
</head>

<body>

    <h1>Página de preferencias</h1>
    <h2><?php if ($error != " ") { ?>
            <div><?= $error ?></div>
        <?php } ?>
    </h2>
    <div>
        <div>
            <?php foreach ($colors as $c) : ?>
                <a href="pref.php?color=<?= $c ?>" style="background-color:<?= $c ?> ;"><span>&nbsp;</span></a>
            <?php endforeach ?>
        </div>

    </div>

</body>

</html>

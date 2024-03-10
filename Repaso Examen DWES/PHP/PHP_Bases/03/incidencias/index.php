<?php

define('MIN_DESC', 10);
define('FILE_DATA', 'data.csv');

$msg = "";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

$titulo = "";
$descripcion = "";
$fecha = "";
$permanente = "";
$nombre = "";

$errores = [];

if (isset($_POST['enviar'])) {
    // Comprobamos que el título no esté vacío
    if (isset($_POST['titulo']) && $_POST['titulo'] != "") {
        $titulo = $_POST['titulo'];
    } else {
        $errores['titulo'] = "El título es obligatorio";
    }

    // Comprobamos que la descripción no esté vacía
    if (isset($_POST['descripcion']) && $_POST['descripcion'] != "") {
        if (strlen($_POST['descripcion']) < MIN_DESC) {
            $errores['descripcion'] = "longitud mínima de " . MIN_DESC;
        } else {
            $descripcion = $_POST['descripcion'];
        }
    } else {
        $errores['descripcion'] = "La descripción es obligatoria";
    }

    // Comprobamos que la fecha no esté vacía y sea válida
    if (isset($_POST['fecha']) && $_POST['fecha'] != "") {
        $fecha = $_POST['fecha'];
        $hoy = new DateTime("now");
        if ($hoy < new DateTime($fecha)) {
            $errores['fecha'] = "La fecha no puede ser futura";
        }
    }

    // Comprobamos el checkbox de permanente
    if (isset($_POST['permanente']) && $_POST['permanente'] != "") {
        $permanente = $_POST['permanente'];
    }

    //Comprobamos que se seleccione una opción
    if (($permanente == "" && $fecha == "") || ($permanente != "" && $fecha != "")) {
        $errores['momento'] = "Debes seleccionar una fecha o marcar la casilla de permanente";
    }

    // Comprobamos que el nombre no esté vacío
    if (isset($_POST['nombre']) && $_POST['nombre'] != "") {
        $nombre = $_POST['nombre'];
    }

    //Comprobamos si hay errores
    if (empty($errores)) {
        $data = file_get_contents(FILE_DATA);
        $fila = "$titulo;$descripcion;" . (($permanente != "") ? "Permanente" : "$fecha") . ";$nombre\n";
        $data .= $fila;
        file_put_contents(FILE_DATA, $data);

        header('Location: index.php?msg=Incidencia añadida correctamente');
        die(0);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias</title>
    <style>
        span.error {
            color: red;
            font-size: 0.8em;
        }

        h1.success {
            color: green;
        }
    </style>
</head>

<body>
    <?php if ($msg != "") { ?>
        <h1 class="success"><?= $msg ?></h1>
    <?php } ?>

    <form action="" method="post">
        <label for="titulo">Título*</label>
        <?php if (isset($errores['titulo'])) { ?>
            <span class="error"><?= $errores['titulo'] ?></span>
        <?php } ?>
        <br>
        <input type="text" name="titulo" placeholder="Incidencia" value="<?= $titulo ?>"><br>

        <label for="descripcion">Descripción*</label>
        <?php if (isset($errores['descripcion'])) { ?>
            <span class="error"><?= $errores['descripcion'] ?></span>
        <?php } ?>
        <br>
        <textarea name="descripcion" id="" cols="30" rows="10" placeholder="Por favor, cuentanos qué sucede..."><?= $descripcion ?></textarea><br>
        ---- elige uno ----
        <?php if (isset($errores['momento'])) { ?>
            <span class="error"><?= $errores['momento'] ?></span>
        <?php } ?>
        <br>
        <label for="fecha">¿Cuándo ocurrió?</label>
        <?php if (isset($errores['fecha'])) { ?>
            <span class="error"><?= $errores['fecha'] ?></span>
        <?php } ?>
        <br>
        <input type="date" name="fecha" value="<?= $fecha ?>"><br>
        <label for="permanente">Permanente</label><input type="checkbox" name="permanente" <?= ($permanente != "") ? 'checked' : '' ?>><br>
        ---- opcionales ----<br>
        <label for="nombre">Nombre</label><br>
        <input type="nombre" name="nombre" placeholder="Di tu nombre" value="<?= $nombre ?>"><br><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>

</html>

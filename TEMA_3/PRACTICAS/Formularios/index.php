<?php
print_r($_POST);
define('FILE_DATA', 'data.csv');

$msg = "";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

$hoy = date("Y-m-d");
$hora = date("H:i");

$origen = "";
$destino = "";
$fechaSalida = "";
$fechaVuelta = "";
$horaSalida = "";
$horaVuelta = "";
$clase = "";
$plazas = "";

$errores = [];

if (isset($_POST['enviar'])) {


    //Comprobaciones del Origen
    if (isset($_POST['origen']) && $_POST['origen'] != "") {
        if (strlen($_POST['origen']) > 4) {
            $origen = $_POST['origen'];
        } else {
            $errores['origen'] = "El origen debe tener al menos 4 caracteres";
        }
    } else {
        $errores['origen'] = "El origen es obligatorio";
    }

    //Comprobaciones del Destino
    if (isset($_POST['destino']) && $_POST['destino'] != "") {
        if (strlen($_POST['destino']) > 4) {
            $destino = $_POST['destino'];
        } else {
            $errores['destino'] = "El destino debe tener al menos 4 caracteres";
        }
    } else {
        $errores['destino'] = "El destino es obligatorio";
    }

    //Comprobaciones de la Fecha de Salida
    if (isset($_POST['fechaSalida']) && $_POST['fechaSalida'] != "") {
        if ($_POST['fechaSalida'] < $hoy) {
            $errores['fechaSalida'] = "La fecha de salida no puede ser anterior a la fecha actual";
        } else {
            $fechaSalida = $_POST['fechaSalida'];
        }
    } else {
        $errores['fechaSalida'] = "La fecha de salida es obligatoria";
    }

    //Comprobaciones de la Fecha de Vuelta
    if (isset($_POST['fechaVuelta']) && $_POST['fechaVuelta'] != "") {
        if ($_POST['fechaVuelta'] < $hoy) {
            $errores['fechaVuelta'] = "La fecha de vuelta no puede ser anterior a la fecha actual";
        } else {
            $fechaVuelta = $_POST['fechaVuelta'];
        }
    }

    //Comprobaciones fechaSalida y fechaVuelta
    if ($fechaSalida > $fechaVuelta) {
        $errores['fechas'] = "La fecha de salida no puede ser posterior a la fecha de vuelta";
    }

    //Comprobaciones de la Hora de Salida
    if (isset($_POST['horaSalida']) && $_POST['horaSalida'] != "") {
        if ($fechaSalida == $hoy && $_POST['horaSalida'] < $hora) {
            $errores['horaSalida'] = "La hora de salida no puede ser anterior a la hora actual";
        } else {
            $horaSalida = $_POST['horaSalida'];
        }
    } else {
        $errores['horaSalida'] = "La hora de salida es obligatoria";
    }

    //Comprobaciones de la Hora de Vuelta
    if (isset($_POST['horaVuelta']) && $_POST['horaVuelta'] != "") {
        if ($fechaSalida == $fechaVuelta && $_POST['horaVuelta'] < $horaSalida) {
            $errores['horaVuelta'] = "La hora de vuelta no puede ser anterior a la hora de salida";
        } else {
            $horaVuelta = $_POST['horaVuelta'];
        }
    }

    //Creamos un intervalo de 3 horas para la hora de vuelta
    $horaSalidaTemp = $horaSalida;
    $horaSalidaTemp = strtotime('+3 hour', strtotime($horaSalidaTemp));
    $horaSalidaTemp = date('H:i', $horaSalidaTemp);

    //Comprobaciones horaSalida y horaVuelta
    if ($fechaSalida == $fechaVuelta && $horaVuelta <= $horaSalidaTemp) {
        $errores['horas'] = "La hora de vuelta debe ser de 3h mayor a la de salida";
    }

    //Comprobaciones de las Plazas
    if (isset($_POST['plazas']) && $_POST['plazas'] != "") {
        if ($_POST['plazas'] > 0 && $_POST['plazas'] <= 8) {
            $plazas = $_POST['plazas'];
        } else {
            $errores['plazas'] = "El número de plazas debe ser entre 1 y 8";
        }
    } else {
        $errores['plazas'] = "El número de plazas es obligatorio";
    }
    //Comprobaciones de la Clase
    if (isset($_POST['clase']) && $_POST['clase'] != "") {
        $clase = $_POST['clase'];
    } else {
        $errores['clase'] = "La clase es obligatoria";
    }

    //Comprobaciones de Familia Numerosa
    if (isset($_POST['familia']) && $_POST['familia'] != "") {
        $familia = $_POST['familia'];
    } else {
        $errores['familia'] = "Seleccione un campo obligatoriamente";
    }

    //¿Hay errores?
    if (empty($errores)) {
        $data = file_get_contents(FILE_DATA);
        $fila = "$origen,$destino,$fechaSalida,$fechaVuelta,$horaSalida,$horaVuelta,$plazas,$clase,$familia\n";
        $data .= $fila;
        file_put_contents(FILE_DATA, $data);

        header("Location:./index.php?msg=success");
        die(0);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <?php
    if ($msg != "") {
        echo "<h1>" . $_GET['msg'] . "</h1>";
    }
    ?>
    <h2>Formulario Vuelo</h2>
    <form action="" method="post">
        <fieldset>
            <legend>Datos de vuelo</legend>

            <!-- Origen -->
            <label for="origen">Desde</label>
            <?php if (isset($errores['origen'])) { ?>
                <span class='error''><?= $errores['origen'] ?></span>
            <?php } ?>
            <input type="text" name="origen"  placeholder="Origen" value="<?= $origen ?>">
            <br>

            <!-- Destino -->
            <label for="destino">A</label>
            <?php if (isset($errores['destino'])) { ?>
                <span class=' error''><?= $errores['destino'] ?></span>
            <?php } ?>
            <input type="text" name="destino" placeholder="Destino" value="<?= $destino ?>">
            <br>

            <!-- Fechas -->

            <!--Fecha de Salida -->
            <label for="fechaSalida">Fecha de Salida</label>
            <?php if (isset($errores['fechaSalida'])) { ?>
                <span class='error''><?= $errores['fechaSalida'] ?></span>
            <?php } ?>
            <br>
            <input type="date" name="fechaSalida"  value="<?= $fechaSalida ?>">
            <br>

            <!--Fecha de Vuelta -->
            <label for="fechaVuelta">Fecha de Vuelta</label>
            <?php if (isset($errores['fechaVuelta'])) { ?>
                <span class=' error''><?= $errores['fechaVuelta'] ?></span>
            <?php } ?>
            <br>
            <input type="date" name="fechaVuelta" value="<?= $fechaVuelta ?>">
            <br>
            <?php if (isset($errores['fechas'])) { ?>
                <span class=' error''><?= $errores['fechas'] ?></span>
            <?php } ?>
            <br>

            <!-- Horas -->

            <!--Hora de Salida -->
            <label for="horaSalida">Hora de Salida</label>
            <?php if (isset($errores['horaSalida'])) { ?>
                <span class=' error''><?= $errores['horaSalida'] ?></span>
            <?php } ?>
            <input type="time" name="horaSalida" value="<?= $horaSalida ?>">
            <br>

            <!--Hora de Vuelta -->
            <label for="horaVuelta">Hora de Vuelta</label>
            <?php if (isset($errores['horaVuelta'])) { ?>
                <span class=' error''><?= $errores['horaVuelta'] ?></span>
            <?php } ?>
            <input type="time" name="horaVuelta" value="<?= $horaVuelta ?>">
            <br>
             <?php if (isset($errores['horas'])) { ?>
                <span class=' error''><?= $errores['horas'] ?></span>
            <?php } ?>
            <br>


            <!-- Plazas -->
            <label for="plazas">Plazas</label>
            <?php if (isset($errores['plazas'])) { ?>
                <span class=' error''><?= $errores['plazas'] ?></span>
            <?php } ?>
            <input type="number" name="plazas" min=" 1" max="8" value="<?= $plazas ?>">
            <br>

            <!-- Clase -->
            <label for="clase">Clase</label>
            <?php if (isset($errores['clase'])) { ?>
                <span class=' error''><?= $errores['clase'] ?></span>
            <?php } ?>
            <select name="clase">
                <option value="turista" <?= $clase === "turista" ? "selected" : "" ?>>Turista</option>
                <option value="business" <?= $clase === "business" ? "selected" : "" ?>>Business</option>
                <option value="primera" <?= $clase === "primera" ? "selected" : "" ?>>Primera</option>
            </select>
            <br>

            <!--FAMILIA NUMEROSA-->
            <label for="familia">¿Familia numerosa?</label>
            <?php if (isset($errores['familia'])) { ?>
                <span class=' error''><?= $errores['familia'] ?></span>
            <?php } ?>
            <br>
            <input type="radio" name="familia" value="no" /><label for="familia">No</label>
            <input type="radio" name="familia" value="general" /><label for="familia">General</label>
            <input type="radio" name="familia" value="especial" /><label for="familia">Especial</label>
            <br>

            <!--BOTONES-->
            <button type="submit" name="enviar">Reservar</button>
            <button type="reset">Reset</button>
        </fieldset>

        <!-- <fieldset>
            <legend>Datos del comprador</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <br>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
            <br>
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" placeholder="DNI">
            <br>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email">
            <br>
            <label for="telefono">Teléfono</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Teléfono">
            <br>
            <label for="metodo">Método de pago</label>
            <select name="metodo">
                <option value="tarjeta">Tarjeta</option>
                <option value="paypal">Paypal</option>
                <option value="transferencia">Bizum</option>
            </select>
        </fieldset> -->

    </form>

</body>

</html>
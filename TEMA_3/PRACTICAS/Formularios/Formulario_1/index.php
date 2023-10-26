<?php

define('VUELO_DATA', 'vuelo.csv');
define('USER_DATA', 'user.csv');


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
$familia = "";

$errores = [];

if (isset($_POST['enviar'])) {

    //!COMPROBACIONES DEL VUELO

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
    } else {
        $fechaVuelta = "null";
    }

    //Comprobaciones fechaSalida y fechaVuelta
    if ($fechaVuelta != "" && $fechaSalida > $fechaVuelta) {
        $errores['fechas'] = "La fecha de salida no puede ser posterior a la fecha de vuelta";
    }

    //Comprobaciones de la Hora de Salida
    if (isset($_POST['horaSalida']) && $_POST['horaSalida'] != "") {
        if ($fechaSalida === $hoy && $_POST['horaSalida'] < $hora) {
            $errores['horaSalida'] = "La hora de salida no puede ser anterior a la hora actual";
        } else {
            $horaSalida = $_POST['horaSalida'];
        }
    } else {
        $errores['horaSalida'] = "La hora de salida es obligatoria";
    }

    //Comprobaciones de la Hora de Vuelta
    if (isset($_POST['horaVuelta']) && $_POST['horaVuelta'] != "") {
        if ($fechaVuelta != "null") {
            if ($fechaVuelta === $hoy && $_POST['horaVuelta'] < $hora) {
                $errores['horaVuelta'] = "La hora de vuelta no puede ser anterior a la hora actual";
            } else {
                $horaVuelta = $_POST['horaVuelta'];
            }
        } else {
            $errores['horaVuelta'] = "La hora de vuelta es obligatoria si has seleccionado una fecha de vuelta";
            $horaVuelta = $_POST['horaVuelta'];
        }
    } else {
        $horaVuelta = "null";
    }


    //Creamos un intervalo de 3 horas para la hora de vuelta
    $horaSalidaTemp = $horaSalida;
    $horaSalidaTemp = strtotime('+3 hour', strtotime($horaSalidaTemp));
    $horaSalidaTemp = date('H:i', $horaSalidaTemp);

    //Comprobaciones horaSalida y horaVuelta
    if ($fechaSalida == $fechaVuelta && $horaVuelta < $horaSalidaTemp) {
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


    //!COMPROBACIONES DEL USUARIO

    //Comprobaciones del Nombre
    if (isset($_POST['nombre']) && $_POST['nombre'] != "") {
        if (strlen($_POST['nombre']) > 2) {
            $nombre = $_POST['nombre'];
        } else {
            $errores['nombre'] = "El nombre debe tener al menos 2 caracteres";
        }
    } else {
        $errores['nombre'] = "El nombre es obligatorio";
    }


    //¿Hay errores?
    if (empty($errores)) {
        $data = file_get_contents(VUELO_DATA);
        $fila = "$origen,$destino,$fechaSalida,$fechaVuelta,$horaSalida,$horaVuelta,$plazas,$clase,$familia\n";
        $data .= $fila;
        file_put_contents(VUELO_DATA, $data);
        header("Location:./index.php?msg=success");
        die(0);
    }
}

if (isset($_POST['reset'])) {
    $origen = "";
    $destino = "";
    $fechaSalida = "";
    $fechaVuelta = "";
    $horaSalida = "";
    $horaVuelta = "";
    $clase = "";
    $plazas = "";
    $familia = "";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Formulario</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <!-- MENSAJE DE SUCCESS-->
    <?php if ($msg != "" && empty($errores)) { ?>
        <div id="success" class="success">
            <div class="success-msg">
                <p><i class="bi bi-check-circle"></i> Vuelo Reservado!</p>
                <button onclick="cerrar()">Cerrar</button>
            </div>
        </div>
    <?php } ?>

    <!--FORMULARIO-->
    <div class="formulario">
        <h1>Formulario de Vuelo</h1>
        <form action="" method="post">
            <fieldset>
                <legend>Datos del vuelo</legend>

                <!-- Origen -->
                <div>
                    <label for="origen">Desde:<sup><strong>*</strong></sup> </label>
                    <?php if (isset($errores['origen'])) { ?>
                        <span class='error''><?= $errores['origen'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="text" name="origen"  placeholder="Origen" value="<?= $origen ?>">
                    <br>
                </div>

                <!-- Destino -->
                <div>
                    <label for="destino">Destino a:<sup><strong>*</strong></sup></label>
                <?php if (isset($errores['destino'])) { ?>
                    <span class=' error''><?= $errores['destino'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="text" name="destino" placeholder="Destino" value="<?= $destino ?>">
                    <br>
                </div>

                <!-- Fechas -->

                <!--Fecha de Salida -->
                <div>
                    <label for="fechaSalida">Fecha de Salida:<sup><strong>*</strong></sup></label>
                    <?php if (isset($errores['fechaSalida'])) { ?>
                        <span class='error''><?= $errores['fechaSalida'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="date" name="fechaSalida"  value="<?= $fechaSalida ?>">
                    <br>
                </div>

                <!--Fecha de Vuelta -->
                <div>
                    <label for="fechaVuelta">Fecha de Vuelta:</label>
                <?php if (isset($errores['fechaVuelta'])) { ?>
                    <span class=' error''><?= $errores['fechaVuelta'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="date" name="fechaVuelta" value="<?= $fechaVuelta ?>">
                    <br>
                    <?php if (isset($errores['fechas'])) { ?>
                        <span class=' error''><?= $errores['fechas'] ?></span>
                    <?php } ?>
                </div>

                <!-- Horas -->

                <!--Hora de Salida -->
                <div>
                    <label for="horaSalida">Hora de Salida:<sup><strong>*</strong></sup></label>
                    <?php if (isset($errores['horaSalida'])) { ?>
                    <span class=' error''><?= $errores['horaSalida'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="time" name="horaSalida" id="inputTime" value="<?= $horaSalida ?>">
                    <br>
                </div>

                <!--Hora de Vuelta -->
                <div>
                    <label for="horaVuelta">Hora de Vuelta:</label>
                    <?php if (isset($errores['horaVuelta'])) { ?>
                        <span class=' error''><?= $errores['horaVuelta'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="time" name="horaVuelta" value="<?= $horaVuelta ?>">
                    <br>
                    <?php if (isset($errores['horas'])) { ?>
                        <span class=' error''><?= $errores['horas'] ?></span>
                    <?php } ?>
                </div>

                <!-- Plazas -->
                <div>
                    <label for="plazas">Número de plazas:<sup><strong>*</strong></sup></label>
                    <?php if (isset($errores['plazas'])) { ?>
                        <span class=' error''><?= $errores['plazas'] ?></span>
                    <?php } ?>
                    <br>
                    <input type="number" name="plazas" min=" 1" max="8" value="<?= $plazas ?>">
                </div>

                <!-- Clase -->
                <div>
                    <label for="clase">Tipo de clase:<sup><strong>*</strong></sup></label>
                    <?php if (isset($errores['clase'])) { ?>
                    <span class=' error''><?= $errores['clase'] ?></span>
                    <?php } ?>
                    <br>
                    <select name="clase">
                        <option value="turista" <?= $clase === "turista" ? "selected" : "" ?>>Turista</option>
                        <option value="business" <?= $clase === "business" ? "selected" : "" ?>>Business</option>
                        <option value="primera" <?= $clase === "primera" ? "selected" : "" ?>>Primera</option>
                    </select>
                </div>

                <!--FAMILIA NUMEROSA-->
                <div class="familia">
                    <label for="familia">¿Familia numerosa?<sup><strong>*</strong></sup></label>
                    <?php if (isset($errores['familia'])) { ?>
                        <span class=' error''><?= $errores['familia'] ?></span>
                    <?php } ?>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="familia" value="no" <?= $familia === "no" ? "checked" : "" ?>  />
                            <label for="familia">No</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="familia" value="general" <?= $familia === "general" ? "checked" : "" ?> />
                            <label for="familia">General</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="familia" value="especial"<?= $familia === "especial" ? "checked" : "" ?> />
                            <label for="familia">Especial</label>
                        </div>
                    </div>
                </div>


                <!--BOTONES-->
                <div class="botones">
                    <button type="submit" name="enviar"><span>Reservar&nbsp;</span><i class="bi bi-airplane"></i></button>
                    <button type="submit" name="reset"><span>Reset&nbsp;</span><i class="bi bi-arrow-clockwise"></i></button>
                </div>
            </fieldset>

        </form>
    </div>

    <script>
        function cerrar() {
            const popup = document.getElementById("success");
            popup.style.display = "none";
        }
    </script>
    
</body>

</html>
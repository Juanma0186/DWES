<?php

$cosas = ["hola", "que", "tal", "estas", "?"];

function concatenaCon(string $union = ' ', mixed ...$parametros): string
{

  $cadena = "";

  foreach ($parametros as $k => $concatenado) {

    $cadena .= $concatenado;
    if ($k != count($parametros) - 1) {
      $cadena .= $union;
    }
  }

  return $cadena;
}

function concatenaConModificado(string &$salida, string $union = ' ', mixed ...$parametros): void
{

  $salida = concatenaCon($union, ...$parametros);
}

$msg = '';

concatenaConModificado($msg, " con ", "primer elemento", 122314, "3º parametro");

echo $msg;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 3</title>
</head>

<body>

  <p>
    <?= concatenaCon(" con ", "primer elemento", 122314, "3º parametro") ?>
    <!--También se pueden usar los ... para pasarle un array-->
    <?= concatenaCon(" con ", ...$cosas) ?>
  </p>

</body>

</html>
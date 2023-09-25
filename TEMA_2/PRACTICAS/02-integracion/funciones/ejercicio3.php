<?php

function concatenaCon(string $cadena, mixed ...$parametros): string
{

  foreach ($parametros as $concatenado) {

    $cadena .= " " . $concatenado;
  }

  return $cadena;
}

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
    <?= concatenaCon("Cadena inicial: ", "primer elemento", 122314, "3º parametro") ?>
  </p>

</body>

</html>
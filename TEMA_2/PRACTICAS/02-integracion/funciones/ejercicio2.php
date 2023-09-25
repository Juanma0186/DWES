<?php

function concatenar(string ...$cadenas): string
{

  $cadena_final = "";

  foreach ($cadenas as $cadena) {
    $cadena_final += (" " + $cadena);
  }

  return $cadena_final;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 1</title>
</head>

<body>
  <p>
    <?= concatenar("Hola", ",", "que", "tal", "estas", "?") ?>
  </p>
</body>

</html>
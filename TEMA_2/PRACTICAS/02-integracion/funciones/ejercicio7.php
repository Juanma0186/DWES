<?php

$impar = function ($num) {
  return $num % 2 != 0;
};

function esImpar(callable $impar, mixed ...$valores): array
{
  foreach ($valores as $valor) {
    if ($impar($valor)) {
      $arrayImpares[] = $valor;
    }
  }

  return $arrayImpares;
}

function esPrimo(array $valores): array
{
  foreach ($valores as $valor) {
    $esPrimo = true;
    for ($i = 2; $i < $valor; $i++) {
      if ($valor % $i == 0) {
        $esPrimo = false;
        break;
      }
    }
    if ($esPrimo) {
      $arrayPrimos[] = $valor;
    }
  }

  return $arrayPrimos;
}

function alCubo(array $valores): array
{
  foreach ($valores as $valor) {
    $arrayCubos[] = $valor ** 3;
  }

  return $arrayCubos;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 7</title>
</head>

<body>
  <?= print_r(esImpar($impar, 1, 4, 56, 7, 8, 57, 34, 293, 231)); ?>
  <br>
  <?= print_r(esPrimo(esImpar($impar, 1, 4, 56, 7, 8, 57, 34, 293, 231))); ?>
  <br>
  <?= print_r(alCubo(esPrimo(esImpar($impar, 1, 4, 56, 7, 8, 57, 34, 293, 231)))); ?>
</body>

</html>
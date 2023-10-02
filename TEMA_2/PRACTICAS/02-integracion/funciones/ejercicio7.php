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
    for ($i = 2; $i < sqrt($valor); $i++) { //Si el numero no es divisible hasta su raíz cuadrada , no será divisible por ninguno hasta n.
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

function esCapicua(array $valores): array
{
  $arrayCapicuas = [];
  foreach ($valores as $valor) {
    $valorInvertido = strrev($valor);
    if ($valor == $valorInvertido) {
      $arrayCapicuas[] = $valor;
    }
  }

  return $arrayCapicuas;
}

function dividirNumero(array $valores, int $posicion): array
{
  $numeroADividir = null;
  for ($i = 0; $i < count($valores); $i++) {
    if ($i == $posicion && $posicion <= count($valores) - 1) {
      $numeroADividir = $valores[$i];
    }
  }

  $numeroDividido = array_map('intval', str_split($numeroADividir));

  return $numeroDividido;
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
  <?= print_r(esCapicua(esImpar($impar, 1, 4, 56, 7, 8, 57, 34, 293, 12321))); ?>
  <br>
  <?= print_r(alCubo(esPrimo(esImpar($impar, 1, 4, 56, 7, 8, 57, 34, 293, 231)))); ?>
  <br>
  <?= print_r(dividirNumero([1, 4, 56, 7, 8, 57, 34, 293, 231], 2)); ?>
</body>

</html>
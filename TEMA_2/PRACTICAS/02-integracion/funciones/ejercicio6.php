<?php

//Invertir
function invertir(string $cadena): string
{
  $cadenaInvertida = "";

  for ($i = strlen($cadena) - 1; $i >= 0; $i--) {
    $cadenaInvertida .= $cadena[$i];
  }
  return $cadenaInvertida;
}

//Acumulador y Array

/**
 * @param bool $reset Si es true, resetea el acumulador a 0, por defecto es false
 */
function acumulador(int $acumulador, array $enteros, bool $reset = false): int
{
  $acumulador = $reset ? 0 : $acumulador;
  foreach ($enteros as $numero) {
    $acumulador += $numero;
  }
  return $acumulador;
}

//Combinada
function sumarValores(&$acumulador, mixed ...$valores)
{
  foreach ($valores as $valor) {
    if (is_numeric($valor)) {
      $acumulador += $valor;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 6</title>
</head>

<body>
  <p><?= invertir("Hola Mundo!") ?></p>
  <p><?= acumulador(100, [1, 232, 5657, 675, 345]) ?></p>
  <p><?= acumulador(100, [1, 232, 5657, 675, 345], true) ?></p>
</body>

</html>
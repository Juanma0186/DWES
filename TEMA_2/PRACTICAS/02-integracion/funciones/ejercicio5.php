<?php

function sumar($num1, $num2)
{
  return $num1 + $num2;
}

function restar($num1, $num2)
{
  return $num1 - $num2;
}

function multiplicar($num1, $num2)
{
  return $num1 * $num2;
}

function aplicarOperacion(string $operacion, $num1, $num2)
{

  switch ($operacion) {
    case 'suma':
      return sumar($num1, $num2);
    case 'resta':
      return restar($num1, $num2);
    case 'multiplicar':
      return multiplicar($num1, $num2);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 5</title>
</head>

<body>
  <p>
    <?= aplicarOperacion("multiplicar", 5, 6) ?>
  </p>
</body>

</html>
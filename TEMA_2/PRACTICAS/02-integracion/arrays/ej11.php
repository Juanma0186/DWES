<?php

function aplastalo(...$valores)
{
  $result = [];
  foreach ($valores as $valor) {
    if (is_array($valor)) {
      $result = array_merge($result, aplastalo(...$valor));
    } else {
      $result[] = $valor;
    }
  }
  return $result;
}

function aplastalo2(...$valores)
{
  $result = [];

  while (!empty($valores)) {
    $element = array_shift($valores);

    if (is_array($element)) {
      foreach (array_reverse($element) as $subelement) {
        array_unshift($valores, $subelement);
      }
    } else {
      $result[] = $element;
    }
  }

  return $result;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <p>
    El array tiene [<?= implode(",", aplastalo2([0], 42, [2, 3])) ?>]
  </p>
</body>

</html>
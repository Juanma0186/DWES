<?php

$multiplicar = function (int $num1, int $num2): int {

  return $num1 * $num2;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 4</title>
</head>

<body>
  <p>
    <?= $multiplicar(4, 5) ?>
  </p>
</body>

</html>
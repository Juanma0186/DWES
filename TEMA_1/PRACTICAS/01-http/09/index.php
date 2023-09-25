<?php

//Definimos la variable para el tamaño de la piramide
$width = 10;

//Definimos la variable para el caracter de la piramide
$caracter = "*";

$color = "";

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pirámide de astericos</title>
  <style>
    body {
      background-color: #222;
      color: white;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .container h1 {
      font-size: 32px;
      letter-spacing: 2px;
      text-decoration: underline;
    }

    .piramide {
      text-align: center;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Pirámide de Asteriscos</h1>
    <div class="piramide">
      <?php for ($i = 0; $i < $width; $i++) {
        for ($j = 0; $j < $i; $j++) {
          $color  = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>
          <span style="color: <?= $color ?>;"><?= $caracter ?></span>
        <?php }; ?>
        <br>
      <?php }; ?>
    </div>
  </div>


</body>

</html>
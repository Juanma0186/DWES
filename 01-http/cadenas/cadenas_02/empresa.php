<?php

if (isset($_POST['nombre']) && isset($_POST['empresa']) && isset($_POST['fecha'])) {
  $nombre = $_POST['nombre'];
  $empresa = $_POST['empresa'];
  $fecha = $_POST['fecha'];
} else {
  echo "<p>Por favor, complete el formulario antes de generar la carta de presentación.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title><?= $empresa ?></title>

</head>

<body>
  <div class="container">
    <h1><?= $empresa ?></h1>
    <hr>
    <p>Para: <span class="variables"><?= $empresa ?></span></p>
    <p>De: <span class="variables"><?= $nombre ?></span></p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo vero libero soluta voluptates iure iusto, tenetur facere nostrum officia totam possimus dicta nesciunt neque at maiores fuga veniam provident debitis.</p>
    <p class="firma"><?= $nombre ?> <span class="fecha"><?= $fecha ?></span></p>
  </div>
</body>

</html>
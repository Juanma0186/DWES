<?php

include 'SistemaSolar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    table,
    td,
    tr,
    th {
      border: 1px solid black;
      padding: 10px;
    }
  </style>
  <title>Sistema Solar</title>
</head>

<body>

  <?php

  $sistemaSolar = new SistemaSolar();

  $sistemaSolar->cargar();

  $sistemaSolar->mostrar();

  ?>

</body>

</html>
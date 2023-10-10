<?php

include 'SistemaSolar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
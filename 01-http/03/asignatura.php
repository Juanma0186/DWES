<?php
  include ('data.php');
  $ciclo=$_GET['ciclo'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$datos[$ciclo]['titulo'];?></title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1><?=$ciclo;?></h1>
  <h3><?=$datos[$ciclo]['titulo'];?></h3>
  <p><?=$datos[$ciclo]['descripcion'];?></p>
  <a href="<?=$datos[$ciclo]['enlace'];?>" target="_blank" >Más información</a>
  <br>
  <button onclick="window.history.back()">Volver</button>
  


</body>

</html>
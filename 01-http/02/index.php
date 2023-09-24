<?php
  include ("data.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de presentación</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1><?php echo $titulo; ?> - <span class="fecha"><?=$fecha?></span> - <?=$autor?></h1>
  <img src="<?=$imagen;?>" alt="Pirata">
  <p class="versos">
    <?php echo $contenido; ?>
  </p>

</body>
</html>
<?php
  include ('data.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ciclos formativos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Lista de Módulos</h1>
  <ul>
    <?php foreach ($datos as $ciclo => $contenido): ?>
      <li>
        <a href="asignatura.php?ciclo=<?=$ciclo; ?>">
          <?php echo $contenido['titulo']; ?>
        </a>
      </li>
    <?php endforeach; ?>

</body>
</html>
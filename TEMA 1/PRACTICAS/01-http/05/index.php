<?php
$num = 12;
$colores = array();

for ($i = 1; $i <= $num; $i++) {
  
  $colores["color{$i}"]  = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tecno party</title>

  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }

    .container{
      display: grid;
      grid-template-columns: repeat(<?=$num?>, 1fr);
      height: 100vh;
    }

    .color {
      flex: 1;
      display: grid;
      place-items: center;
      color: white;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container">
  <?php foreach ($colores as $color): ?>
    <div class='color' style='background: <?=$color;?>;'><?=$color;?></div>
  <?php endforeach; ?>
  </div>
</body>
</html>
